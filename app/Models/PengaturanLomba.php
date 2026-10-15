<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanLomba extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_lomba';
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
     * Ambil tautan Google Drive template proposal resmi
     */
    public static function getTemplateUrl(): string
    {
        $defaultUrl = env('GDRIVE_TEMPLATE_LOMBA_URL', 'https://drive.google.com/drive/folders/1FG0r_sQzvgXhO49mVKwdp2RwzGIREZno?usp=sharing');
        return static::get('link_template_proposal', $defaultUrl) ?: $defaultUrl;
    }
}
