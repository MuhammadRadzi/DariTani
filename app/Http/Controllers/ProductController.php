<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('produk.index');
    }

    public function show(Product $product): View
    {
        return view('produk.show', compact('product'));
    }
}
