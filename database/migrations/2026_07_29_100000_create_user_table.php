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
            $table->string('email_user', 100)->unique();
            $table->enum('role', ['Petani', 'Customer', 'Admin']);
            $table->boolean('is_active')->default(true);
            $table->enum('logindengan', ['Google', 'Email', 'Phone'])->default('Email');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
