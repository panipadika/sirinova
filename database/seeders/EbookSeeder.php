<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EbookSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('ebooks')->insert([
            [
                'judul' => 'Kajian TTG Infrastruktur & Pertanian Perkotaan',
                'kategori' => 'Infrastruktur',
                'tahun' => '2025',
                'deskripsi' => 'Publikasi Kajian TTG Infrastruktur & Pertanian Perkotaan 2025 merupakan studi komprehensif yang menyajikan hasil pengkajian penerapan teknologi tepat guna pada sektor infrastruktur pendukung pertanian perkotaan di Kota Tasikmalaya. Indikator yang dimuat meliputi pemetaan kebutuhan teknologi fisik, analisis efisiensi biaya, serta rekomendasi kebijakan pengembangan inovasi berbasis kawasan.',
                'cover_image' => null,
                'file_url' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'judul' => 'Studi Kelayakan Inovasi Pengolahan Sampah Organik',
                'kategori' => 'Lingkungan',
                'tahun' => '2024',
                'deskripsi' => 'Laporan hasil pengkajian teknologi biodigestor dan komposter skala rumah tangga di Kota Tasikmalaya. Analisis kelayakan ekonomi dan dampak lingkungan untuk mendukung zero waste perkotaan.',
                'cover_image' => null,
                'file_url' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'judul' => 'Analisis Potensi Energi Surya untuk UMKM Tasikmalaya',
                'kategori' => 'Energi',
                'tahun' => '2024',
                'deskripsi' => 'Riset strategis pemanfaatan panel surya atap (Rooftop Solar PV) untuk efisiensi beban listrik usaha mikro, kecil, dan menengah di sentra industri Tasikmalaya.',
                'cover_image' => null,
                'file_url' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'judul' => 'Kajian Penerapan Digitalisasi Pemasaran Produk TTG',
                'kategori' => 'Teknologi',
                'tahun' => '2023',
                'deskripsi' => 'Kajian komprehensif mengenai efektivitas platform digital dan katalog online dalam memperluas jangkauan adopsi inovasi teknologi tepat guna lokal.',
                'cover_image' => null,
                'file_url' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
