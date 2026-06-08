<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->date('waktu_mulai')->nullable()->after('waktu_pelaksanaan');
            $table->date('waktu_selesai')->nullable()->after('waktu_mulai');
            $table->text('dokumen')->nullable()->after('catatan');
        });
    }

    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn(['waktu_mulai', 'waktu_selesai', 'dokumen']);
        });
    }
};
