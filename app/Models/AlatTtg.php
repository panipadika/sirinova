<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AlatTtg extends Model
{
    protected $table = 'alat_ttg';
    protected $guarded = ['id'];
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    /**
     * Otomatis hapus file foto fisik di public storage saat data Alat TTG dihapus.
     */
    protected static function booted()
    {
        static::deleting(function ($alat) {
            if ($alat->foto) {
                $path = str_replace('storage/', '', $alat->foto);
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        });
    }

    // Relasi ke tabel inovator (Sudah ada sebelumnya)
    public function inovator() {
        return $this->belongsTo(Inovator::class, 'id_inovator');
    }

    // Relasi ke tabel kategori (TAMBAHKAN INI)
    public function kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    // Sekalian tambahkan relasi ke wilayah agar aman jika nanti dibutuhkan (TAMBAHKAN INI)
    public function wilayah() {
        return $this->belongsTo(Wilayah::class, 'id_wilayah');
    }
}
