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
        // 1. Tambahkan kolom pendukung di tabel user jika belum ada
        if (Schema::hasTable('user')) {
            Schema::table('user', function (Blueprint $table) {
                if (!Schema::hasColumn('user', 'no_wa')) {
                    $table->string('no_wa')->nullable()->after('email');
                }
                if (!Schema::hasColumn('user', 'asal_instansi')) {
                    $table->string('asal_instansi')->nullable()->after('no_wa');
                }
                if (!Schema::hasColumn('user', 'dibuat_pada') && Schema::hasColumn('user', 'created_at')) {
                    // Biarkan created_at atau bisa gunakan alias
                }
            });
        }

        // 2. Buat tabel pendaftaran_lomba
        Schema::create('pendaftaran_lomba', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('nomor_registrasi')->unique();
            $table->enum('kategori_peserta', ['SMA/SMK Sederajat', 'Perguruan Tinggi', 'Umum']);
            
            // Data Inovator & Tim
            $table->string('nama_inovator');
            $table->text('nama_anggota')->nullable();
            $table->string('asal_instansi');
            $table->string('nomor_wa');
            $table->string('email');
            
            // Data Alat TTG
            $table->string('nama_alat');
            $table->decimal('biaya_pembuatan', 15, 2)->default(0);
            $table->decimal('estimasi_harga_jual', 15, 2)->default(0);
            $table->text('fungsi');
            $table->text('spesifikasi_bahan');
            $table->text('latar_belakang')->nullable();
            
            // Berkas & Media
            $table->string('file_proposal');
            $table->string('foto_alat')->nullable();
            $table->string('link_video')->nullable();
            
            // Status & Evaluasi Admin
            $table->string('status')->default('Menunggu Verifikasi');
            $table->text('catatan_admin')->nullable();
            
            // Timestamps sesuai konvensi SI-RINOVA
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();

            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_lomba');

        if (Schema::hasTable('user')) {
            Schema::table('user', function (Blueprint $table) {
                if (Schema::hasColumn('user', 'no_wa')) {
                    $table->dropColumn('no_wa');
                }
                if (Schema::hasColumn('user', 'asal_instansi')) {
                    $table->dropColumn('asal_instansi');
                }
            });
        }
    }
};
