<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    public function index(): View
    {
        return view('markah.index');
    }

    public function store(Product $product): RedirectResponse
    {
        // TODO: tambah produk ke bookmark milik customer yang login.
        return back();
    }

    public function destroy(Product $product): RedirectResponse
    {
        // TODO: hapus produk dari bookmark.
        return back();
    }
}
