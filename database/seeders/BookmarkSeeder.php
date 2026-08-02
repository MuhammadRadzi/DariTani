<?php

namespace Database\Seeders;

use App\Models\Bookmark;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    public function run(): void
    {
        $customer = Customer::firstOrFail();
        $tomat = Product::where('product_name', 'Tomat Malino')->firstOrFail();
        $daunBawang = Product::where('product_name', 'Daun Bawang')->firstOrFail();

        Bookmark::create([
            'id_customer' => $customer->id_customer,
            'id_product' => $tomat->id_product,
        ]);

        Bookmark::create([
            'id_customer' => $customer->id_customer,
            'id_product' => $daunBawang->id_product,
        ]);
    }
}
