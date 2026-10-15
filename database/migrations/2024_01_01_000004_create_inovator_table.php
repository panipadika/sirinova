<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inovator', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_wilayah')->constrained('wilayah')->onDelete('cascade');
            $table->string('nama_inovator');
            $table->string('nomor_telepon', 50);
            $table->text('alamat_lengkap')->nullable();
            $table->enum('status', ['Aktif', 'Non-Aktif'])->default('Aktif');
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inovator');
    }
};
