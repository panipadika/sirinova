<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;
use App\Models\PendaftaranLomba;
use Database\Seeders\IdorTestSeeder;

class AccessControlIdorTest extends TestCase
{
    protected Admin $admin;
    protected User $pesertaA;
    protected User $pesertaB;
    protected PendaftaranLomba $proposalA;
    protected PendaftaranLomba $proposalB;

    protected function setUp(): void
    {
        parent::setUp();

        // Jalankan Seeder khusus pengujian IDOR
        $this->seed(IdorTestSeeder::class);

        $this->admin = Admin::where('email', 'admin.test@tasikmalayakota.go.id')->firstOrFail();
        $this->pesertaA = User::where('email', 'peserta.a@sirinova-test.id')->firstOrFail();
        $this->pesertaB = User::where('email', 'peserta.b@sirinova-test.id')->firstOrFail();
        $this->proposalA = PendaftaranLomba::where('nomor_registrasi', 'TTG-2026-TEST-A')->firstOrFail();
        $this->proposalB = PendaftaranLomba::where('nomor_registrasi', 'TTG-2026-TEST-B')->firstOrFail();
    }

    // ==========================================
    // 1. MATRIKS AKSES: ANONYMOUS (TANPA LOGIN)
    // ==========================================

    public function test_anonymous_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');

        // Middleware Authenticate memproteksi admin route dan menyamarkan rute dengan 404
        $this->assertTrue(in_array($response->status(), [404, 401, 403, 302]));
    }

    public function test_anonymous_cannot_access_peserta_daftar(): void
    {
        $response = $this->get('/lomba-ttg/daftar');

        $response->assertRedirect(route('peserta.login'));
    }

    public function test_anonymous_cannot_access_peserta_status(): void
    {
        $response = $this->get('/lomba-ttg/status');

        $response->assertRedirect(route('peserta.login'));
    }

    public function test_anonymous_cannot_download_proposal(): void
    {
        $response = $this->get(route('lomba.proposal.download', $this->proposalA->id));

        $response->assertRedirect(route('peserta.login'));
    }

    // ==========================================
    // 2. MATRIKS AKSES: PESERTA A (OWNER A)
    // ==========================================

    public function test_peserta_a_can_download_own_proposal(): void
    {
        $response = $this->actingAs($this->pesertaA, 'peserta')
            ->get(route('lomba.proposal.download', $this->proposalA->id));

        // Karena tautan proposal berupa Google Drive URL, response adalah redirect ke URL proposal
        $response->assertRedirect($this->proposalA->file_proposal);
    }

    public function test_peserta_a_forbidden_accessing_peserta_b_proposal_idor_blocked(): void
    {
        $response = $this->actingAs($this->pesertaA, 'peserta')
            ->get(route('lomba.proposal.download', $this->proposalB->id));

        // Verifikasi mutlak: Akses ke proposal peserta lain ditolak dengan HTTP 403 Forbidden
        $response->assertStatus(403);
    }

    public function test_peserta_a_cannot_access_admin_dashboard(): void
    {
        $response = $this->actingAs($this->pesertaA, 'peserta')
            ->get('/admin/dashboard');

        // Peserta tidak memiliki guard web (admin), sehingga ditolak (404/403)
        $this->assertTrue(in_array($response->status(), [403, 404, 302]));
    }

    // ==========================================
    // 3. MATRIKS AKSES: PESERTA B (OWNER B)
    // ==========================================

    public function test_peserta_b_can_download_own_proposal(): void
    {
        $response = $this->actingAs($this->pesertaB, 'peserta')
            ->get(route('lomba.proposal.download', $this->proposalB->id));

        $response->assertRedirect($this->proposalB->file_proposal);
    }

    public function test_peserta_b_forbidden_accessing_peserta_a_proposal_idor_blocked(): void
    {
        $response = $this->actingAs($this->pesertaB, 'peserta')
            ->get(route('lomba.proposal.download', $this->proposalA->id));

        // Verifikasi mutlak: Akses ke proposal milik Peserta A ditolak dengan HTTP 403 Forbidden
        $response->assertStatus(403);
    }

    public function test_peserta_b_cannot_access_admin_dashboard(): void
    {
        $response = $this->actingAs($this->pesertaB, 'peserta')
            ->get('/admin/dashboard');

        $this->assertTrue(in_array($response->status(), [403, 404, 302]));
    }

    // ==========================================
    // 4. MATRIKS AKSES: ADMIN (ROLE ADMIN)
    // ==========================================

    public function test_admin_can_access_admin_dashboard(): void
    {
        $response = $this->actingAs($this->admin, 'web')
            ->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_admin_can_access_peserta_a_proposal(): void
    {
        $response = $this->actingAs($this->admin, 'web')
            ->get(route('lomba.proposal.download', $this->proposalA->id));

        $response->assertRedirect($this->proposalA->file_proposal);
    }

    public function test_admin_can_access_peserta_b_proposal(): void
    {
        $response = $this->actingAs($this->admin, 'web')
            ->get(route('lomba.proposal.download', $this->proposalB->id));

        $response->assertRedirect($this->proposalB->file_proposal);
    }

    public function test_admin_can_view_lomba_detail_in_admin_panel(): void
    {
        $response = $this->actingAs($this->admin, 'web')
            ->get(route('admin.lomba.show', $this->proposalA->id));

        $response->assertStatus(200);
    }

    // ==========================================
    // 5. EDGE CASE: PROPOSAL TIDAK DITEMUKAN
    // ==========================================

    public function test_non_existent_proposal_returns_404(): void
    {
        $response = $this->actingAs($this->pesertaA, 'peserta')
            ->get(route('lomba.proposal.download', 99999999));

        $response->assertStatus(404);
    }
}
