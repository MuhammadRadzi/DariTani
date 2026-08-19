<?php

namespace Database\Seeders;

use App\Models\Farm;
use App\Models\Farmer;
use App\Models\User;
use Illuminate\Database\Seeder;

class FarmerFarmSeeder extends Seeder
{
    public function run(): void
    {
        $userDaengBaso = User::where('email_user', 'daengbaso@daritani.co.id')->firstOrFail();
        $userRudy = User::where('email_user', 'rudy@daritani.co.id')->firstOrFail();

        // --- Farmer: Daeng Baso' (sengaja punya 2 kebun, buat test checkout per-kebun) ---
        $farmerDaengBaso = Farmer::create([
            'id_user' => $userDaengBaso->id_user,
            'farm_name' => "Kebun Daeng Baso'",
            'location' => 'Malino, Gowa',
            'address' => 'Jl. Malino Raya No. 12',
            'whatsapp_number' => '6281111111111',
        ]);

        $farmDaengBaso1 = Farm::create([
            'id_farmer' => $farmerDaengBaso->id_farmer,
            'name_farm' => 'Kebun Sayur Malino 1',
            'location' => 'Malino, Gowa',
            'photo_farm' => null,
        ]);

        $farmDaengBaso2 = Farm::create([
            'id_farmer' => $farmerDaengBaso->id_farmer,
            'name_farm' => 'Kebun Sayur Malino 2',
            'location' => 'Malino, Gowa',
            'photo_farm' => null,
        ]);

        // --- Farmer: Rudy (1 kebun saja) ---
        $farmerRudy = Farmer::create([
            'id_user' => $userRudy->id_user,
            'farm_name' => 'Kebun Rudy',
            'location' => 'Malino, Gowa',
            'address' => 'Jl. Malino Raya No. 27',
            'whatsapp_number' => '6282222222222',
        ]);

        Farm::create([
            'id_farmer' => $farmerRudy->id_farmer,
            'name_farm' => 'Kebun Sayur Rudy',
            'location' => 'Malino, Gowa',
            'photo_farm' => null,
        ]);
    }
}
