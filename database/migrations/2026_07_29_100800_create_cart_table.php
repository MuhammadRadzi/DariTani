<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Cart', function (Blueprint $table) {
            $table->id('id_cart');
            $table->foreignId('id_customer')
                ->constrained('Customer', 'id_customer')
                ->onDelete('cascade');
            $table->foreignId('id_product')
                ->constrained('produk', 'id_product')
                ->onDelete('cascade');
            $table->decimal('qty', 10, 2)->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Cart');
    }
};
