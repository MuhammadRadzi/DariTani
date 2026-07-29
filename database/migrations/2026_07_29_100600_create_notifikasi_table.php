<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('NOTIFIKASI', function (Blueprint $table) {
            $table->id('id_notif');
            $table->foreignId('id_farmer')
                ->nullable()
                ->constrained('Petani', 'id_farmer')
                ->onDelete('cascade');
            $table->foreignId('id_admin')
                ->nullable()
                ->constrained('ADMIN', 'id_admin')
                ->onDelete('cascade');
            $table->text('message');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('NOTIFIKASI');
    }
};
