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
        Schema::table('prestasi_akademiks', function (Blueprint $table) {
            $table->dropUnique('prestasi_akademiks_tahun_unique');
            $table->string('nama_mahasiswa')->nullable();
            $table->string('prodi')->nullable();
            $table->string('fakultas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestasi_akademiks', function (Blueprint $table) {
            $table->dropColumn(['nama_mahasiswa', 'prodi', 'fakultas']);
            $table->unique('tahun', 'prestasi_akademiks_tahun_unique');
        });
    }
};
