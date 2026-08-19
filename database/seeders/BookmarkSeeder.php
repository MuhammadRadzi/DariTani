<?php

namespace Database\Seeders;

use App\Models\Bookmark;
use App\Models\Customer;
use App\Models\Farm;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    public function run(): void
    {
        $customer = Customer::firstOrFail();

        $farmDaengBaso1 = Farm::where('name_farm', 'Kebun Sayur Malino 1')->firstOrFail();
        $farmRudy1 = Farm::where('name_farm', 'Kebun Sayur Rudy')->firstOrFail();

        Bookmark::create([
            'id_customer' => $customer->id_customer,
            'id_farm' => $farmDaengBaso1->id_farm,
        ]);

        Bookmark::create([
            'id_customer' => $customer->id_customer,
            'id_farm' => $farmRudy1->id_farm,
        ]);
    }
}
