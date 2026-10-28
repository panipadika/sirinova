<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\InovatorController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\TelaahanStafController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\IndikatorMakroController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\PesertaAuthController;
use App\Http\Controllers\AdminLombaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama Publik, Katalog, Kategori, Wilayah & Tentang
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/katalog', [PublicController::class, 'katalog'])->name('katalog.index');
Route::get('/kategori', [PublicController::class, 'kategoriPage'])->name('public.kategori');
Route::get('/kategori/{id}', [PublicController::class, 'kategoriDetail'])->name('public.kategori.detail');
Route::get('/wilayah', [PublicController::class, 'wilayahPage'])->name('public.wilayah');
Route::get('/wilayah/{id}', [PublicController::class, 'wilayahDetail'])->name('public.wilayah.detail');
Route::get('/tentang', [PublicController::class, 'tentangPage'])->name('public.tentang');
Route::get('/indikator-makro', [PublicController::class, 'indikatorMakroPage'])->name('public.indikator-makro');
Route::get('/ebook-kajian', [PublicController::class, 'ebookPage'])->name('public.ebook');
Route::get('/ebook-kajian/detail/{id}', [PublicController::class, 'ebookDetail'])->name('public.ebook.detail');
Route::get('/telaahan-staf', [PublicController::class, 'telaahanStafPage'])->name('public.telaahan-staf');
Route::get('/telaahan-staf/detail/{id}', [PublicController::class, 'telaahanStafDetail'])->name('public.telaahan-staf.detail');
Route::get('/galeri', [PublicController::class, 'galeriPage'])->name('public.galeri');
Route::get('/galeri/detail/{id}', [PublicController::class, 'galeriDetail'])->name('public.galeri.detail');
Route::get('/katalog/{id}', [PublicController::class, 'show'])->name('katalog.show');
Route::get('/alat/detail/{id}', [PublicController::class, 'detail'])->name('public.alat.detail');

// Route Form Pesan Publik (Tanpa Login, Rate-Limited 3x per menit)
Route::post('/pesan', [PesanController::class, 'store'])->middleware('throttle:3,1')->name('pesan.store');

// Route Fitur Lomba TTG (Publik, Registrasi/Login Peserta, dan Pengajuan)
Route::get('/lomba-ttg', [LombaController::class, 'index'])->name('lomba.info');
Route::get('/lomba-ttg/register', [PesertaAuthController::class, 'showRegisterForm'])->name('peserta.register');
Route::post('/lomba-ttg/register', [PesertaAuthController::class, 'register'])->name('peserta.register.post');
Route::get('/lomba-ttg/login', [PesertaAuthController::class, 'showLoginForm'])->name('peserta.login');
Route::post('/lomba-ttg/login', [PesertaAuthController::class, 'login'])->name('peserta.login.post');
Route::post('/lomba-ttg/logout', [PesertaAuthController::class, 'logout'])->name('peserta.logout');
Route::get('/lomba-ttg/lupa-password', [PesertaAuthController::class, 'showForgotPasswordForm'])->name('peserta.password.request');
Route::post('/lomba-ttg/lupa-password', [PesertaAuthController::class, 'sendResetLinkEmail'])->middleware('throttle:forgot-password')->name('peserta.password.email');
Route::get('/lomba-ttg/reset-password/{token}', [PesertaAuthController::class, 'showResetPasswordForm'])->name('peserta.password.reset');
Route::post('/lomba-ttg/reset-password', [PesertaAuthController::class, 'resetPassword'])->middleware('throttle:reset-password')->name('peserta.password.update');

// Rute Pendaftaran Lomba (Wajib Login Peserta / Guard: peserta)
Route::middleware('auth:peserta')->prefix('lomba-ttg')->group(function () {
    Route::get('/daftar', [LombaController::class, 'create'])->name('lomba.daftar');
    Route::post('/daftar', [LombaController::class, 'store'])->name('lomba.store');
    Route::get('/status', [LombaController::class, 'status'])->name('lomba.status');
});

// Download Proposal Lomba (Dapat diakses oleh Peserta pemilik proposal atau Admin)
Route::middleware('auth:peserta,web')->get('/lomba-ttg/proposal/{id}', [LombaController::class, 'downloadProposal'])->name('lomba.proposal.download');

$adminLoginSlug = \App\Models\PengaturanSistem::getAdminLoginSlug();

