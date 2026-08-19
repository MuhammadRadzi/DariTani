<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookmark', function (Blueprint $table) {
            // Bookmark ternyata untuk KEBUN (farm), bukan produk satuan
            // -- sesuai konfirmasi terbaru soal desain "Markah Petani".
            // Pakai hasColumn() check supaya migration ini aman dijalankan
            // di environment mana pun, meski kondisi tabel sebelumnya beda.
            if (Schema::hasColumn('bookmark', 'id_product')) {
                $table->dropForeign(['id_product']);
                $table->dropColumn('id_product');
            }

            if (! Schema::hasColumn('bookmark', 'id_farm')) {
                $table->foreignId('id_farm')
                    ->after('id_customer')
                    ->constrained('farm', 'id_farm')
                    ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookmark', function (Blueprint $table) {
            if (Schema::hasColumn('bookmark', 'id_farm')) {
                $table->dropForeign(['id_farm']);
                $table->dropColumn('id_farm');
            }

            if (! Schema::hasColumn('bookmark', 'id_product')) {
                $table->foreignId('id_product')
                    ->after('id_customer')
                    ->constrained('product', 'id_product')
                    ->onDelete('cascade');
            }
        });
    }
};
