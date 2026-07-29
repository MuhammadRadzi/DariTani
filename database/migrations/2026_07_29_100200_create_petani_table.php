<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Petani', function (Blueprint $table) {
            $table->id('id_farmer');
            $table->foreignId('id_user')
                ->constrained('user', 'id_user')
                ->onDelete('cascade');
            $table->string('farm_name', 100);
            $table->string('location')->nullable();
            $table->string('address')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Petani');
    }
};
