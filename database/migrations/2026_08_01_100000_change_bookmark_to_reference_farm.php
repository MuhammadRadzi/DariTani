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
            // Catatan: kolom id_product tidak pernah punya FK constraint
            // di database (dicek lewat information_schema), jadi cukup
            // drop kolomnya langsung tanpa dropForeign().
            $table->dropColumn('id_product');
        });

        Schema::table('bookmark', function (Blueprint $table) {
            $table->foreignId('id_farm')
                ->after('id_customer')
                ->constrained('farm', 'id_farm')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('bookmark', function (Blueprint $table) {
            $table->dropForeign(['id_farm']);
            $table->dropColumn('id_farm');
        });

        Schema::table('bookmark', function (Blueprint $table) {
            $table->foreignId('id_product')
                ->after('id_customer')
                ->constrained('product', 'id_product')
                ->onDelete('cascade');
        });
    }
};
