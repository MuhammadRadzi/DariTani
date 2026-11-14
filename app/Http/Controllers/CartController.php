<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CartController extends Controller
{
    // Item keranjang hanya boleh diubah/dihapus oleh pemilik keranjangnya.
    private function authorizeCartItem(CartItem $cartItem): void
    {
        $customer = Auth::user()->customer;

        abort_unless(
            $customer
                && Cart::where('id_customer', $customer->id_customer)
                ->where('id_cart', $cartItem->id_cart)
                ->exists(),
            403
        );
    }

    // Galat yang sama untuk fetch (JSON 422) dan form biasa (redirect + flash).
    private function tolak(Request $request, string $pesan)
    {
        if ($request->wantsJson()) {
            return response()->json(['message' => $pesan], 422);
        }

        return back()->with('error', $pesan);
    }

    private function pesanStok(Product $product): string
    {
        $max = $product->maxOrderQty();

        return $max > 0
            ? "Stok {$product->product_name} tersisa {$max} Kg."
            : "{$product->product_name} sedang tidak tersedia.";
    }

    public function index(): View
    {
        $customer = Auth::user()->customer;

        $cart = Cart::firstOrCreate(['id_customer' => $customer->id_customer]);
        $cart->load(['items.product.farm.farmer.user']);

        // Kelompokkan item per kebun (farm), sesuai desain "Daeng Baso' / Puang Kirk"
        // dan aturan checkout yang cuma boleh 1 kebun per transaksi.
        $groupedByFarm = $cart->items->groupBy(fn($item) => $item->product->farm->id_farm);

        return view('keranjang.index', [
            'cart' => $cart,
            'groupedByFarm' => $groupedByFarm,
        ]);
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'id_product' => ['required', 'exists:product,id_product'],
            'qty' => ['nullable', 'integer', 'min:1'],
        ]);

        $customer = Auth::user()->customer;
        $cart = Cart::firstOrCreate(['id_customer' => $customer->id_customer]);
        $product = Product::findOrFail($validated['id_product']);

        $existingItem = CartItem::where('id_cart', $cart->id_cart)
            ->where('id_product', $validated['id_product'])
            ->first();

        // Total di keranjang (yang sudah ada + yang baru) tidak boleh melebihi stok.
        $qtyBaru = ($existingItem->qty ?? 0) + ($validated['qty'] ?? 1);

        if ($qtyBaru > $product->maxOrderQty()) {
            return $this->tolak($request, $this->pesanStok($product));
        }

        if ($existingItem) {
            $existingItem->increment('qty', $validated['qty'] ?? 1);
        } else {
            CartItem::create([
                'id_cart' => $cart->id_cart,
                'id_product' => $validated['id_product'],
                'qty' => $validated['qty'] ?? 1,
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $validated = $request->validate([
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $product = $cartItem->product;

        if ($validated['qty'] > $product->maxOrderQty() && $validated['qty'] > (float) $cartItem->qty) {
            return $this->tolak($request, $this->pesanStok($product));
        }

        $cartItem->update(['qty' => $validated['qty']]);

        if ($request->wantsJson() || $request->isJson()) {
            return response()->json(['success' => true, 'qty' => $cartItem->qty]);
        }

        return back();
    }

    public function destroy(CartItem $cartItem): RedirectResponse
    {
        $this->authorizeCartItem($cartItem);
        
        $cartItem->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function checkout(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_farm' => ['required', 'exists:farm,id_farm'],
        ]);

        /** @var User $authUser */
        $authUser = Auth::user();
        $customer = $authUser->customer;

        // Profil harus lengkap dulu -- ini yang jadi data pengirim di struk WA,
        // supaya petani tahu pesanan ini dari siapa dan harus dikirim ke mana.
        if (blank($customer->phone) || blank($customer->address)) {
            return redirect()
                ->route('user.edit')
                ->with('error', 'Lengkapi No. HP dan Alamat kamu dulu sebelum checkout.');
        }

        $cart = Cart::where('id_customer', $customer->id_customer)->firstOrFail();

        // Ambil hanya item dari kebun yang dipilih -- validasi server-side,
        // walau tombolnya sudah per-grup, jangan percaya input dari client mentah-mentah.
        $items = CartItem::with('product.farm.farmer.user')
            ->where('id_cart', $cart->id_cart)
            ->whereHas('product', fn($q) => $q->where('id_farm', $validated['id_farm']))
            ->get();

        if ($items->isEmpty()) {
            return back()->with('error', 'Tidak ada produk dari kebun ini di keranjang.');
        }

        $farm = $items->first()->product->farm;
        $farmer = $farm->farmer;

        if (blank($farmer->whatsapp_number)) {
            return back()->with('error', 'Petani belum mengatur nomor WhatsApp. Checkout tidak dapat dilanjutkan.');
        }

        $totalAmount = $items->sum(fn($item) => $item->qty * $item->product->price_per_kg);

        $order = DB::transaction(function () use ($items, $customer, $totalAmount, $farmer) {
            // Kunci baris produk lalu pastikan stok masih cukup. Stok bisa berubah
            // sejak barang masuk keranjang. Kalau tidak cukup, kembalikan pesan
            // (string) sebelum ada data yang ditulis.
            $produk = Product::whereIn('id_product', $items->pluck('id_product'))
                ->lockForUpdate()
                ->get()
                ->keyBy('id_product');

            foreach ($items as $item) {
                $p = $produk[$item->id_product];

                if ($item->qty > $p->maxOrderQty()) {
                    return $this->pesanStok($p);
                }
            }

            // Hitung nomor pesanan berikutnya khusus untuk farmer ini,
            // supaya urutannya tidak lompat-lompat akibat checkout dari
            // farmer lain. lockForUpdate() mencegah dua checkout
            // bersamaan pada farmer yang sama mendapat nomor sama.
            $lastOrderNumber = Order::whereHas('items.product.farm', function ($q) use ($farmer) {
                $q->where('id_farmer', $farmer->id_farmer);
            })
                ->lockForUpdate()
                ->max('order_number');

            $order = Order::create([
                'id_customer' => $customer->id_customer,
                'order_number' => ($lastOrderNumber ?? 0) + 1,
                'order_date' => now()->toDateString(),
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'delivery_address' => $customer->address,
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'id_order' => $order->id_order,
                    'id_product' => $item->id_product,
                    'qty' => $item->qty,
                    'price' => $item->product->price_per_kg,
                    'subtotal' => $item->qty * $item->product->price_per_kg,
                ]);
            }

            // Item yang sudah di-checkout dihapus dari cart.
            // Item dari kebun lain (jika ada) tetap tersimpan.
            CartItem::whereIn('id_cart_item', $items->pluck('id_cart_item'))->delete();

            // Kurangi stok di transaksi yang sama dengan pembuatan pesanan.
            foreach ($items as $item) {
                $produk[$item->id_product]->decrement('stock_qty', $item->qty);
            }

            return $order;
        });

        // Closure mengembalikan string kalau stok tidak cukup (tidak ada yang tersimpan).
        if (is_string($order)) {
            return back()->with('error', $order);
        }

        $pesan = $this->formatPesanStruk($order, $items, $farm, $customer);
        $waUrl = 'https://wa.me/' . $farmer->whatsapp_number . '?text=' . urlencode($pesan);

        return redirect()->away($waUrl);
    }

    /**
     * Format pesan WhatsApp menyerupai struk belanja: header, daftar item,
     * total, lalu data pengirim (nama, HP, alamat) untuk pengiriman.
     */
    private function formatPesanStruk(Order $order, $items, $farm, $customer): string
    {
        $baris = [];
        $baris[] = '*STRUK PESANAN - DariTani.co.id*';
        $baris[] = '';
        $baris[] = 'No. Pesanan: #' . $order->order_number;
        $baris[] = 'Tanggal: ' . now()->translatedFormat('d F Y, H:i');
        $baris[] = 'Kebun: ' . $farm->name_farm;
        $baris[] = str_repeat('-', 28);

        foreach ($items as $item) {
            $subtotal = $item->qty * $item->product->price_per_kg;
            $baris[] = $item->product->product_name;
            $baris[] = (float) $item->qty . ' Kg x Rp' . number_format($item->product->price_per_kg, 0, ',', '.')
                . ' = Rp' . number_format($subtotal, 0, ',', '.');
        }

        $baris[] = str_repeat('-', 28);
        $baris[] = '*Total: Rp' . number_format($order->total_amount, 0, ',', '.') . '*';
        $baris[] = '';
        $baris[] = '*Data Pengiriman*';
        $baris[] = 'Nama: ' . $customer->user->name_user;
        $baris[] = 'No. HP: ' . $customer->phone;
        $baris[] = 'Alamat: ' . $customer->address;
        $baris[] = '';
        $baris[] = 'Mohon konfirmasi pesanan ini. Terima kasih!';

        return implode("\n", $baris);
    }
}
