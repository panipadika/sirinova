<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataDummySeeder extends Seeder
{
    public function run(): void
    {
        $sekarang = Carbon::now();

        // 1. Memasukkan Data Wilayah (Kecamatan)
        $idWilayah1 = DB::table('wilayah')->insertGetId([
            'kode_wilayah' => '32.78.01',
            'nama_kecamatan' => 'Cihideung',
            'deskripsi' => 'Kawasan pusat perdagangan Kota Tasikmalaya.',
            'dibuat_pada' => $sekarang,
            'diperbarui_pada' => $sekarang,
        ]);

        $idWilayah2 = DB::table('wilayah')->insertGetId([
            'kode_wilayah' => '32.78.03',
            'nama_kecamatan' => 'Tawang',
            'deskripsi' => 'Kawasan perkantoran dan pendidikan.',
            'dibuat_pada' => $sekarang,
            'diperbarui_pada' => $sekarang,
        ]);

        $idWilayah3 = DB::table('wilayah')->insertGetId([
            'kode_wilayah' => '32.78.05',
            'nama_kecamatan' => 'Mangkubumi',
            'deskripsi' => 'Kawasan industri kecil dan kerajinan.',
            'dibuat_pada' => $sekarang,
            'diperbarui_pada' => $sekarang,
        ]);

        // 2. Memasukkan Data Kategori
        $idKategori1 = DB::table('kategori')->insertGetId([
            'nama_kategori' => 'Pertanian',
            'icon' => 'agriculture',
            'deskripsi' => 'Alat penunjang produktivitas pertanian dan perkebunan.',
            'dibuat_pada' => $sekarang,
            'diperbarui_pada' => $sekarang,
        ]);

        $idKategori2 = DB::table('kategori')->insertGetId([
            'nama_kategori' => 'Pengolahan Limbah',
            'icon' => 'recycling',
            'deskripsi' => 'Inovasi daur ulang dan penanganan sampah terpadu.',
            'dibuat_pada' => $sekarang,
            'diperbarui_pada' => $sekarang,
        ]);

        $idKategori3 = DB::table('kategori')->insertGetId([
            'nama_kategori' => 'Energi Terbarukan',
            'icon' => 'solar_power',
            'deskripsi' => 'Inovasi pemanfaatan energi alternatif dan terbarukan.',
            'dibuat_pada' => $sekarang,
            'diperbarui_pada' => $sekarang,
        ]);

        // 3. Memasukkan Data Inovator
        $idInovator1 = DB::table('inovator')->insertGetId([
            'id_kategori' => $idKategori1,
            'id_wilayah' => $idWilayah2,
            'nama_inovator' => 'Budi Pranoto',
            'nomor_telepon' => '081234567890',
            'alamat_lengkap' => 'Jl. Siliwangi No. 123, Tawang, Kota Tasikmalaya',
            'status' => 'Aktif',
            'dibuat_pada' => $sekarang,
            'diperbarui_pada' => $sekarang,
        ]);

        $idInovator2 = DB::table('inovator')->insertGetId([
            'id_kategori' => $idKategori2,
            'id_wilayah' => $idWilayah1,
            'nama_inovator' => 'KSM Lingkungan Asri',
            'nomor_telepon' => '089876543210',
            'alamat_lengkap' => 'Kp. Cihideung RT 01/02, Kota Tasikmalaya',
            'status' => 'Aktif',
            'dibuat_pada' => $sekarang,
            'diperbarui_pada' => $sekarang,
        ]);

        $idInovator3 = DB::table('inovator')->insertGetId([
            'id_kategori' => $idKategori3,
            'id_wilayah' => $idWilayah3,
            'nama_inovator' => 'Asep Teknologi Hijau',
            'nomor_telepon' => '085712345678',
            'alamat_lengkap' => 'Jl. Mangkubumi No. 45, Kota Tasikmalaya',
            'status' => 'Aktif',
            'dibuat_pada' => $sekarang,
            'diperbarui_pada' => $sekarang,
        ]);

        // 4. Memasukkan Data Alat TTG
        // Menggunakan foto yang sudah ada di storage/app/public/alat_ttg/
        DB::table('alat_ttg')->insert([
            [
                'id_kategori' => $idKategori1,
                'id_inovator' => $idInovator1,
                'id_wilayah' => $idWilayah2,
                'nama_alat' => 'Mesin Pencacah Kompos Otomatis',
                'tahun_produksi' => 2024,
                'deskripsi' => 'Mesin pencacah sampah organik rumah tangga menjadi pupuk kompos berkualitas dalam 24 jam.',
                'estimasi_harga' => 'Rp 3.500.000',
                'nomor_telepon' => '081234567890',
                'alamat_lengkap' => 'Jl. Siliwangi No. 123, Tawang, Kota Tasikmalaya',
                'foto' => 'alat_ttg/4l9ixjb3baKI4B5qocE5Fk6SLqXK3JLkYQp445la.png',
                'status_publikasi' => 'Publik',
                'dibuat_pada' => $sekarang->copy()->subDays(2),
                'diperbarui_pada' => $sekarang->copy()->subDays(2),
            ],
            [
                'id_kategori' => $idKategori2,
                'id_inovator' => $idInovator2,
                'id_wilayah' => $idWilayah1,
                'nama_alat' => 'Oven Pengering Kerupuk Hemat Energi',
                'tahun_produksi' => 2023,
                'deskripsi' => 'Oven pengering yang menggunakan energi surya hibrida untuk UMKM kuliner.',
                'estimasi_harga' => 'Sesuai Pesanan',
                'nomor_telepon' => '089876543210',
                'alamat_lengkap' => 'Kp. Cihideung RT 01/02, Kota Tasikmalaya',
                'foto' => 'alat_ttg/WkWZn7qAk9H1VX95iCdIRazTd6L5EUEZxDCaxjpV.png',
                'status_publikasi' => 'Publik',
                'dibuat_pada' => $sekarang->copy()->subDays(1),
                'diperbarui_pada' => $sekarang->copy()->subDays(1),
            ],
            [
                'id_kategori' => $idKategori3,
                'id_inovator' => $idInovator3,
                'id_wilayah' => $idWilayah3,
                'nama_alat' => 'Panel Surya Mini untuk Pompa Irigasi',
                'tahun_produksi' => 2025,
                'deskripsi' => 'Panel surya portabel yang dapat menggerakkan pompa air untuk irigasi lahan pertanian skala kecil.',
                'estimasi_harga' => 'Rp 5.200.000',
                'nomor_telepon' => '085712345678',
                'alamat_lengkap' => 'Jl. Mangkubumi No. 45, Kota Tasikmalaya',
                'foto' => 'alat_ttg/aL3NQU9eGSSwWbXpzpUzktgO0Sn8kgHqmIcWqog3.jpg',
                'status_publikasi' => 'Publik',
                'dibuat_pada' => $sekarang,
                'diperbarui_pada' => $sekarang,
            ],
        ]);
    }
}
