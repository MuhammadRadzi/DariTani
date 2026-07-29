<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Order', function (Blueprint $table) {
            $table->id('id_order');
            $table->foreignId('id_customer')
                ->constrained('Customer', 'id_customer')
                ->onDelete('restrict');
            $table->foreignId('id_farmer')
                ->constrained('Petani', 'id_farmer')
                ->onDelete('restrict');
            $table->timestamp('order_date')->useCurrent();
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->enum('status', ['Pending', 'Processing', 'Shipped', 'Completed', 'Cancelled'])->default('Pending');
            $table->string('delivery_address');
            $table->text('notes')->nullable();
            $table->timestamp('cancelled_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Order');
    }
};
