<?php

namespace Tests\Feature;

use App\Models\PendaftaranLomba;
use App\Models\User;
use Tests\TestCase;

class AdminLombaAkunPesertaTest extends TestCase
{
    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::firstOrCreate(
            ['email' => 'admin_test_akun@tasikmalayakota.go.id'],
            [
                'name' => 'Admin Test Akun Peserta',
                'password' => bcrypt('AdminPassword123!'),
                'role' => 'admin',
            ]
        );
    }

    public function test_admin_can_access_akun_peserta_index_page()
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.lomba.akun.index'));

        $response->assertStatus(200);
        $response->assertSee('Daftar Akun Peserta Lomba TTG');
        $response->assertSee('Data Karya Inovasi');
    }

    public function test_admin_can_search_and_filter_akun_peserta()
    {
        $uniqueEmail = 'peserta_filter_' . uniqid() . '@example.com';
        $user = User::create([
            'name' => 'Peserta Filter Unik',
            'email' => $uniqueEmail,
            'password' => bcrypt('password123'),
            'kategori' => 'Perguruan Tinggi',
            'asal_instansi' => 'Universitas Siliwangi Tasikmalaya',
            'no_wa' => '081299990001',
        ]);

        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.lomba.akun.index', ['q' => 'Peserta Filter Unik', 'kategori' => 'Perguruan Tinggi']));

        $response->assertStatus(200);
        $response->assertSee('Peserta Filter Unik');
        $response->assertSee('Universitas Siliwangi Tasikmalaya');

        $user->delete();
    }

    public function test_admin_can_fetch_akun_detail_via_ajax()
    {
        $user = User::create([
            'name' => 'Peserta Detail Test',
            'email' => 'peserta_detail_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
            'kategori' => 'Umum',
            'asal_instansi' => 'Komunitas TTG Tasikmalaya',
            'no_wa' => '081299990002',
        ]);

        $karya = PendaftaranLomba::create([
            'id_user' => $user->id,
            'nomor_registrasi' => 'TTG-DETAIL-' . rand(1000, 9999),
            'nama_alat' => 'Alat Filter Air Otomatis',
            'kategori_peserta' => 'Umum',
            'nama_inovator' => 'Peserta Detail Test',
            'asal_instansi' => 'Komunitas TTG Tasikmalaya',
            'nomor_wa' => '081299990002',
            'email' => $user->email,
            'fungsi' => 'Menyaring air sungai menjadi air bersih layak pakai',
            'spesifikasi_bahan' => 'Pipa PVC, Arang Aktif, Pasir Silika',
            'file_proposal' => 'proposals/dummy_proposal.pdf',
            'status' => 'Menunggu Verifikasi',
        ]);

        $response = $this->actingAs($this->adminUser)
            ->getJson(route('admin.lomba.akun.show', $user->id));

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => 'Peserta Detail Test',
            'kategori' => 'Umum',
            'nama_alat' => 'Alat Filter Air Otomatis',
        ]);

        $karya->delete();
        $user->delete();
    }

    public function test_admin_can_download_akun_peserta_pdf_export()
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.lomba.akun.export.pdf'));

        $response->assertStatus(200);
        $this->assertTrue(
            str_contains($response->headers->get('content-type'), 'application/pdf') ||
            str_contains($response->headers->get('content-disposition'), '.pdf')
        );
    }

    public function test_admin_can_download_akun_peserta_excel_export()
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.lomba.akun.export.excel'));

        $response->assertStatus(200);
        $this->assertTrue(
            str_contains($response->headers->get('content-type'), 'spreadsheet') ||
            str_contains($response->headers->get('content-disposition'), '.xlsx')
        );
    }

    public function test_admin_can_access_akun_peserta_print_page()
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.lomba.akun.print'));

        $response->assertStatus(200);
        $response->assertSee('REKAPITULASI DAFTAR AKUN PESERTA LOMBA TEKNOLOGI TEPAT GUNA (TTG)');
    }

    public function test_admin_can_delete_akun_peserta_via_ajax()
    {
        $user = User::create([
            'name' => 'Peserta Ajax Delete',
            'email' => 'peserta_ajax_del_' . uniqid() . '@example.com',
            'password' => bcrypt('password123'),
            'kategori' => 'SMA/SMK Sederajat',
            'asal_instansi' => 'SMKN 1 Tasikmalaya',
            'no_wa' => '081299990003',
        ]);

        $response = $this->actingAs($this->adminUser)
            ->deleteJson(route('admin.lomba.akun.destroy', $user->id));

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseMissing('user', [
            'id' => $user->id,
        ]);
    }
}
