<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';
    protected $guarded = ['id'];

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $casts = [
        'tanggal_kegiatan' => 'date',
        'foto_pendukung'   => 'array',
    ];

    /**
     * Otomatis hapus file foto utama dan foto pendukung dari storage saat record Galeri dihapus.
     */
    protected static function booted()
    {
        static::deleting(function ($galeri) {
            if ($galeri->foto && str_contains($galeri->foto, 'storage/galeri/photos/')) {
                $oldPath = str_replace('storage/', '', $galeri->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            if (is_array($galeri->foto_pendukung)) {
                foreach ($galeri->foto_pendukung as $support) {
                    if ($support && str_contains($support, 'storage/galeri/photos/')) {
                        $oldPath = str_replace('storage/', '', $support);
                        if (Storage::disk('public')->exists($oldPath)) {
                            Storage::disk('public')->delete($oldPath);
                        }
                    }
                }
            }
        });
    }
}

