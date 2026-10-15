<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TelaahanStafSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('telaahan_staf')->insert([
            [
                'judul' => 'Telaahan Staf Perencanaan Kebijakan Penerapan Teknologi Tepat Guna Pertanian Urban',
                'tahun_dokumen' => 2026,
                'pembuat_bidang' => 'Bidang Penelitian dan Pengembangan (Litbang)',
                'ringkasan' => 'Analisis dan pertimbangan teknis mengenai urgensi adopsi teknologi pertanian perkotaan (urban farming) berbasis otomatisasi tepat guna di Kota Tasikmalaya.',
                'file_pdf' => null,
                'status' => 'Dipublikasikan',
                'dibuat_pada' => now(),
                'diperbarui_pada' => now(),
            ],
            [
                'judul' => 'Telaahan Staf Evaluasi Kelayakan Fasilitasi Mesin Pencacah Sampah Organik Komunal',
                'tahun_dokumen' => 2026,
                'pembuat_bidang' => 'Bidang Ekonomi dan Pembangunan',
                'ringkasan' => 'Hasil kajian lapangan mengenai tingkat operasional dan dampak lingkungan alat pencacah sampah organik di TPS3R Kelurahan Tugujaya.',
                'file_pdf' => null,
                'status' => 'Dipublikasikan',
                'dibuat_pada' => now(),
                'diperbarui_pada' => now(),
            ],
            [
                'judul' => 'Telaahan Staf Strategi Akselerasi Inovasi Daerah dan Perlindungan HAKI Alat TTG',
                'tahun_dokumen' => 2026,
                'pembuat_bidang' => 'Bidang Penelitian dan Pengembangan (Litbang)',
                'ringkasan' => 'Rekomendasi skema pendampingan legalitas Hak Kekayaan Intelektual (HAKI) dan Paten Sederhana bagi para inovator lokal Kota Tasikmalaya.',
                'file_pdf' => null,
                'status' => 'Dipublikasikan',
                'dibuat_pada' => now(),
                'diperbarui_pada' => now(),
            ]
        ]);
    }
}
