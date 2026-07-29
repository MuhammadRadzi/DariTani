<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('OrderItem', function (Blueprint $table) {
            $table->id('id_order_item');
            $table->foreignId('id_order')
                ->constrained('Order', 'id_order')
                ->onDelete('cascade');
            $table->foreignId('id_product')
                ->constrained('produk', 'id_product')
                ->onDelete('restrict');
            $table->decimal('qty', 10, 2)->default(1);
            $table->decimal('price', 12, 2);
            $table->decimal('subtotal', 12, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('OrderItem');
    }
};
