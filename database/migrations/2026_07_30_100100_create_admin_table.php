<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin');
            // FIX: FK diarahkan admin -> user (bukan sebaliknya seperti di SQL asli).
            $table->foreignId('id_user')
                ->unique()
                ->constrained('user', 'id_user')
                ->onDelete('cascade');
            $table->enum('permission_level', ['superadmin', 'staff']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
