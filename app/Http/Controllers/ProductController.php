<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Halaman detail 1 kebun beserta produk-produknya.
     * Diakses saat customer klik card kebun di Beranda.
     */
    public function show(Farm $farm): View
    {
        $farm->load(['farmer.user', 'products.category']);

        return view('produk.show', compact('farm'));
    }
}
