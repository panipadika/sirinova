<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalLomba extends Model
{
    use HasFactory;

    protected $table = 'jadwal_lomba';
    protected $guarded = ['id'];

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $casts = [
        'is_buka' => 'boolean',
        'tanggal_buka' => 'datetime',
        'tanggal_tutup' => 'datetime',
    ];

    /**
     * Cek apakah pendaftaran kategori ini sedang dibuka.
     * Menggabungkan status gembok manual (is_buka) dan batas tanggal jika disetel.
     */
    public function isPendaftaranDibuka(): bool
    {
        // 1. Cek status gembok manual oleh admin
        if (!$this->is_buka) {
            return false;
        }

        $now = now();

        // 2. Jika disetel tanggal buka dan waktu sekarang belum sampai
        if ($this->tanggal_buka && $now->lt($this->tanggal_buka)) {
            return false;
        }

        // 3. Jika disetel tanggal tutup dan waktu sekarang sudah lewat
        if ($this->tanggal_tutup && $now->gt($this->tanggal_tutup)) {
            return false;
        }

        return true;
    }

    /**
     * Label status pendaftaran
     */
    public function getStatusLabelAttribute(): string
    {
        if (!$this->is_buka) {
            return 'Pendaftaran Ditutup (Akses Nonaktif)';
        }

        $now = now();
        if ($this->tanggal_buka && $now->lt($this->tanggal_buka)) {
            return 'Belum Dibuka (Mulai ' . $this->tanggal_buka->translatedFormat('d M Y, H:i') . ')';
        }

        if ($this->tanggal_tutup && $now->gt($this->tanggal_tutup)) {
            return 'Pendaftaran Berakhir (' . $this->tanggal_tutup->translatedFormat('d M Y, H:i') . ')';
        }

        return 'Pendaftaran Dibuka';
    }

    /**
     * Status akses teks
     */
    public function getGembokTeksAttribute(): string
    {
        return $this->is_buka ? 'Akses Terbuka' : 'Akses Ditutup';
    }

    public function getAksesTeksAttribute(): string
    {
        return $this->is_buka ? 'Akses Terbuka' : 'Akses Ditutup';
    }

    /**
     * Badge status color classes
     */
    public function getStatusBadgeAttribute(): string
    {
        if (!$this->is_buka) {
            return 'bg-rose-50 text-rose-700 border-rose-200';
        }

        $now = now();
        if ($this->tanggal_buka && $now->lt($this->tanggal_buka)) {
            return 'bg-amber-50 text-amber-700 border-amber-200';
        }

        if ($this->tanggal_tutup && $now->gt($this->tanggal_tutup)) {
            return 'bg-slate-100 text-slate-700 border-slate-200';
        }

        return 'bg-emerald-50 text-emerald-700 border-emerald-200';
    }

    /**
     * Periode teks ramah pembaca
     */
    public function getPeriodeTeksAttribute(): string
    {
        if ($this->tanggal_buka && $this->tanggal_tutup) {
            return $this->tanggal_buka->translatedFormat('d M Y') . ' — ' . $this->tanggal_tutup->translatedFormat('d M Y');
        }
        if ($this->tanggal_buka) {
            return 'Mulai ' . $this->tanggal_buka->translatedFormat('d M Y');
        }
        if ($this->tanggal_tutup) {
            return 'Sampai ' . $this->tanggal_tutup->translatedFormat('d M Y');
        }
        return 'Jadwal fleksibel (Aktif)';
    }
}
