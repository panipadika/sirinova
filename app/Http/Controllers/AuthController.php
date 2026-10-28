<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Notifications\AdminResetPasswordNotification;
use App\Services\SecurityAuditLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function prosesLogin(Request $request)
    {
        // Kunci array harus tetap bernama 'password' agar Laravel tahu
        // ini adalah teks yang harus dicocokkan dengan Hash
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $remember = $request->boolean('remember') || $request->filled('remember-me');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            SecurityAuditLogger::log('AUTH_LOGIN_SUCCESS', [
                'email' => $request->email,
                'guard' => 'web',
            ], 'info');

            if ($remember) {
                // Simpan email di cookie selama 30 hari untuk kemudahan auto-fill email saja (tanpa password demi keamanan)
                \Illuminate\Support\Facades\Cookie::queue('remember_email', $request->email, 60 * 24 * 30);
                \Illuminate\Support\Facades\Cookie::queue('remember_checked', '1', 60 * 24 * 30);
                \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::forget('remember_password'));
            } else {
                // Hapus cookie secara bersih jika 'Ingat saya' tidak dicentang
                \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::forget('remember_email'));
                \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::forget('remember_password'));
                \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::forget('remember_checked'));
            }

            return redirect()->intended('/admin/dashboard');
        }

        SecurityAuditLogger::log('AUTH_LOGIN_FAILED', [
            'email' => $request->email,
            'guard' => 'web',
        ], 'warning');

        return back()->withErrors([
            'email' => 'Email atau password tidak sesuai.',
        ]);
    }

    /**
     * Tampilkan formulir permintaan lupa password admin
     */
    public function showForgotPasswordForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.forgot-password');
    }

    /**
     * Proses permohonan reset password admin secara aman:
     * - Mencegah account enumeration dengan selalu mengembalikan generic response.
     * - Token hanya dikirimkan melalui tautan email/notifikasi terverifikasi (bukan redirect langsung di browser).
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'nama' => 'required|string',
        ], [
            'email.required' => 'Email administrator wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'nama.required' => 'Nama akun administrator wajib diisi.',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        // Validasi identitas secara aman tanpa membocorkan eksistensi akun
        if ($admin && hash_equals(strtolower(trim($admin->nama)), strtolower(trim($request->nama)))) {
            /** @var \Illuminate\Auth\Passwords\PasswordBroker $broker */
            $broker = Password::broker('users');
            $token = $broker->createToken($admin);

            $resetUrl = route('admin.password.reset', ['token' => $token, 'email' => $admin->email]);
            Log::info("Tautan Reset Password Admin [{$admin->email}]: {$resetUrl}");

            try {
                $admin->notify(new AdminResetPasswordNotification($token, $admin->email));
            } catch (\Throwable $e) {
                Log::error("Gagal mengirimkan email reset password admin [{$admin->email}]: " . $e->getMessage());
            }
        }

        SecurityAuditLogger::log('PASSWORD_RESET_LINK_REQUESTED', [
            'email' => $request->email,
            'guard' => 'web',
        ], 'info');

        return back()->with('status', 'Jika informasi yang dimasukkan sesuai, instruksi pengaturan ulang kata sandi telah dikirimkan ke kanal terdaftar.');
    }

    /**
     * Tampilkan formulir pembuatan password baru admin
     */
    public function showResetPasswordForm(Request $request, $token = null)
    {
        return view('admin.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    /**
     * Proses pembaruan kata sandi admin dengan token sekali pakai dan rotasi sesi
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

        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            SecurityAuditLogger::log('PASSWORD_RESET_FAILED', [
                'email' => $request->email,
                'guard' => 'web',
                'reason' => 'Account not found',
            ], 'warning');
            return back()->withErrors(['token' => 'Permintaan reset kata sandi tidak valid atau telah kedaluwarsa.']);
        }

        /** @var \Illuminate\Auth\Passwords\PasswordBroker $broker */
        $broker = Password::broker('users');

        if (!$broker->tokenExists($admin, $request->token)) {
            SecurityAuditLogger::log('PASSWORD_RESET_FAILED', [
                'email' => $request->email,
                'guard' => 'web',
                'reason' => 'Invalid or expired token',
            ], 'warning');
            return back()->withErrors(['token' => 'Token reset password tidak valid atau sudah kedaluwarsa. Silakan ajukan permohonan baru.']);
        }

        // Update kata sandi baru
        $admin->kata_sandi = Hash::make($request->password);
        $admin->save();

        // Hapus token yang sudah digunakan (one-time expiring token)
        $broker->deleteToken($admin);

        // Rotasi sesi untuk mencegah session fixation / hijacking
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        SecurityAuditLogger::log('PASSWORD_RESET_COMPLETED', [
            'email' => $request->email,
            'guard' => 'web',
        ], 'info');

        return redirect()->route('login')->with('success', 'Kata sandi Administrator berhasil diperbarui! Silakan masuk menggunakan kata sandi baru Anda.');
    }

    public function logout(Request $request)
    {
        SecurityAuditLogger::log('AUTH_LOGOUT', [
            'guard' => 'web',
        ], 'info');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
