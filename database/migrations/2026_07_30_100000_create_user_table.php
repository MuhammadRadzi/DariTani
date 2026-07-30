<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('name_user', 100);
            $table->string('email_user', 150)->unique();
            $table->enum('role', ['farmer', 'customer', 'admin']);
            $table->boolean('is_active')->nullable()->default(true);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->enum('login_with', ['email', 'google', 'facebook']);
            $table->string('password_hash', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
