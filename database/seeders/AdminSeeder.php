<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin')->updateOrInsert(
            ['id' => 1],
            [
                'nama' => 'Admin Litbang 2026',
                'email' => 'adminsirinova@gmail.com',
                // Gunakan Hash::make agar password dienkripsi secara aman
                'kata_sandi' => Hash::make('admin123'),
                'dibuat_pada' => now(),
                'diperbarui_pada' => now(),
            ]
        );
    }
}
