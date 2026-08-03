<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        return view('keranjang.index');
    }

    public function store(Request $request): RedirectResponse
    {
        // TODO: tambah item ke cart_item milik customer yang login.
        return back();
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        // TODO: update qty item di keranjang.
        return back();
    }

    public function destroy(CartItem $cartItem): RedirectResponse
    {
        // TODO: hapus item dari keranjang.
        return back();
    }

    public function checkout(Request $request): RedirectResponse
    {
        // TODO: validasi semua item yang di-checkout berasal dari 1 farm yang sama,
        // baru buat Order + OrderItem, lalu redirect ke wa.me dengan ringkasan pesanan.
        return back();
    }
}
