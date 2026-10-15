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
        Schema::create('telaahan_staf', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('nomor_surat');
            $table->date('tanggal_dokumen');
            $table->string('pembuat_bidang');
            $table->string('kategori')->default('Kebijakan');
            $table->text('ringkasan')->nullable();
            $table->text('pokok_persoalan')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->string('file_pdf')->nullable();
            $table->enum('status', ['Draft', 'Dipublikasikan', 'Arsip'])->default('Dipublikasikan');
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telaahan_staf');
    }
};
