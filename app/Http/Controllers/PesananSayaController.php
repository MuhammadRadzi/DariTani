<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PesananSayaController extends Controller
{
    private const STATUSES = ['pending', 'paid', 'shipped', 'completed', 'cancelled'];

    public function index(Request $request): View
    {
        $customer = Auth::user()->customer;
        abort_unless($customer, 403);

        $status = in_array($request->query('status'), self::STATUSES, true)
            ? $request->query('status')
            : null;

        $orders = Order::where('id_customer', $customer->id_customer)
            ->with(['items.product.farm.farmer.user'])
            ->when($status, fn ($q) => $q->where('status', $status))
            ->orderByDesc('id_order')
            ->paginate(10)
            ->withQueryString();

        return view('pesanan.index', [
            'orders' => $orders,
            'status' => $status,
        ]);
    }

    public function cancel(Request $request, Order $order): RedirectResponse
    {
        $customer = Auth::user()->customer;
        abort_unless($customer && $order->id_customer === $customer->id_customer, 403);

        if ($order->status !== 'pending') {
            return back()->with('error', 'Hanya pesanan berstatus menunggu yang dapat dibatalkan.');
        }

        DB::transaction(function () use ($order) {
            $order->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
            ]);

            // Kembalikan stok produk yang sebelumnya dikurangi saat checkout
            foreach ($order->items()->with('product')->get() as $item) {
                $item->product->increment('stock_qty', $item->qty);
            }
        });

        return back()->with('success', 'Pesanan #' . $order->order_number . ' berhasil dibatalkan.');
    }
}
