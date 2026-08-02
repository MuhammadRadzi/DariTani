<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            FarmerFarmSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            CartSeeder::class,
            BookmarkSeeder::class,
        ]);
    }
}
