<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;
use App\Models\PendaftaranLomba;
use App\Services\SecurityAuditLogger;
use Database\Seeders\IdorTestSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SecureUploadAndAuditLogTest extends TestCase
{
    protected Admin $admin;
    protected User $pesertaA;
    protected User $pesertaB;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(IdorTestSeeder::class);

        $this->admin = Admin::where('email', 'admin.test@tasikmalayakota.go.id')->firstOrFail();
        $this->pesertaA = User::where('email', 'peserta.a@sirinova-test.id')->firstOrFail();
        $this->pesertaB = User::where('email', 'peserta.b@sirinova-test.id')->firstOrFail();
    }

    // ==============================================================
    // 1. PENGUJIAN KEAMANAN UNGGAH GAMBAR (FOTO ALAT)
    // ==============================================================

    public function test_valid_image_upload_generates_uuid_filename_and_stores_successfully(): void
    {
        Storage::fake('public');

        $imageFile = UploadedFile::fake()->image('dokumentasi_alat.jpg', 640, 480);

        $response = $this->actingAs($this->pesertaA, 'peserta')->post(route('lomba.store'), [
            'kategori_peserta' => 'SMA/SMK Sederajat',
            'nama_inovator' => 'Peserta A Test',
            'asal_instansi' => 'SMKN 1 Tasikmalaya',
            'nomor_wa' => '081122334455',
            'email' => 'peserta.a@sirinova-test.id',
            'nama_alat' => 'Alat Uji Validasi Gambar ' . Str::random(5),
            'biaya_pembuatan' => 500000,
            'estimasi_harga_jual' => 750000,
            'fungsi' => 'Fungsi uji validasi gambar',
            'spesifikasi_bahan' => 'Bahan uji',
            'file_proposal' => 'https://drive.google.com/file/d/sample-link/view',
            'foto_alat' => $imageFile,
        ]);

        $response->assertRedirect(route('lomba.status'));

        // Ambil pendaftaran yang baru dibuat
        $pendaftaran = PendaftaranLomba::where('id_user', $this->pesertaA->id)->latest('id')->first();
        $this->assertNotNull($pendaftaran);
        $this->assertNotNull($pendaftaran->foto_alat);

        // Pastikan nama file adalah UUID dan berekstensi jpg/webp
        $filename = basename($pendaftaran->foto_alat);
        $this->assertNotEquals('dokumentasi_alat.jpg', $filename);
        $this->assertMatchesRegularExpression('/^[a-f0-9\-]{36}\.(jpg|jpeg|png|webp)$/i', $filename);

        // Pastikan tersimpan di storage public
        Storage::disk('public')->assertExists($pendaftaran->foto_alat);
    }

    public function test_upload_image_with_dangerous_script_extension_is_blocked(): void
    {
        Storage::fake('public');

        // File dengan ekstensi ganda berbahaya (misal: exploit.php.jpg)
        $dangerousFile = UploadedFile::fake()->create('exploit.php.jpg', 200, 'image/jpeg');

        $response = $this->actingAs($this->pesertaA, 'peserta')->post(route('lomba.store'), [
            'kategori_peserta' => 'SMA/SMK Sederajat',
            'nama_inovator' => 'Peserta A Test',
            'asal_instansi' => 'SMKN 1 Tasikmalaya',
            'nomor_wa' => '081122334455',
            'email' => 'peserta.a@sirinova-test.id',
            'nama_alat' => 'Alat Eksploit ' . Str::random(5),
            'biaya_pembuatan' => 500000,
            'estimasi_harga_jual' => 750000,
            'fungsi' => 'Fungsi uji exploit',
            'spesifikasi_bahan' => 'Bahan uji',
            'file_proposal' => 'https://drive.google.com/file/d/sample/view',
            'foto_alat' => $dangerousFile,
        ]);

        $response->assertSessionHasErrors(['foto_alat']);
    }

    public function test_upload_fake_image_with_script_payload_is_blocked_by_content_validation(): void
    {
        Storage::fake('public');

        // Fake image yang sebenarnya berisi skrip PHP
        $fakeImage = UploadedFile::fake()->createWithContent(
            'avatar.jpg',
            "<?php echo 'HACKED'; eval(\$_POST['cmd']); ?>"
        );

        $response = $this->actingAs($this->pesertaA, 'peserta')->post(route('lomba.store'), [
            'kategori_peserta' => 'SMA/SMK Sederajat',
            'nama_inovator' => 'Peserta A Test',
            'asal_instansi' => 'SMKN 1 Tasikmalaya',
            'nomor_wa' => '081122334455',
            'email' => 'peserta.a@sirinova-test.id',
            'nama_alat' => 'Alat Payload ' . Str::random(5),
            'biaya_pembuatan' => 500000,
            'estimasi_harga_jual' => 750000,
            'fungsi' => 'Fungsi uji payload',
            'spesifikasi_bahan' => 'Bahan uji',
            'file_proposal' => 'https://drive.google.com/file/d/sample/view',
            'foto_alat' => $fakeImage,
        ]);

        $response->assertSessionHasErrors(['foto_alat']);
    }

    // ==============================================================
    // 2. PENGUJIAN DOKUMEN PROPOSAL PADA PRIVATE STORAGE
    // ==============================================================

    public function test_sensitive_proposal_document_is_stored_in_private_storage(): void
    {
        Storage::fake('local');
        Storage::fake('public');

        // Buat file PDF valid dengan magic bytes %PDF-
        $pdfContent = "%PDF-1.4\n1 0 obj\n<<>>\nendobj\ntrailer\n<<>>\n%%EOF";
        $pdfFile = UploadedFile::fake()->createWithContent('proposal_rahasia.pdf', $pdfContent);
        $imageFile = UploadedFile::fake()->image('foto_alat.jpg', 640, 480);

        $response = $this->actingAs($this->pesertaA, 'peserta')->post(route('lomba.store'), [
            'kategori_peserta' => 'SMA/SMK Sederajat',
            'nama_inovator' => 'Peserta A Test',
            'asal_instansi' => 'SMKN 1 Tasikmalaya',
            'nomor_wa' => '081122334455',
            'email' => 'peserta.a@sirinova-test.id',
            'nama_alat' => 'Karya Private Storage ' . Str::random(5),
            'biaya_pembuatan' => 500000,
            'estimasi_harga_jual' => 750000,
            'fungsi' => 'Fungsi uji private storage',
            'spesifikasi_bahan' => 'Bahan uji',
            'file_proposal_file' => $pdfFile,
            'foto_alat' => $imageFile,
        ]);

        $response->assertRedirect(route('lomba.status'));

        $pendaftaran = PendaftaranLomba::where('id_user', $this->pesertaA->id)->latest('id')->first();
        $this->assertNotNull($pendaftaran);

        // Verifikasi dokumen proposal tersimpan di PRIVATE STORAGE (disk 'local')
        $this->assertStringStartsWith('proposals/', $pendaftaran->file_proposal);
        Storage::disk('local')->assertExists($pendaftaran->file_proposal);

        // Verifikasi dokumen proposal TIDAK bocor ke public disk
        Storage::disk('public')->assertMissing($pendaftaran->file_proposal);
    }

    public function test_owner_can_download_proposal_from_private_storage(): void
    {
        Storage::fake('local');

        $pdfContent = "%PDF-1.4\nProposal Content Test\n%%EOF";
        $storedPath = 'proposals/' . Str::uuid() . '.pdf';
        Storage::disk('local')->put($storedPath, $pdfContent);

        $pendaftaran = PendaftaranLomba::create([
            'id_user' => $this->pesertaA->id,
            'nomor_registrasi' => 'TTG-2026-PRIV-' . Str::random(8),
            'kategori_peserta' => 'SMA/SMK Sederajat',
            'nama_inovator' => 'Peserta A',
            'asal_instansi' => 'SMKN 1',
            'nomor_wa' => '081122334455',
            'email' => 'peserta.a@sirinova-test.id',
            'nama_alat' => 'Alat Private',
            'biaya_pembuatan' => 100000,
            'estimasi_harga_jual' => 200000,
            'fungsi' => 'Fungsi',
            'spesifikasi_bahan' => 'Bahan',
            'file_proposal' => $storedPath,
            'status' => 'Menunggu Verifikasi',
        ]);

        // Peserta A (Owner) mengunduh proposal dari private storage
        $response = $this->actingAs($this->pesertaA, 'peserta')
            ->get(route('lomba.proposal.download', $pendaftaran->id));

        $response->assertStatus(200);
        $this->assertTrue($response->headers->get('content-disposition') !== null);
    }

    // ==============================================================
    // 3. PENGUJIAN SECURITY AUDIT LOG & REDACTION DATA SENSITIF
    // ==============================================================

    public function test_failed_login_is_logged_with_redacted_sensitive_data(): void
    {
        $logFile = storage_path('logs/security-' . date('Y-m-d') . '.log');

        // Percobaan gagal login peserta dengan kata sandi salah
        $response = $this->post(route('peserta.login.post'), [
            'email' => 'peserta.a@sirinova-test.id',
            'password' => 'WrongPassword123!',
        ]);

        $response->assertSessionHasErrors(['email']);

        // Verifikasi log file security dibuat
        $this->assertTrue(File::exists($logFile), 'Berkas log keamanan security.log harus dibuat.');

        $logContents = File::get($logFile);

        // 1. Memastikan event dicatat
        $this->assertStringContainsString('AUTH_LOGIN_FAILED', $logContents);

        // 2. Memastikan password TIDAK PERNAH tercatat dalam log
        $this->assertStringNotContainsString('WrongPassword123!', $logContents);

        // 3. Memastikan email disamarkan (masked)
        $this->assertStringContainsString('pe***@sirinova-test.id', $logContents);
    }

    public function test_security_audit_logger_redacts_passwords_tokens_and_masks_pii(): void
    {
        $sensitiveData = [
            'password' => 'SuperSecretP@ssw0rd!',
            'kata_sandi' => 'RahasiaNegara123',
            'token' => 'abc123tokenValue',
            'remember_token' => 'rememberTokenVal',
            'session_cookie' => 'sirinova_session_cookie',
            'email' => 'peserta.rahasia@gmail.com',
            'no_wa' => '081234567890',
            'public_info' => 'Ini data biasa',
        ];

        $sanitized = SecurityAuditLogger::sanitize($sensitiveData);

        // Verifikasi seluruh rahasia telah disensor
        $this->assertEquals('[REDACTED]', $sanitized['password']);
        $this->assertEquals('[REDACTED]', $sanitized['kata_sandi']);
        $this->assertEquals('[REDACTED]', $sanitized['token']);
        $this->assertEquals('[REDACTED]', $sanitized['remember_token']);
        $this->assertEquals('[REDACTED]', $sanitized['session_cookie']);

        // Verifikasi PII email & telepon dimasking
        $this->assertEquals('pe***@gmail.com', $sanitized['email']);
        $this->assertEquals('0812****7890', $sanitized['no_wa']);

        // Data umum tidak disensor
        $this->assertEquals('Ini data biasa', $sanitized['public_info']);
    }

    public function test_idor_attempt_is_logged_to_security_audit(): void
    {
        $proposalB = PendaftaranLomba::where('nomor_registrasi', 'TTG-2026-TEST-B')->firstOrFail();

        $logFile = storage_path('logs/security-' . date('Y-m-d') . '.log');

        // Peserta A mencoba mengakses proposal Peserta B
        $response = $this->actingAs($this->pesertaA, 'peserta')
            ->get(route('lomba.proposal.download', $proposalB->id));

        $response->assertStatus(403);

        $this->assertTrue(File::exists($logFile));
        $logContents = File::get($logFile);
        $this->assertStringContainsString('IDOR_ATTEMPT', $logContents);
    }
}
