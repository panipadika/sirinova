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
        Schema::create('ebook', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori');
            $table->string('tahun');
            $table->text('deskripsi')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('file_url')->nullable();
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
        Schema::dropIfExists('ebook');
    }
};
