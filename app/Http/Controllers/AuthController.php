<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
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
     * Verifikasi Email & Nama Admin untuk membuat token reset password
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
        if (!$admin) {
            return back()->withInput($request->only('email', 'nama'))->withErrors([
                'email' => 'Email tersebut belum terdaftar sebagai akun Administrator.',
            ]);
        }

        // Cocokkan nama admin (case-insensitive & trim)
        if (trim(strtolower($admin->nama)) !== trim(strtolower($request->nama))) {
            return back()->withInput($request->only('email', 'nama'))->withErrors([
                'nama' => 'Nama administrator tidak cocok dengan data akun terdaftar.',
            ]);
        }

        // Buat token reset password yang aman
        /** @var \Illuminate\Auth\Passwords\PasswordBroker $broker */
        $broker = Password::broker('users');
        $token = $broker->createToken($admin);

        return redirect()->route('admin.password.reset', [
            'token' => $token,
            'email' => $admin->email,
        ])->with('info', 'Identitas Administrator terverifikasi! Silakan tentukan kata sandi baru Anda.');
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
     * Proses pembaruan kata sandi admin
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
            return back()->withErrors(['email' => 'Akun Administrator tidak ditemukan.']);
        }

        /** @var \Illuminate\Auth\Passwords\PasswordBroker $broker */
        $broker = Password::broker('users');

        if (!$broker->tokenExists($admin, $request->token)) {
            return back()->withErrors(['token' => 'Token reset password tidak valid atau sudah kedaluwarsa. Silakan ajukan reset ulang.']);
        }

        // Update kata sandi baru
        $admin->kata_sandi = Hash::make($request->password);
        $admin->save();

        // Hapus token yang sudah digunakan
        $broker->deleteToken($admin);

        return redirect()->route('login')->with('success', 'Kata sandi Administrator berhasil diperbarui! Silakan masuk menggunakan kata sandi baru Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
