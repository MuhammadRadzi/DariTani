<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // NOTE: tabel ini tidak lagi punya id_farmer langsung (beda dari skema awal).
        // Satu order bisa berisi produk dari beberapa petani; relasi ke farmer
        // sekarang hanya bisa ditelusuri lewat order_item -> product -> farm -> farmer.
        Schema::create('order', function (Blueprint $table) {
            $table->id('id_order');
            $table->foreignId('id_customer')
                ->constrained('customer', 'id_customer')
                ->onDelete('restrict');
            $table->date('order_date');
            $table->decimal('total_amount', 12, 2);
            $table->enum('status', ['pending', 'paid', 'shipped', 'completed', 'cancelled'])
                ->nullable()
                ->default('pending');
            $table->string('delivery_address');
            $table->text('notes')->nullable();
            $table->timestamp('cancelled_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
