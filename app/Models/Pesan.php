<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $table = 'pesan';

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'nama',
        'email',
        'no_wa',
        'subjek',
        'pesan',
        'is_dibaca',
    ];

    protected $casts = [
        'is_dibaca' => 'boolean',
    ];

    /**
     * Accessor untuk backward-compatibility jika ada pemanggilan $pesan->created_at
     */
    public function getCreatedAtAttribute()
    {
        return $this->dibuat_pada;
    }
}