// Route Autentikasi Admin Khusus (Custom Admin Login URL) & Lupa Password
Route::middleware(['guest', 'throttle:10,1'])->group(function () use ($adminLoginSlug) {
    Route::get('/' . $adminLoginSlug, [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/' . $adminLoginSlug, [AuthController::class, 'prosesLogin']);

    // Fitur Lupa Password Admin
    Route::get('/admin/lupa-password', [AuthController::class, 'showForgotPasswordForm'])->name('admin.password.request');
    Route::post('/admin/lupa-password', [AuthController::class, 'sendResetLinkEmail'])->middleware('throttle:forgot-password')->name('admin.password.email');
    Route::get('/admin/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('admin.password.reset');
    Route::post('/admin/reset-password', [AuthController::class, 'resetPassword'])->middleware('throttle:reset-password')->name('admin.password.update');
});

// URL login umum seperti /login akan otomatis menghasilkan 404 jika bukan slug aktif
Route::any('/login', function () use ($adminLoginSlug) {
    if ($adminLoginSlug === 'login') {
        return app(AuthController::class)->showLoginForm();
    }
    abort(404);
});

// Alias & Proteksi Route /admin dan /admin/login (Otomatis 404 jika belum login)
Route::get('/admin', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    }
    abort(404);
});
Route::get('/admin/login', function () {
    abort(404);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route Kelompok Admin (Wajib Login / Protected Middleware Auth)
Route::middleware('auth')->prefix('admin')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Fitur Export & Print Alat TTG
    Route::get('/alat/print', [AlatController::class, 'print'])->name('alat.print');
    Route::get('/alat/export/pdf', [AlatController::class, 'exportPdf'])->name('alat.pdf');
    Route::get('/alat/export/excel', [AlatController::class, 'exportExcel'])->name('alat.excel');

    // Resource Management
    Route::resource('alat', AlatController::class)->names('admin.alat');
    Route::resource('inovator', InovatorController::class)->names('admin.inovator');
    Route::resource('kategori', KategoriController::class)->except(['show'])->names('admin.kategori');
    Route::resource('wilayah', WilayahController::class)->except(['show'])->names('admin.wilayah');
    Route::resource('ebook', EbookController::class)->except(['show'])->names('admin.ebook');
    Route::resource('telaahan-staf', TelaahanStafController::class)->except(['show'])->names('admin.telaahan-staf');
    Route::resource('galeri', GaleriController::class)->except(['show'])->names('admin.galeri');

    // Fitur Indikator Makro
    Route::get('/indikator-makro', [IndikatorMakroController::class, 'index'])->name('admin.indikator-makro.index');
    Route::post('/indikator-makro/master', [IndikatorMakroController::class, 'storeIndikator'])->name('admin.indikator-makro.store');
    Route::put('/indikator-makro/master/{id}', [IndikatorMakroController::class, 'updateIndikator'])->name('admin.indikator-makro.update');
    Route::delete('/indikator-makro/master/{id}', [IndikatorMakroController::class, 'destroyIndikator'])->name('admin.indikator-makro.destroy');

    Route::get('/indikator-makro/input', [IndikatorMakroController::class, 'inputBatch'])->name('admin.indikator-makro.input');
    Route::post('/indikator-makro/input', [IndikatorMakroController::class, 'storeBatch'])->name('admin.indikator-makro.store-batch');

    // Fitur Pesan Masuk (Kotak Masuk Admin)
    Route::get('/pesan', [PesanController::class, 'index'])->name('admin.pesan.index');
    Route::get('/pesan/{id}', [PesanController::class, 'show'])->name('admin.pesan.show');
    Route::delete('/pesan/{id}', [PesanController::class, 'destroy'])->name('admin.pesan.destroy');
    Route::patch('/pesan/{id}/toggle-dibaca', [PesanController::class, 'toggleDibaca'])->name('admin.pesan.toggle-dibaca');

    // Fitur Pendaftaran Lomba TTG (Admin Panel)
    Route::get('/lomba', [AdminLombaController::class, 'index'])->name('admin.lomba.index');
    Route::post('/lomba/jadwal/{id}/toggle-gembok', [AdminLombaController::class, 'toggleGembok'])->name('admin.lomba.jadwal.toggle');
    Route::put('/lomba/jadwal/{id}', [AdminLombaController::class, 'updateJadwal'])->name('admin.lomba.jadwal.update');
    Route::put('/lomba/template-proposal', [AdminLombaController::class, 'updateTemplateProposal'])->name('admin.lomba.template.update');
    Route::get('/lomba/print', [AdminLombaController::class, 'print'])->name('admin.lomba.print');
    Route::get('/lomba/{id}', [AdminLombaController::class, 'show'])->name('admin.lomba.show');
    Route::patch('/lomba/{id}/status', [AdminLombaController::class, 'updateStatus'])->name('admin.lomba.update-status');
    Route::delete('/lomba/{id}', [AdminLombaController::class, 'destroy'])->name('admin.lomba.destroy');

    // Fitur Pengaturan Admin (Ubah Email, Password & URL Login Khusus)
    Route::get('/pengaturan', [AdminController::class, 'pengaturan'])->name('admin.pengaturan');
    Route::put('/pengaturan/profile', [AdminController::class, 'updateProfile'])->name('admin.pengaturan.profile');
    Route::put('/pengaturan/password', [AdminController::class, 'updatePassword'])->name('admin.pengaturan.password');
    Route::put('/pengaturan/url-login', [AdminController::class, 'updateAdminLoginUrl'])->name('admin.pengaturan.url-login');
});
