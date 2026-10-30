<?php

namespace Tests\Feature;

use App\Models\PendaftaranLomba;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLombaExportAndAjaxTest extends TestCase
{
    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::firstOrCreate(
            ['email' => 'admin_test_export@tasikmalayakota.go.id'],
            [
                'name' => 'Admin Test Export',
                'password' => bcrypt('AdminPassword123!'),
                'role' => 'admin',
            ]
        );
    }

    public function test_admin_can_download_lomba_pdf_export()
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.lomba.export.pdf'));

        $response->assertStatus(200);
        $this->assertTrue(
            str_contains($response->headers->get('content-type'), 'application/pdf') ||
            str_contains($response->headers->get('content-disposition'), '.pdf')
        );
    }

    public function test_admin_can_download_lomba_excel_export()
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.lomba.export.excel'));

        $response->assertStatus(200);
        $this->assertTrue(
            str_contains($response->headers->get('content-type'), 'spreadsheet') ||
            str_contains($response->headers->get('content-disposition'), '.xlsx')
        );
    }

    public function test_admin_can_delete_lomba_via_ajax_without_page_reload()
    {
        $dummy = PendaftaranLomba::create([
            'id_user' => $this->adminUser->id,
            'nomor_registrasi' => 'TTG-TEST-AJAX-' . rand(1000, 9999),
            'nama_alat' => 'Alat Test AJAX Delete',
            'kategori_peserta' => 'Umum',
            'nama_inovator' => 'Inovator Test',
            'asal_instansi' => 'Bappelitbangda Kota Tasikmalaya',
            'nomor_wa' => '081234567890',
            'email' => 'inovator_test@example.com',
            'fungsi' => 'Fungsi pengujian penghapusan AJAX',
            'spesifikasi_bahan' => 'Bahan pengujian',
            'file_proposal' => 'proposals/dummy_test.pdf',
            'biaya_pembuatan' => 100000,
            'estimasi_harga_jual' => 200000,
            'status' => 'Menunggu Verifikasi',
        ]);

        $response = $this->actingAs($this->adminUser)
            ->deleteJson(route('admin.lomba.destroy', $dummy->id));

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseMissing('pendaftaran_lomba', ['id' => $dummy->id]);
    }
}
