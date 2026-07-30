<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('farmer', function (Blueprint $table) {
            // Nomor WhatsApp petani, tujuan konfirmasi checkout
            // (checkout tidak pakai payment gateway, dikonfirmasi manual via WA).
            $table->string('whatsapp_number', 20)->nullable()->after('address');
        });
    }

    public function down(): void
    {
        Schema::table('farmer', function (Blueprint $table) {
            $table->dropColumn('whatsapp_number');
        });
    }
};
