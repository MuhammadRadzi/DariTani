<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->id('id_order_item');
            $table->foreignId('id_order')
                ->constrained('order', 'id_order')
                ->onDelete('cascade');
            $table->foreignId('id_product')
                ->constrained('product', 'id_product')
                ->onDelete('restrict');
            $table->decimal('qty', 10, 2);
            $table->decimal('price', 10, 2);
            $table->decimal('subtotal', 12, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_item');
    }
};
