<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\PendaftaranLomba;

class IdorTestSeeder extends Seeder
{
    /**
     * Run the database seeds for IDOR & Access Control Automated Testing.
     * Membuat 1 akun Admin dan 2 akun Peserta sintetis/dummy beserta masing-masing data proposal.
     */
    public function run(): void
    {
        // 1. Akun Admin Uji
        $admin = Admin::updateOrCreate(
            ['email' => 'admin.test@tasikmalayakota.go.id'],
            [
                'nama' => 'Admin Penguji IDOR',
                'kata_sandi' => Hash::make('AdminTest123!'),
                'dibuat_pada' => now(),
                'diperbarui_pada' => now(),
            ]
        );

        // 2. Akun Peserta A (Owner Proposal A)
        $pesertaA = User::updateOrCreate(
            ['email' => 'peserta.a@sirinova-test.id'],
            [
                'name' => 'Peserta A (Owner Proposal A)',
                'password' => Hash::make('PesertaA123!'),
                'no_wa' => '081122334455',
                'asal_instansi' => 'SMKN 1 Tasikmalaya',
                'kategori' => 'SMA/SMK Sederajat',
            ]
        );

        // 3. Akun Peserta B (Owner Proposal B)
        $pesertaB = User::updateOrCreate(
            ['email' => 'peserta.b@sirinova-test.id'],
            [
                'name' => 'Peserta B (Owner Proposal B)',
                'password' => Hash::make('PesertaB123!'),
                'no_wa' => '082233445566',
                'asal_instansi' => 'Universitas Siliwangi',
                'kategori' => 'Perguruan Tinggi',
            ]
        );

        // 4. Data Proposal Milik Peserta A
        PendaftaranLomba::updateOrCreate(
            ['nomor_registrasi' => 'TTG-2026-TEST-A'],
            [
                'id_user' => $pesertaA->id,
                'kategori_peserta' => 'SMA/SMK Sederajat',
                'nama_inovator' => 'Peserta A (Owner Proposal A)',
                'nama_anggota' => 'Anggota A1, Anggota A2',
                'asal_instansi' => 'SMKN 1 Tasikmalaya',
                'nomor_wa' => '081122334455',
                'email' => 'peserta.a@sirinova-test.id',
                'nama_alat' => 'Sistem Filter Air Otomatis A',
                'biaya_pembuatan' => 500000,
                'estimasi_harga_jual' => 750000,
                'fungsi' => 'Menyaring air limbah menjadi air bersih',
                'spesifikasi_bahan' => 'Pipa PVC, Karbon Aktif, Pasir Silika',
                'latar_belakang' => 'Uji IDOR Proposal A',
                'file_proposal' => 'https://drive.google.com/file/d/test-proposal-peserta-a/view',
                'foto_alat' => 'foto_lomba/test_a.jpg',
                'link_video' => 'https://youtube.com/watch?v=test_a',
                'status' => 'Menunggu Verifikasi',
                'dibuat_pada' => now(),
                'diperbarui_pada' => now(),
            ]
        );

        // 5. Data Proposal Milik Peserta B
        PendaftaranLomba::updateOrCreate(
            ['nomor_registrasi' => 'TTG-2026-TEST-B'],
            [
                'id_user' => $pesertaB->id,
                'kategori_peserta' => 'Perguruan Tinggi',
                'nama_inovator' => 'Peserta B (Owner Proposal B)',
                'nama_anggota' => 'Anggota B1, Anggota B2',
                'asal_instansi' => 'Universitas Siliwangi',
                'nomor_wa' => '082233445566',
                'email' => 'peserta.b@sirinova-test.id',
                'nama_alat' => 'Mesin Pirolisis Sampah Plastik B',
                'biaya_pembuatan' => 1500000,
                'estimasi_harga_jual' => 2500000,
                'fungsi' => 'Mengubah limbah plastik menjadi bahan bakar cair alternatif',
                'spesifikasi_bahan' => 'Reaktor Stainless Steel, Tabung Kondensor, Pemanas Gas',
                'latar_belakang' => 'Uji IDOR Proposal B',
                'file_proposal' => 'https://drive.google.com/file/d/test-proposal-peserta-b/view',
                'foto_alat' => 'foto_lomba/test_b.jpg',
                'link_video' => 'https://youtube.com/watch?v=test_b',
                'status' => 'Menunggu Verifikasi',
                'dibuat_pada' => now(),
                'diperbarui_pada' => now(),
            ]
        );
    }
}
