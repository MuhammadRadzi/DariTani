<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Farm;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $sayuran = Category::where('name_category', 'Sayuran')->firstOrFail();
        $buah = Category::where('name_category', 'Buah-buahan')->firstOrFail();
        $umbi = Category::where('name_category', 'Umbi-umbian')->firstOrFail();
        $rempah = Category::where('name_category', 'Rempah')->firstOrFail();

        $farmDaengBaso1 = Farm::where('name_farm', 'Kebun Sayur Malino 1')->firstOrFail();
        $farmDaengBaso2 = Farm::where('name_farm', 'Kebun Sayur Malino 2')->firstOrFail();
        $farmRudy1 = Farm::where('name_farm', 'Kebun Sayur Rudy')->firstOrFail();

        $products = [
            // Kebun 1 milik Daeng Baso'
            [
                'id_farm' => $farmDaengBaso1->id_farm,
                'id_category' => $sayuran->id_category,
                'product_name' => 'Wortel Malino',
                'price_per_kg' => 10000,
                'stock_qty' => 50,
                'harvest_date' => now()->subDays(2),
                'description' => 'Wortel segar hasil panen dataran tinggi Malino, renyah dan manis.',
                'is_available' => true,
                'type_product' => 'Sayur segar',
                'rating' => 4.5,
            ],
            [
                'id_farm' => $farmDaengBaso1->id_farm,
                'id_category' => $sayuran->id_category,
                'product_name' => 'Kubis Malino',
                'price_per_kg' => 8000,
                'stock_qty' => 40,
                'harvest_date' => now()->subDays(1),
                'description' => 'Kubis segar, cocok untuk sayur sup atau lalapan.',
                'is_available' => true,
                'type_product' => 'Sayur segar',
                'rating' => 4.2,
            ],

            // Kebun 2 milik Daeng Baso' (kebun beda, petani sama)
            [
                'id_farm' => $farmDaengBaso2->id_farm,
                'id_category' => $umbi->id_category,
                'product_name' => 'Kentang Granola',
                'price_per_kg' => 15000,
                'stock_qty' => 60,
                'harvest_date' => now()->subDays(3),
                'description' => 'Kentang granola kualitas super, cocok untuk digoreng atau direbus.',
                'is_available' => true,
                'type_product' => 'Umbi',
                'rating' => 4.7,
            ],
            [
                'id_farm' => $farmDaengBaso2->id_farm,
                'id_category' => $rempah->id_category,
                'product_name' => 'Daun Bawang',
                'price_per_kg' => 12000,
                'stock_qty' => 25,
                'harvest_date' => now()->subDays(1),
                'description' => 'Daun bawang segar, dipetik langsung dari kebun.',
                'is_available' => true,
                'type_product' => 'Rempah segar',
                'rating' => 4.3,
            ],

            // Kebun milik Rudy
            [
                'id_farm' => $farmRudy1->id_farm,
                'id_category' => $buah->id_category,
                'product_name' => 'Markisa Malino',
                'price_per_kg' => 20000,
                'stock_qty' => 30,
                'harvest_date' => now()->subDays(2),
                'description' => 'Markisa manis asam segar, langsung dari kebun Rudy.',
                'is_available' => true,
                'type_product' => 'Buah segar',
                'rating' => 4.8,
            ],
            [
                'id_farm' => $farmRudy1->id_farm,
                'id_category' => $sayuran->id_category,
                'product_name' => 'Tomat Malino',
                'price_per_kg' => 9000,
                'stock_qty' => 45,
                'harvest_date' => now()->subDays(1),
                'description' => 'Tomat segar merah merona, kaya vitamin C.',
                'is_available' => true,
                'type_product' => 'Sayur segar',
                'rating' => 4.4,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
