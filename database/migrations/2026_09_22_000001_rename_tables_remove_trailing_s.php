<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menghapus akhiran 's' pada semua nama tabel.
     */
    public function up(): void
    {
        // Rename tabel anak (yang memiliki FK) terlebih dahulu
        Schema::rename('data_indikator_makros', 'data_indikator_makro');
        Schema::rename('indikator_makros', 'indikator_makro');
        Schema::rename('ebooks', 'ebook');
        Schema::rename('telaahan_stafs', 'telaahan_staf');
        Schema::rename('galeris', 'galeri');
        Schema::rename('users', 'user');
        Schema::rename('failed_jobs', 'failed_job');
        Schema::rename('password_reset_tokens', 'password_reset_token');
        Schema::rename('personal_access_tokens', 'personal_access_token');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('personal_access_token', 'personal_access_tokens');
        Schema::rename('password_reset_token', 'password_reset_tokens');
        Schema::rename('failed_job', 'failed_jobs');
        Schema::rename('user', 'users');
        Schema::rename('galeri', 'galeris');
        Schema::rename('telaahan_staf', 'telaahan_stafs');
        Schema::rename('ebook', 'ebooks');
        Schema::rename('indikator_makro', 'indikator_makros');
        Schema::rename('data_indikator_makro', 'data_indikator_makros');
    }
};
