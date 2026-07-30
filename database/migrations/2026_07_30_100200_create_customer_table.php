<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id('id_customer');
            // FIX: FK diarahkan customer -> user (bukan sebaliknya seperti di SQL asli).
            $table->foreignId('id_user')
                ->unique()
                ->constrained('user', 'id_user')
                ->onDelete('cascade');
            $table->string('address')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('profile_photo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
