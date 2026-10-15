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
        Schema::create('data_indikator_makro', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indikator_id')->constrained('indikator_makro')->onDelete('cascade');
            $table->integer('tahun');
            $table->string('nama_daerah');
            $table->decimal('nilai', 8, 2)->default(0);
            $table->boolean('is_kota_tasik')->default(false);
            $table->timestamps();

            $table->unique(['indikator_id', 'tahun', 'nama_daerah'], 'unique_indikator_tahun_daerah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_indikator_makro');
    }
};
