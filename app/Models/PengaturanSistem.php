<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanSistem extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_sistem';
    protected $guarded = ['id'];

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    /**
     * Ambil nilai pengaturan berdasarkan kunci
     */
    public static function get(string $kunci, $default = null): ?string
    {
        try {
            $item = static::where('kunci', $kunci)->first();
            if ($item && !empty($item->nilai)) {
                return $item->nilai;
            }
        } catch (\Throwable $e) {
            // Abaikan jika tabel belum ada atau error koneksi
        }

        return $default;
    }

    /**
     * Simpan / Perbarui nilai pengaturan
     */
    public static function set(string $kunci, ?string $nilai, ?string $keterangan = null): self
    {
        return static::updateOrCreate(
            ['kunci' => $kunci],
            [
                'nilai' => $nilai,
                'keterangan' => $keterangan,
            ]
        );
    }

    /**
     * Ambil slug URL login admin aktif (default: admin-dashboard)
     */
    public static function getAdminLoginSlug(): string
    {
        $default = env('ADMIN_LOGIN_SLUG', 'admin-dashboard');
        return static::get('admin_login_slug', $default) ?: $default;
    }
}
