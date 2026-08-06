<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $customer = Auth::user()->customer;

        $cart = Cart::firstOrCreate(['id_customer' => $customer->id_customer]);
        $cart->load(['items.product.farm.farmer.user']);

        // Kelompokkan item per kebun (farm), sesuai desain "Daeng Baso' / Puang Kirk"
        // dan aturan checkout yang cuma boleh 1 kebun per transaksi.
        $groupedByFarm = $cart->items->groupBy(fn ($item) => $item->product->farm->id_farm);

        return view('keranjang.index', [
            'cart' => $cart,
            'groupedByFarm' => $groupedByFarm,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_product' => ['required', 'exists:product,id_product'],
            'qty' => ['nullable', 'numeric', 'min:0.1'],
        ]);

        $customer = Auth::user()->customer;
        $cart = Cart::firstOrCreate(['id_customer' => $customer->id_customer]);

        $existingItem = CartItem::where('id_cart', $cart->id_cart)
            ->where('id_product', $validated['id_product'])
            ->first();

        if ($existingItem) {
            $existingItem->increment('qty', $validated['qty'] ?? 1);
        } else {
            CartItem::create([
                'id_cart' => $cart->id_cart,
                'id_product' => $validated['id_product'],
                'qty' => $validated['qty'] ?? 1,
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $validated = $request->validate([
            'qty' => ['required', 'numeric', 'min:1'],
        ]);

        $cartItem->update(['qty' => $validated['qty']]);

        if ($request->wantsJson() || $request->isJson()) {
            return response()->json(['success' => true, 'qty' => $cartItem->qty]);
        }

        return back();
    }

    public function destroy(CartItem $cartItem): RedirectResponse
    {
        $cartItem->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function checkout(Request $request): RedirectResponse
    {
        // TODO: validasi semua item yang di-checkout berasal dari 1 farm yang sama,
        // baru buat Order + OrderItem, lalu redirect ke wa.me dengan ringkasan pesanan.
        return back();
    }
}
