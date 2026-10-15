<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('telaahan_staf', 'tanggal_dokumen') && !Schema::hasColumn('telaahan_staf', 'tahun_dokumen')) {
            Schema::table('telaahan_staf', function (Blueprint $table) {
                $table->year('tahun_dokumen')->nullable()->after('judul');
            });

            DB::statement("UPDATE telaahan_staf SET tahun_dokumen = YEAR(tanggal_dokumen) WHERE tanggal_dokumen IS NOT NULL");

            Schema::table('telaahan_staf', function (Blueprint $table) {
                $table->dropColumn('tanggal_dokumen');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('telaahan_staf', 'tahun_dokumen') && !Schema::hasColumn('telaahan_staf', 'tanggal_dokumen')) {
            Schema::table('telaahan_staf', function (Blueprint $table) {
                $table->date('tanggal_dokumen')->nullable()->after('judul');
            });

            DB::statement("UPDATE telaahan_staf SET tanggal_dokumen = CONCAT(tahun_dokumen, '-01-01') WHERE tahun_dokumen IS NOT NULL");

            Schema::table('telaahan_staf', function (Blueprint $table) {
                $table->dropColumn('tahun_dokumen');
            });
        }
    }
};
