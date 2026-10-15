<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PesertaAuthController extends Controller
{
    /**
     * Tampilkan formulir login peserta lomba
     */
    public function showLoginForm()
    {
        if (Auth::guard('peserta')->check()) {
            return redirect()->route('lomba.status');
        }
        return view('user.lomba.login');
    }

    /**
     * Proses autentikasi peserta
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::guard('peserta')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('lomba.daftar'))->with('login_success', 'Selamat datang! Anda berhasil masuk ke akun peserta.');
        }

        return back()->withInput($request->only('email'))->withErrors([
            'email' => 'Email atau password yang Anda masukkan tidak sesuai.',
        ]);
    }

    /**
     * Tampilkan formulir pendaftaran akun (registrasi) peserta
     */
    public function showRegisterForm()
    {
        if (Auth::guard('peserta')->check()) {
            return redirect()->route('lomba.daftar');
        }
        return view('user.lomba.register');
    }

    /**
     * Proses pembuatan akun peserta baru
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'no_wa' => 'required|string|max:20',
            'asal_instansi' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama lengkap inovator / perwakilan wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar. Silakan login menggunakan email tersebut.',
            'no_wa.required' => 'Nomor WhatsApp aktif wajib diisi.',
            'asal_instansi.required' => 'Asal instansi / sekolah / universitas wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'no_wa' => $validated['no_wa'],
            'asal_instansi' => $validated['asal_instansi'],
            'password' => Hash::make($validated['password']),
        ]);

        // Langsung loginkan peserta setelah registrasi berhasil
        Auth::guard('peserta')->login($user);
        $request->session()->regenerate();

        return redirect()->route('lomba.daftar')->with('success', 'Akun berhasil dibuat! Silakan lengkapi formulir pendaftaran lomba TTG di bawah ini.');
    }

    /**
     * Logout akun peserta
     */
    public function logout(Request $request)
    {
        Auth::guard('peserta')->logout();
        return redirect()->route('lomba.info')->with('info', 'Anda telah keluar dari akun peserta.');
    }

    /**
     * Tampilkan formulir permintaan reset password (lupa password)
     */
    public function showForgotPasswordForm()
    {
        if (Auth::guard('peserta')->check()) {
            return redirect()->route('lomba.status');
        }
        return view('user.lomba.forgot-password');
    }

    /**
     * Verifikasi Email & Nomor WhatsApp untuk reset kata sandi peserta
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'no_wa' => 'required|string',
        ], [
            'email.required' => 'Email akun wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi.',
        ]);

        // Cek apakah email terdaftar di tabel user peserta
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withInput($request->only('email', 'no_wa'))->withErrors([
                'email' => 'Email tersebut belum terdaftar sebagai akun peserta.',
            ]);
        }

        // Cocokkan nomor WhatsApp (normalisasi digit nomor telepon)
        $cleanInputWa = preg_replace('/[^0-9]/', '', (string)$request->no_wa);
        $cleanUserWa = preg_replace('/[^0-9]/', '', (string)$user->no_wa);

        if (str_starts_with($cleanInputWa, '62')) {
            $cleanInputWa = '0' . substr($cleanInputWa, 2);
        }
        if (str_starts_with($cleanUserWa, '62')) {
            $cleanUserWa = '0' . substr($cleanUserWa, 2);
        }

        if ($cleanInputWa !== $cleanUserWa) {
            return back()->withInput($request->only('email', 'no_wa'))->withErrors([
                'no_wa' => 'Nomor WhatsApp tidak cocok dengan data pendaftaran akun Anda.',
            ]);
        }

        // Buat token reset password yang valid
        /** @var \Illuminate\Auth\Passwords\PasswordBroker $broker */
        $broker = Password::broker('peserta');
        $token = $broker->createToken($user);

        // Langsung arahkan ke halaman pembuatan kata sandi baru secara instan
        return redirect()->route('peserta.password.reset', [
            'token' => $token,
            'email' => $user->email,
        ])->with('info', 'Identitas akun berhasil diverifikasi! Silakan tentukan kata sandi baru Anda.');
    }

    /**
     * Tampilkan formulir reset kata sandi baru
     */
    public function showResetPasswordForm(Request $request, $token = null)
    {
        return view('user.lomba.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    /**
     * Proses pembaruan kata sandi peserta
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'token.required' => 'Token reset password tidak valid atau telah kedaluwarsa.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        $status = Password::broker('peserta')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('peserta.login')->with('success', 'Kata sandi Anda berhasil diperbarui! Silakan masuk menggunakan kata sandi baru Anda.');
        }

        return back()->withInput($request->only('email'))->withErrors([
            'email' => __($status),
        ]);
    }
}
