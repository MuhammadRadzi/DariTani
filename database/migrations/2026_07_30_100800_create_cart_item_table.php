<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_item', function (Blueprint $table) {
            $table->id('id_cart_item');
            $table->foreignId('id_cart')
                ->constrained('cart', 'id_cart')
                ->onDelete('cascade');
            $table->foreignId('id_product')
                ->constrained('product', 'id_product')
                ->onDelete('cascade');
            $table->decimal('qty', 10, 2)->default(1);
            $table->unique(['id_cart', 'id_product']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_item');
    }
};
