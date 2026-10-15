<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranLomba extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_lomba';
    protected $guarded = ['id'];

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    /**
     * Relasi ke akun User (peserta)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Helper status badge class
     */
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'Lolos Administrasi' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'Perlu Perbaikan' => 'bg-amber-50 text-amber-700 border-amber-200',
            'Ditolak' => 'bg-rose-50 text-rose-700 border-rose-200',
            default => 'bg-sky-50 text-sky-700 border-sky-200',
        };
    }

    /**
     * Helper status icon
     */
    public function getStatusIconAttribute(): string
    {
        return match ($this->status) {
            'Lolos Administrasi' => 'check_circle',
            'Perlu Perbaikan' => 'warning',
            'Ditolak' => 'cancel',
            default => 'pending',
        };
    }
}
