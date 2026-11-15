<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): RedirectResponse|View
    {
        if (Auth::check()) {
            return Auth::user()->role === 'farmer'
                ? redirect()->route('kebun-saya.index')
                : redirect()->route('user.index');
        }

        $products = Product::with(['category', 'farm.farmer.user'])
            ->where('is_available', true)
            ->where('stock_qty', '>', 0)
            ->orderBy('id_product', 'desc')
            ->get();

        $categories = Category::whereHas('products', function ($query) {
            $query->where('is_available', true)->where('stock_qty', '>', 0);
        })->get();

        return view('landing', compact('products', 'categories'));
    }
}

