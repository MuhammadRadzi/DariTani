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
        $userPuangKirk = User::where('email_user', 'puangkirk@daritani.co.id')->firstOrFail();

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

        // --- Farmer: Puang Kirk (1 kebun saja) ---
        $farmerPuangKirk = Farmer::create([
            'id_user' => $userPuangKirk->id_user,
            'farm_name' => 'Kebun Puang Kirk',
            'location' => 'Malino, Gowa',
            'address' => 'Jl. Malino Raya No. 27',
            'whatsapp_number' => '6282222222222',
        ]);

        Farm::create([
            'id_farmer' => $farmerPuangKirk->id_farmer,
            'name_farm' => 'Kebun Sayur Puang Kirk',
            'location' => 'Malino, Gowa',
            'photo_farm' => null,
        ]);
    }
}
