<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_product');
            $table->foreignId('id_farmer')
                ->constrained('Petani', 'id_farmer')
                ->onDelete('cascade');
            $table->foreignId('id_sawah')
                ->nullable()
                ->constrained('Sawah', 'id_sawah')
                ->onDelete('set null');
            $table->foreignId('id_category')
                ->nullable()
                ->constrained('Category', 'id_category')
                ->onDelete('set null');
            $table->string('product_name', 150);
            $table->decimal('price_per_kg', 12, 2)->default(0);
            $table->decimal('stock_qty', 10, 2)->default(0);
            $table->date('harvest_date')->nullable();
            $table->text('description')->nullable();
            $table->string('product_image')->nullable();
            $table->string('jenis_produk', 100)->nullable();
            $table->boolean('is_available')->default(true);
            $table->decimal('rating', 3, 2)->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
