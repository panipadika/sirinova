<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ebook extends Model
{
    use HasFactory;

    protected $table = 'ebook';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'judul',
        'kategori',
        'tahun',
        'deskripsi',
        'cover_image',
        'file_url',
    ];

    /**
     * Otomatis hapus file cover dan PDF dari storage saat record Ebook dihapus.
     */
    protected static function booted()
    {
        static::deleting(function ($ebook) {
            if ($ebook->cover_image && str_contains($ebook->cover_image, 'storage/ebooks/covers/')) {
                $oldPath = str_replace('storage/', '', $ebook->cover_image);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            if ($ebook->file_url && str_contains($ebook->file_url, 'storage/ebooks/pdfs/')) {
                $oldPath = str_replace('storage/', '', $ebook->file_url);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
        });
    }
}

