<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // NOTE: beda dari skema awal (notif -> farmer/admin terpisah),
        // sekarang notification langsung terhubung ke user (berlaku untuk semua role).
        Schema::create('notification', function (Blueprint $table) {
            $table->id('id_notif');
            $table->foreignId('id_user')
                ->constrained('user', 'id_user')
                ->onDelete('cascade');
            $table->text('message');
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification');
    }
};
