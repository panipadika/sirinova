<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('telaahan_staf', function (Blueprint $table) {
            $columnsToDrop = [];

            if (Schema::hasColumn('telaahan_staf', 'nomor_surat')) {
                $columnsToDrop[] = 'nomor_surat';
            }
            if (Schema::hasColumn('telaahan_staf', 'kategori')) {
                $columnsToDrop[] = 'kategori';
            }
            if (Schema::hasColumn('telaahan_staf', 'pokok_persoalan')) {
                $columnsToDrop[] = 'pokok_persoalan';
            }
            if (Schema::hasColumn('telaahan_staf', 'rekomendasi')) {
                $columnsToDrop[] = 'rekomendasi';
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('telaahan_staf', function (Blueprint $table) {
            if (!Schema::hasColumn('telaahan_staf', 'nomor_surat')) {
                $table->string('nomor_surat')->nullable()->after('judul');
            }
            if (!Schema::hasColumn('telaahan_staf', 'kategori')) {
                $table->string('kategori')->default('Kebijakan')->after('pembuat_bidang');
            }
            if (!Schema::hasColumn('telaahan_staf', 'pokok_persoalan')) {
                $table->text('pokok_persoalan')->nullable()->after('ringkasan');
            }
            if (!Schema::hasColumn('telaahan_staf', 'rekomendasi')) {
                $table->text('rekomendasi')->nullable()->after('pokok_persoalan');
            }
        });
    }
};
