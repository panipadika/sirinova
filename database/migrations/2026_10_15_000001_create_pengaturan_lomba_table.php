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
        Schema::create('pengaturan_lomba', function (Blueprint $table) {
            $table->id();
            $table->string('kunci')->unique();
            $table->text('nilai')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamp('dibuat_pada')->nullable();
            $table->timestamp('diperbarui_pada')->nullable();
        });

        // Seed nilai awal link template proposal dari .env jika ada
        $now = now();
        $defaultGdriveUrl = env('GDRIVE_TEMPLATE_LOMBA_URL', 'https://drive.google.com/drive/folders/1FG0r_sQzvgXhO49mVKwdp2RwzGIREZno?usp=sharing');

        DB::table('pengaturan_lomba')->insert([
            'kunci' => 'link_template_proposal',
            'nilai' => $defaultGdriveUrl,
            'keterangan' => 'Link Google Drive template proposal dan pedoman ketentuan Lomba TTG Kota Tasikmalaya',
            'dibuat_pada' => $now,
            'diperbarui_pada' => $now,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_lomba');
    }
};
