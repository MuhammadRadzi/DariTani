<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookmark', function (Blueprint $table) {
            $table->id('id_bookmark');
            $table->foreignId('id_customer')
                ->constrained('Customer', 'id_customer')
                ->onDelete('cascade');
            $table->foreignId('id_product')
                ->constrained('produk', 'id_product')
                ->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookmark');
    }
};
