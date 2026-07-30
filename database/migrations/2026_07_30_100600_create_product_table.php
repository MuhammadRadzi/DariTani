<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id('id_product');
            // NOTE: relasi ke petani sekarang tidak langsung, harus lewat farm.id_farmer.
            $table->foreignId('id_farm')
                ->constrained('farm', 'id_farm')
                ->onDelete('cascade');
            $table->foreignId('id_category')
                ->constrained('category', 'id_category')
                ->onDelete('restrict');
            $table->string('product_image')->nullable();
            $table->string('product_name', 150);
            $table->decimal('price_per_kg', 10, 2);
            $table->decimal('stock_qty', 10, 2);
            $table->date('harvest_date')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_available')->nullable()->default(true);
            $table->string('type_product', 50)->nullable();
            $table->decimal('rating', 2, 1)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
