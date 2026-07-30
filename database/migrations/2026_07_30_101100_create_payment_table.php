<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id('id_payment');
            $table->foreignId('id_order')
                ->constrained('order', 'id_order')
                ->onDelete('cascade');
            $table->string('payment_proof')->nullable();
            $table->enum('status', ['pending', 'verified', 'rejected'])
                ->nullable()
                ->default('pending');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
