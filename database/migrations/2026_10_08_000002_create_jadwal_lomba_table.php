<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_lomba', function (Blueprint $table) {
            $table->id();
            $table->string('kategori')->unique(); // 'SMA/SMK Sederajat', 'Perguruan Tinggi', 'Umum'
            $table->string('judul_tampilan');
            $table->boolean('is_buka')->default(true); // Gembok: true = Terbuka (Pendaftaran Buka), false = Terkunci (Pendaftaran Tutup)
            $table->dateTime('tanggal_buka')->nullable();
            $table->dateTime('tanggal_tutup')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });

        // Seed 3 data kategori awal secara otomatis
        $now = now();
        DB::table('jadwal_lomba')->insert([
            [
                'kategori' => 'SMA/SMK Sederajat',
                'judul_tampilan' => 'SMA / SMK Sederajat',
                'is_buka' => true,
                'tanggal_buka' => null,
                'tanggal_tutup' => null,
                'keterangan' => 'Pendaftaran kategori pelajar SMA/SMK sederajat aktif.',
                'dibuat_pada' => $now,
                'diperbarui_pada' => $now,
            ],
            [
                'kategori' => 'Perguruan Tinggi',
                'judul_tampilan' => 'Perguruan Tinggi',
                'is_buka' => true,
                'tanggal_buka' => null,
                'tanggal_tutup' => null,
                'keterangan' => 'Pendaftaran kategori mahasiswa perguruan tinggi aktif.',
                'dibuat_pada' => $now,
                'diperbarui_pada' => $now,
            ],
            [
                'kategori' => 'Umum',
                'judul_tampilan' => 'Masyarakat Umum',
                'is_buka' => true,
                'tanggal_buka' => null,
                'tanggal_tutup' => null,
                'keterangan' => 'Pendaftaran kategori praktisi / masyarakat umum aktif.',
                'dibuat_pada' => $now,
                'diperbarui_pada' => $now,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_lomba');
    }
};
