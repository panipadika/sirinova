<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;
use Illuminate\Support\Facades\File;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure directory exists
        $targetDir = storage_path('app/public/galeri/photos');
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        // Source sample images from existing storage/app/public/alat_ttg
        $sourceFiles = File::files(storage_path('app/public/alat_ttg'));

        $samples = [
            [
                'judul'            => 'Pameran & Gelar Teknologi Tepat Guna (TTG) Kota Tasikmalaya 2024',
                'tanggal_kegiatan' => '2024-05-15',
                'lokasi'           => 'Gedung Bale Kota Tasikmalaya',
                'deskripsi'        => 'Pelaksanaan pameran inovasi teknologi tepat guna unggulan yang diikuti oleh Posyantek Se-Kota Tasikmalaya untuk mendukung kemandirian ekonomi masyarakat.',
                'status'           => 'Dipublikasikan',
            ],
            [
                'judul'            => 'Bimbingan Teknis & Pelatihan Pengoperasian Mesin Pengolah Sampah Organik',
                'tanggal_kegiatan' => '2024-06-20',
                'lokasi'           => 'Kecamatan Cihideung, Kota Tasikmalaya',
                'deskripsi'        => 'Pelatihan pengoperasian mesin pencacah sampah dan pembuat kompos bagi kelompok tani dan pengurus Posyantek setempat.',
                'status'           => 'Dipublikasikan',
            ],
            [
                'judul'            => 'Monitoring & Evaluasi Alat TTG Bidang Pertanian dan Peternakan',
                'tanggal_kegiatan' => '2024-07-10',
                'lokasi'           => 'Kecamatan Kawalu, Kota Tasikmalaya',
                'deskripsi'        => 'Pendataan serta evaluasi efektivitas penggunaan alat pembuat pakan ternak otomatis oleh Tim Bappelitbangda Kota Tasikmalaya.',
                'status'           => 'Dipublikasikan',
            ],
            [
                'judul'            => 'Penyerahan Bantuan Alat Mesin Pengolah Produk Hasil Olahan Pangan',
                'tanggal_kegiatan' => '2024-08-05',
                'lokasi'           => 'Aula Bappelitbangda Kota Tasikmalaya',
                'deskripsi'        => 'Penyerahan bantuan unit alat Spinner Peniris Minyak kepada UMKM dan Inovator lokal untuk meningkatkan kualitas kemasan produk unggulan.',
                'status'           => 'Dipublikasikan',
            ],
            [
                'judul'            => 'Sosialisasi Pemetaan Kebutuhan Inovasi TTG Kecamatan Cipedes',
                'tanggal_kegiatan' => '2024-08-22',
                'lokasi'           => 'Kantor Kecamatan Cipedes',
                'deskripsi'        => 'Pembahasan awal penyusunan kaji kebutuhan teknologi tepat guna guna mendukung program percepatan pembangunan daerah.',
                'status'           => 'Draft',
            ],
        ];

        // Clear existing entries before seeding
        Galeri::truncate();

        foreach ($samples as $index => $sample) {
            $fotoPath = null;
            if (isset($sourceFiles[$index])) {
                $source = $sourceFiles[$index]->getRealPath();
                $filename = 'sample_galeri_' . ($index + 1) . '.jpg';
                $dest = $targetDir . '/' . $filename;
                File::copy($source, $dest);
                $fotoPath = 'storage/galeri/photos/' . $filename;
            }

            // Create 2-4 supporting photos per sample item using available files
            $supportingPaths = [];
            for ($s = 1; $s <= 3; $s++) {
                $srcIdx = ($index + $s) % count($sourceFiles);
                if (isset($sourceFiles[$srcIdx])) {
                    $source = $sourceFiles[$srcIdx]->getRealPath();
                    $filenameSupport = 'sample_galeri_' . ($index + 1) . '_support_' . $s . '.jpg';
                    $destSupport = $targetDir . '/' . $filenameSupport;
                    File::copy($source, $destSupport);
                    $supportingPaths[] = 'storage/galeri/photos/' . $filenameSupport;
                }
            }

            Galeri::create([
                'judul'            => $sample['judul'],
                'tanggal_kegiatan' => $sample['tanggal_kegiatan'],
                'lokasi'           => $sample['lokasi'],
                'deskripsi'        => $sample['deskripsi'],
                'status'           => $sample['status'],
                'foto'             => $fotoPath,
                'foto_pendukung'   => $supportingPaths,
            ]);
        }
    }
}
