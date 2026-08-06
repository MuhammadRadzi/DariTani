<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Farm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        // Semua kebun dari semua petani, untuk ditampilkan sebagai
        // list "Produk DariTani" di halaman utama customer.
        $farms = Farm::with('farmer.user')->get();

        // Kategori produk, dipakai sebagai shortcut navigasi
        // (pengganti widget statistik yang dikosongkan, masih draft).
        $categories = Category::all();

        // Daftar id_farm yang sudah di-bookmark customer, dipakai untuk
        // menentukan status awal ikon bookmark di tiap card kebun.
        $customer = Auth::user()->customer;
        $bookmarkedFarmIds = $customer->bookmarks()->pluck('id_farm')->toArray();

        return view('user.index', compact('farms', 'categories', 'bookmarkedFarmIds'));
    }

    public function edit(): View
    {
        return view('user.edit');
    }

    public function update(Request $request): RedirectResponse
    {
        // TODO: implementasi update profil customer.
        return back();
    }
}
