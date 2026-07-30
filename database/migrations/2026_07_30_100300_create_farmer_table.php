<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('farmer', function (Blueprint $table) {
            $table->id('id_farmer');
            // FIX: FK diarahkan farmer -> user (bukan sebaliknya seperti di SQL asli).
            $table->foreignId('id_user')
                ->unique()
                ->constrained('user', 'id_user')
                ->onDelete('cascade');
            $table->string('farm_name', 150)->nullable();
            $table->string('location')->nullable();
            $table->string('address')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('farmer');
    }
};
