<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IndikatorMakro;
use App\Models\DataIndikatorMakro;

class IndikatorMakroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $indikatorData = [
            [
                'nama_indikator' => 'Indeks Pembangunan Manusia (IPM)',
                'satuan' => 'Point',
                'deskripsi' => 'Capaian Indeks Pembangunan Manusia Kabupaten/Kota se-Jawa Barat',
                'urutan' => 1,
            ],
            [
                'nama_indikator' => 'Laju Pertumbuhan Ekonomi (LPE)',
                'satuan' => 'Persen',
                'deskripsi' => 'Pertumbuhan Ekonomi Kabupaten/Kota se-Jawa Barat',
                'urutan' => 2,
            ],
            [
                'nama_indikator' => 'Persentase Penduduk Miskin',
                'satuan' => 'Persen',
                'deskripsi' => 'Persentase Kemiskinan Kabupaten/Kota se-Jawa Barat',
                'urutan' => 3,
            ],
            [
                'nama_indikator' => 'Tingkat Pengangguran Terbuka (TPT)',
                'satuan' => 'Persen',
                'deskripsi' => 'Tingkat Pengangguran Kabupaten/Kota se-Jawa Barat',
                'urutan' => 4,
            ],
            [
                'nama_indikator' => 'Laju Inflasi',
                'satuan' => 'Persen',
                'deskripsi' => 'Tingkat Inflasi Kabupaten/Kota se-Jawa Barat',
                'urutan' => 5,
            ],
        ];

        foreach ($indikatorData as $ind) {
            $indikator = IndikatorMakro::updateOrCreate(
                ['nama_indikator' => $ind['nama_indikator']],
                $ind
            );

            if ($ind['nama_indikator'] === 'Indeks Pembangunan Manusia (IPM)') {
                $daerahValues = [
                    'Kota Bandung' => 84.66,
                    'Kota Bekasi' => 84.43,
                    'Kota Depok' => 84.04,
                    'Kota Cimahi' => 80.85,
                    'Kota Bogor' => 79.75,
                    'Kota Cirebon' => 78.99,
                    'Kota Sukabumi' => 78.23,
                    'Kab. Bekasi' => 77.80,
                    'Kota Tasikmalaya' => 76.59,
                    'Kab. Bandung' => 75.58,
                    'Kota Banjar' => 75.54,
                    'Kab. Sumedang' => 75.50,
                    'Kab. Purwakarta' => 74.97,
                    'Kab. Karawang' => 74.59,
                    'Kab. Bogor' => 74.53,
                    'Kab. Ciamis' => 74.33,
                    'Kab. Cirebon' => 73.27,
                    'Kab. Subang' => 73.00,
                    'Kab. Majalengka' => 72.37,
                    'Kab. Kuningan' => 72.31,
                    'Kab. Pangandaran' => 71.66,
                    'Kab. Bandung Barat' => 71.65,
                    'Kab. Indramayu' => 71.58,
                    'Kab. Sukabumi' => 71.13,
                    'Kab. Tasikmalaya' => 70.76,
                    'Kab. Garut' => 70.67,
                    'Kab. Cianjur' => 69.84,
                ];
            } elseif ($ind['nama_indikator'] === 'Laju Pertumbuhan Ekonomi (LPE)') {
                $daerahValues = [
                    'Kab. Kuningan' => 6.98,
                    'Kab. Majalengka' => 6.86,
                    'Kab. Bandung' => 6.32,
                    'Kab. Cirebon' => 6.23,
                    'Kab. Garut' => 5.95,
                    'Kab. Cianjur' => 5.75,
                    'Kab. Sukabumi' => 5.69,
                    'Kab. Pangandaran' => 5.64,
                    'Kota Depok' => 5.50,
                    'Kab. Sumedang' => 5.48,
                    'Kota Bogor' => 5.45,
                    'Kota Tasikmalaya' => 5.39,
                    'Kota Bekasi' => 5.39,
                    'Kab. Ciamis' => 5.37,
                    'Kota Cirebon' => 5.34,
                    'Kota Cimahi' => 5.33,
                    'Kota Sukabumi' => 5.32,
                    'Kab. Tasikmalaya' => 5.31,
                    'Kota Bandung' => 5.29,
                    'Kab. Bandung Barat' => 5.28,
                    'Kab. Purwakarta' => 5.26,
                    'Kab. Bogor' => 5.24,
                    'Kota Banjar' => 5.13,
                    'Kab. Bekasi' => 5.07,
                    'Kab. Karawang' => 5.06,
                    'Kab. Subang' => 5.01,
                    'Kab. Indramayu' => 3.09,
                ];
            } elseif ($ind['nama_indikator'] === 'Persentase Penduduk Miskin') {
                $daerahValues = [
                    'Kab. Indramayu' => 11.02,
                    'Kota Tasikmalaya' => 10.84,
                    'Kab. Kuningan' => 10.74,
                    'Kab. Majalengka' => 10.31,
                    'Kab. Cirebon' => 10.23,
                    'Kab. Tasikmalaya' => 10.15,
                    'Kab. Bandung Barat' => 9.87,
                    'Kab. Cianjur' => 9.82,
                    'Kab. Garut' => 9.39,
                    'Kab. Subang' => 9.23,
                    'Kab. Sumedang' => 8.81,
                    'Kota Cirebon' => 8.66,
                    'Kab. Pangandaran' => 8.03,
                    'Kab. Purwakarta' => 7.87,
                    'Kab. Ciamis' => 7.19,
                    'Kab. Karawang' => 7.08,
                    'Kota Sukabumi' => 6.90,
                    'Kab. Sukabumi' => 6.41,
                    'Kab. Bogor' => 6.26,
                    'Kab. Bandung' => 6.04,
                    'Kota Bogor' => 5.89,
                    'Kota Banjar' => 5.73,
                    'Kab. Bekasi' => 4.36,
                    'Kota Cimahi' => 4.20,
                    'Kota Bekasi' => 3.96,
                    'Kota Bandung' => 3.78,
                    'Kota Depok' => 2.31,
                ];
            } elseif ($ind['nama_indikator'] === 'Tingkat Pengangguran Terbuka (TPT)') {
                $daerahValues = [
                    'Kab. Bekasi' => 8.78,
                    'Kota Cimahi' => 8.75,
                    'Kota Sukabumi' => 8.19,
                    'Kab. Karawang' => 7.99,
                    'Kota Bogor' => 7.95,
                    'Kab. Bogor' => 7.69,
                    'Kab. Kuningan' => 7.59,
                    'Kab. Purwakarta' => 7.54,
                    'Kota Bekasi' => 7.33,
                    'Kab. Sukabumi' => 7.23,
                    'Kota Bandung' => 7.22,
                    'Kab. Subang' => 6.80,
                    'Kab. Bandung' => 6.68,
                    'Kab. Bandung Barat' => 6.60,
                    'Kab. Garut' => 6.54,
                    'Kota Depok' => 6.52,
                    'Kab. Indramayu' => 6.47,
                    'Kota Tasikmalaya' => 6.43,
                    'Kab. Cirebon' => 6.42,
                    'Kota Cirebon' => 6.41,
                    'Kab. Cianjur' => 6.17,
                    'Kab. Sumedang' => 6.08,
                    'Kota Banjar' => 5.26,
                    'Kab. Ciamis' => 4.08,
                    'Kab. Tasikmalaya' => 3.69,
                    'Kab. Majalengka' => 3.62,
                    'Kab. Pangandaran' => 1.91,
                ];
            } else { // Laju Inflasi
                $daerahValues = [
                    'Kota Sukabumi' => 3.87,
                    'Kota Bogor' => 3.08,
                    'Kab. Majalengka' => 2.99,
                    'Kota Cirebon' => 2.90,
                    'Kota Bekasi' => 2.84,
                    'Kota Tasikmalaya' => 2.66,
                    'Kota Depok' => 2.54,
                    'Kota Bandung' => 2.53,
                    'Kab. Bandung' => 2.23,
                    'Kab. Subang' => 2.18,
                ];
            }

            foreach ($daerahValues as $daerah => $val) {
                DataIndikatorMakro::updateOrCreate(
                    [
                        'indikator_id' => $indikator->id,
                        'tahun' => 2025,
                        'nama_daerah' => $daerah,
                    ],
                    [
                        'nilai' => $val,
                        'is_kota_tasik' => ($daerah === 'Kota Tasikmalaya'),
                    ]
                );
            }
        }
    }
}
