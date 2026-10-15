<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Farm;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KebunSayaController extends Controller
{
    private function authorizeFarm(Farm $farm): void
    {
        abort_unless($farm->id_farmer == auth::user()->farmer?->id_farmer, 403);
    }

    private function validateProduk(Request $request): array
    {
        return $request->validate([
            'product_name'  => ['required', 'string', 'max:150'],
            'price_per_kg'  => ['required', 'numeric', 'min:0', 'max:99999999'],
            'stock_qty'     => ['required', 'numeric', 'min:0', 'max:99999999'],
            'harvest_date'  => ['nullable', 'date'],
            'id_category'   => ['required', 'exists:category,id_category'],
            'product_image' => ['nullable', 'image', 'max:2048'],
        ]);
    }

    public function index(Request $request)
    {
        $farmer = auth::user()->farmer;
        abort_unless($farmer, 403);

        $farm = $request->filled('kebun')
            ? $farmer->farms()->whereKey($request->integer('kebun'))->firstOrFail()
            : $farmer->farms()->orderBy('id_farm')->firstOrFail();

        $farm->load('products.category');
        $categories = Category::all();

        return view('kebun-saya.index', compact('farm', 'categories'));
    }

    public function updateKebun(Request $request, Farm $farm)
    {
        $this->authorizeFarm($farm);

        $data = $request->validate([
            'name_farm' => ['sometimes', 'required', 'string', 'max:100'],
            'location'  => ['sometimes', 'required', 'string', 'max:255'],
			'description_farm' => ['sometimes', 'nullable', 'string', 'max:1000'],
            'photo_farm' => ['nullable', 'image', 'max:4096'],
        ], [
            'photo_farm.image' => 'File harus berupa gambar (JPG, PNG, dll).',
            'photo_farm.max'   => 'Ukuran foto maksimal 4 MB.',
            'photo_farm.uploaded' => 'Foto gagal diunggah. Coba foto dengan ukuran lebih kecil.',
        ]);

        if ($request->hasFile('photo_farm')) {
            if ($farm->photo_farm) {
                Storage::disk('public')->delete($farm->photo_farm);
            }
            $data['photo_farm'] = $request->file('photo_farm')->store('farms', 'public');
        } else {
            unset($data['photo_farm']);
        }

        $farm->update($data);

        return back()->with('success', 'Kebun diperbarui.');
    }

    public function storeProduk(Request $request, Farm $farm)
    {
        $this->authorizeFarm($farm);
        $data = $this->validateProduk($request);

        if ($request->hasFile('product_image')) {
            $data['product_image'] = $request->file('product_image')->store('products', 'public');
        }

        $farm->products()->create($data);

        return back()->with('success', 'Produk ditambahkan.');
    }

    public function updateProduk(Request $request, Product $product)
    {
        $this->authorizeFarm($product->farm);
        $data = $this->validateProduk($request);

        if ($request->hasFile('product_image')) {
            if ($product->product_image) {
                Storage::disk('public')->delete($product->product_image);
            }
            $data['product_image'] = $request->file('product_image')->store('products', 'public');
        }

        $product->update($data);

        return back()->with('success', 'Produk diperbarui.');
    }

    public function destroyProduk(Product $product)
    {
        $this->authorizeFarm($product->farm);

        if ($product->orderItems()->exists()) {
            return back()->withErrors(['produk' => 'Produk ini sudah pernah dipesan, jadi tidak bisa dihapus.']);
        }

        DB::transaction(function () use ($product) {
            $product->cartItems()->delete();
            $product->delete();
        });

        if ($product->product_image) {
            Storage::disk('public')->delete($product->product_image);
        }

        return back()->with('success', 'Produk dihapus.');
    }
}