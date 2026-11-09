<?php

namespace Tests\Feature;

use App\Models\AlatTtg;
use App\Models\User;
use Tests\TestCase;

class AlatExportPdfTest extends TestCase
{
    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::firstOrCreate(
            ['email' => 'admin_test_alat_pdf@tasikmalayakota.go.id'],
            [
                'name' => 'Admin Test Alat PDF',
                'password' => bcrypt('AdminPassword123!'),
                'role' => 'admin',
            ]
        );
    }

    public function test_admin_can_download_alat_pdf_export()
    {
        $response = $this->actingAs($this->adminUser)->get(route('alat.pdf'));

        $response->assertStatus(200);
        $this->assertTrue(
            str_contains($response->headers->get('content-type', ''), 'application/pdf') ||
            str_contains($response->headers->get('content-disposition', ''), '.pdf')
        );
    }

    public function test_admin_can_access_alat_print_page()
    {
        $response = $this->actingAs($this->adminUser)->get(route('alat.print'));

        $response->assertStatus(200);
        $response->assertSee('Laporan Data Alat Teknologi Tepat Guna');
        $response->assertSee('Pemerintah Kota Tasikmalaya');
    }

    public function test_print_view_renders_cleanly_without_exception()
    {
        $alatList = AlatTtg::with(['inovator', 'kategori', 'wilayah'])->get();
        $rendered = view('admin.alatTTG.print', ['alatTtg' => $alatList])->render();

        $this->assertIsString($rendered);
        $this->assertStringContainsString('Laporan Data Alat Teknologi Tepat Guna (TTG)', $rendered);
    }
}
