<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // --- Admin ---
        $adminUser = User::create([
            'name_user' => 'Admin DariTani',
            'email_user' => 'admin@daritani.co.id',
            'role' => 'admin',
            'is_active' => true,
            'login_with' => 'email',
            'password_hash' => Hash::make('password'),
        ]);

        Admin::create([
            'id_user' => $adminUser->id_user,
            'permission_level' => 'superadmin',
        ]);

        // --- Farmer: Daeng Baso' ---
        $userDaengBaso = User::create([
            'name_user' => "Daeng Baso'",
            'email_user' => 'daengbaso@daritani.co.id',
            'role' => 'farmer',
            'is_active' => true,
            'login_with' => 'email',
            'password_hash' => Hash::make('password'),
        ]);

        // --- Farmer: Puang Kirk ---
        $userPuangKirk = User::create([
            'name_user' => 'Puang Kirk',
            'email_user' => 'puangkirk@daritani.co.id',
            'role' => 'farmer',
            'is_active' => true,
            'login_with' => 'email',
            'password_hash' => Hash::make('password'),
        ]);

        // --- Customer dummy ---
        $userCustomer = User::create([
            'name_user' => 'Muhammad Radzi',
            'email_user' => 'radzi@daritani.co.id',
            'role' => 'customer',
            'is_active' => true,
            'login_with' => 'email',
            'password_hash' => Hash::make('password'),
        ]);

        Customer::create([
            'id_user' => $userCustomer->id_user,
            'address' => 'Jl. Perintis Kemerdekaan, Makassar',
            'phone' => '081234567890',
            'profile_photo' => null,
        ]);
    }
}
