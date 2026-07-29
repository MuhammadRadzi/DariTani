<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Sawah', function (Blueprint $table) {
            $table->id('id_sawah');
            $table->foreignId('id_petani')
                ->constrained('Petani', 'id_farmer')
                ->onDelete('cascade');
            $table->string('nama_sawah', 100);
            $table->string('lokasi')->nullable();
            $table->string('foto_sawah')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Sawah');
    }
};
