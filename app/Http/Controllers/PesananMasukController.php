<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PesananMasukController extends Controller
{
    private const STATUSES = ['pending', 'paid', 'shipped', 'completed', 'cancelled'];

    private const TRANSITIONS = [
        'pending' => ['paid', 'cancelled'],
        'paid'    => ['shipped', 'cancelled'],
        'shipped' => ['completed'],
    ];

    private function ownedOrders(): Builder
    {
        $farmer = auth::user()->farmer;
        abort_unless($farmer, 403);

        return Order::whereHas('items.product.farm', fn ($q) => $q->where('id_farmer', $farmer->id_farmer));
    }

    public function index(Request $request)
    {
        $status = in_array($request->query('status'), self::STATUSES, true)
            ? $request->query('status')
            : null;

        $orders = $this->ownedOrders()
            ->with(['customer.user', 'items.product'])
            ->when($status, fn ($q) => $q->where('status', $status))
            ->orderByDesc('id_order')
            ->paginate(10)
            ->withQueryString();

        return view('pesanan-masuk.index', [
            'orders'      => $orders,
            'status'      => $status,
            'transitions' => self::TRANSITIONS,
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        abort_unless($this->ownedOrders()->whereKey($order->getKey())->exists(), 403);

        $data = $request->validate([
            'status' => ['required', Rule::in(self::STATUSES)],
        ]);

        $current = $order->status ?? 'pending';

        if (! in_array($data['status'], self::TRANSITIONS[$current] ?? [], true)) {
            return back()->withErrors(['status' => 'Perubahan status itu tidak diizinkan.']);
        }

        $update = ['status' => $data['status']];
        if ($data['status'] === 'cancelled') {
            $update['cancelled_at'] = now();
        }
        $order->update($update);

        return back()->with('success', 'Status pesanan #' . $order->order_number . ' diperbarui.');
    }
}