<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Penting!

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $guarded = ['id'];

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $hidden = ['kata_sandi'];

    // Memberitahu Laravel bahwa kolom password kita bernama 'kata_sandi'
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}
