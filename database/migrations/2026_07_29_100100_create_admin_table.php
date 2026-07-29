<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ADMIN', function (Blueprint $table) {
            $table->id('id_admin');
            $table->foreignId('id_user')
                ->constrained('user', 'id_user')
                ->onDelete('cascade');
            $table->enum('permission_level', ['SuperAdmin', 'Admin', 'Moderator'])->default('Admin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ADMIN');
    }
};
