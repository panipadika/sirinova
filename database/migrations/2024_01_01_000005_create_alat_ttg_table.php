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
        Schema::create('alat_ttg', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori')->constrained('kategori')->onDelete('cascade');
            $table->foreignId('id_inovator')->constrained('inovator')->onDelete('cascade');
            $table->foreignId('id_wilayah')->constrained('wilayah')->onDelete('cascade');
            $table->string('nama_alat');
            $table->integer('tahun_produksi');
            $table->text('deskripsi');
            $table->string('estimasi_harga');
            $table->string('nomor_telepon', 20)->nullable();
            $table->text('alamat_lengkap');
            $table->string('foto')->nullable();
            $table->enum('status_publikasi', ['Publik', 'Draft'])->default('Draft');
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat_ttg');
    }
};
