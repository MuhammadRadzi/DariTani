<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('farm', function (Blueprint $table) {
            $table->id('id_farm');
            $table->foreignId('id_farmer')
                ->constrained('farmer', 'id_farmer')
                ->onDelete('cascade');
            $table->string('name_farm', 100)->nullable();
            $table->string('location')->nullable();
            $table->string('photo_farm')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('farm');
    }
};
