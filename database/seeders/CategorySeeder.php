<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name_category' => 'Sayuran', 'description' => 'Sayuran segar hasil panen dataran tinggi Malino.'],
            ['name_category' => 'Buah-buahan', 'description' => 'Buah segar hasil panen petani lokal.'],
            ['name_category' => 'Umbi-umbian', 'description' => 'Kentang, wortel, dan umbi lain dari dataran tinggi.'],
            ['name_category' => 'Rempah', 'description' => 'Rempah dan bumbu dapur segar.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
