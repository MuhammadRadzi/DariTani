<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Farm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        // Semua kebun dari semua petani, untuk ditampilkan sebagai
        // list "Produk DariTani" di halaman utama customer.
        $farms = Farm::with('farmer.user')->get();

        // Kategori produk, dipakai sebagai shortcut navigasi
        // (pengganti widget statistik yang dikosongkan).
        $categories = Category::all();

        return view('user.index', compact('farms', 'categories'));
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
