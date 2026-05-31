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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kegiatan', 20);
            $table->string('nama_kegiatan');
            $table->text('indikator_kinerja');
            $table->string('target_kegiatan', 100);
            $table->string('penanggung_jawab', 100);
            $table->string('waktu_pelaksanaan', 150);
            $table->string('tahun_akademik', 20)->nullable();
            $table->string('kebutuhan_anggaran', 200);
            $table->enum('status', ['perencanaan', 'berjalan', 'selesai', 'tertunda'])->default('perencanaan');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
