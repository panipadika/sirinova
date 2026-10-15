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
        // 1. Salin data timestamp yang ada di tabel ebook dari created_at ke dibuat_pada
        if (Schema::hasColumn('ebook', 'created_at') && Schema::hasColumn('ebook', 'dibuat_pada')) {
            DB::statement("UPDATE ebook SET dibuat_pada = created_at WHERE dibuat_pada IS NULL AND created_at IS NOT NULL");
            DB::statement("UPDATE ebook SET diperbarui_pada = updated_at WHERE diperbarui_pada IS NULL AND updated_at IS NOT NULL");

            Schema::table('ebook', function (Blueprint $table) {
                $table->dropColumn(['created_at', 'updated_at']);
            });
        }

        // 2. Bersihkan kolom created_at dan updated_at yang tidak terpakai di tabel telaahan_staf
        if (Schema::hasColumn('telaahan_staf', 'created_at')) {
            DB::statement("UPDATE telaahan_staf SET dibuat_pada = created_at WHERE dibuat_pada IS NULL AND created_at IS NOT NULL");
            DB::statement("UPDATE telaahan_staf SET diperbarui_pada = updated_at WHERE diperbarui_pada IS NULL AND updated_at IS NOT NULL");

            Schema::table('telaahan_staf', function (Blueprint $table) {
                $table->dropColumn(['created_at', 'updated_at']);
            });
        }

        // 3. Ubah nama kolom timestamp tabel galeri menjadi Bahasa Indonesia
        if (Schema::hasColumn('galeri', 'created_at') && !Schema::hasColumn('galeri', 'dibuat_pada')) {
            Schema::table('galeri', function (Blueprint $table) {
                $table->renameColumn('created_at', 'dibuat_pada');
                $table->renameColumn('updated_at', 'diperbarui_pada');
            });
        }

        // 4. Ubah nama kolom timestamp tabel indikator_makro menjadi Bahasa Indonesia
        if (Schema::hasColumn('indikator_makro', 'created_at') && !Schema::hasColumn('indikator_makro', 'dibuat_pada')) {
            Schema::table('indikator_makro', function (Blueprint $table) {
                $table->renameColumn('created_at', 'dibuat_pada');
                $table->renameColumn('updated_at', 'diperbarui_pada');
            });
        }

        // 5. Ubah nama kolom timestamp tabel data_indikator_makro menjadi Bahasa Indonesia
        if (Schema::hasColumn('data_indikator_makro', 'created_at') && !Schema::hasColumn('data_indikator_makro', 'dibuat_pada')) {
            Schema::table('data_indikator_makro', function (Blueprint $table) {
                $table->renameColumn('created_at', 'dibuat_pada');
                $table->renameColumn('updated_at', 'diperbarui_pada');
            });
        }

        // 6. Ubah nama kolom timestamp tabel pesan menjadi Bahasa Indonesia
        if (Schema::hasColumn('pesan', 'created_at') && !Schema::hasColumn('pesan', 'dibuat_pada')) {
            Schema::table('pesan', function (Blueprint $table) {
                $table->renameColumn('created_at', 'dibuat_pada');
                $table->renameColumn('updated_at', 'diperbarui_pada');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Rollback tabel ebook
        if (!Schema::hasColumn('ebook', 'created_at')) {
            Schema::table('ebook', function (Blueprint $table) {
                $table->timestamps();
            });
            DB::statement("UPDATE ebook SET created_at = dibuat_pada, updated_at = diperbarui_pada");
        }

        // 2. Rollback tabel telaahan_staf
        if (!Schema::hasColumn('telaahan_staf', 'created_at')) {
            Schema::table('telaahan_staf', function (Blueprint $table) {
                $table->timestamps();
            });
            DB::statement("UPDATE telaahan_staf SET created_at = dibuat_pada, updated_at = diperbarui_pada");
        }

        // 3. Rollback tabel galeri
        if (Schema::hasColumn('galeri', 'dibuat_pada') && !Schema::hasColumn('galeri', 'created_at')) {
            Schema::table('galeri', function (Blueprint $table) {
                $table->renameColumn('dibuat_pada', 'created_at');
                $table->renameColumn('diperbarui_pada', 'updated_at');
            });
        }

        // 4. Rollback tabel indikator_makro
        if (Schema::hasColumn('indikator_makro', 'dibuat_pada') && !Schema::hasColumn('indikator_makro', 'created_at')) {
            Schema::table('indikator_makro', function (Blueprint $table) {
                $table->renameColumn('dibuat_pada', 'created_at');
                $table->renameColumn('diperbarui_pada', 'updated_at');
            });
        }

        // 5. Rollback tabel data_indikator_makro
        if (Schema::hasColumn('data_indikator_makro', 'dibuat_pada') && !Schema::hasColumn('data_indikator_makro', 'created_at')) {
            Schema::table('data_indikator_makro', function (Blueprint $table) {
                $table->renameColumn('dibuat_pada', 'created_at');
                $table->renameColumn('diperbarui_pada', 'updated_at');
            });
        }

        // 6. Rollback tabel pesan
        if (Schema::hasColumn('pesan', 'dibuat_pada') && !Schema::hasColumn('pesan', 'created_at')) {
            Schema::table('pesan', function (Blueprint $table) {
                $table->renameColumn('dibuat_pada', 'created_at');
                $table->renameColumn('diperbarui_pada', 'updated_at');
            });
        }
    }
};
