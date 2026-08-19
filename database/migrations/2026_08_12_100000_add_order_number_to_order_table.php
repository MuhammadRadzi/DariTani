<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order', function (Blueprint $table) {
            // Nomor pesanan yang ditampilkan ke petani/customer, urut per
            // petani (bukan id_order yang global lintas semua petani).
            // id_order tetap dipakai sebagai PK internal untuk relasi.
            if (! Schema::hasColumn('order', 'order_number')) {
                $table->unsignedInteger('order_number')->nullable()->after('id_customer');
            }
        });
    }

    public function down(): void
    {
        Schema::table('order', function (Blueprint $table) {
            if (Schema::hasColumn('order', 'order_number')) {
                $table->dropColumn('order_number');
            }
        });
    }
};
