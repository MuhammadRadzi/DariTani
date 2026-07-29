<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Customer', function (Blueprint $table) {
            $table->id('id_customer');
            $table->foreignId('id_user')
                ->constrained('user', 'id_user')
                ->onDelete('cascade');
            $table->string('phone', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('profile_photo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Customer');
    }
};
