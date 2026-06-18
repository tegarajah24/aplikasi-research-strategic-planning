<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('renstra', function (Blueprint $table) {
            $table->foreignId('fakultas_id')->nullable()->constrained('fakultas')->onDelete('cascade');
            $table->integer('tahun_mulai')->nullable();
            $table->integer('tahun_selesai')->nullable();
        });

        DB::statement("
            UPDATE renstra
            SET tahun_mulai = CAST(SUBSTRING_INDEX(periode, '-', 1) AS UNSIGNED),
                tahun_selesai = CAST(
                    IF(
                        LOCATE('-', periode) > 0,
                        SUBSTRING_INDEX(periode, '-', -1),
                        CAST(periode AS UNSIGNED) + 4
                    ) AS UNSIGNED
                )
            WHERE periode IS NOT NULL AND periode != ''
        ");

        Schema::table('renstra', function (Blueprint $table) {
            $table->dropColumn('periode');
        });
    }

    public function down(): void
    {
        Schema::table('renstra', function (Blueprint $table) {
            $table->dropForeign(['fakultas_id']);
            $table->string('periode')->nullable();
        });

        DB::statement("
            UPDATE renstra
            SET periode = CONCAT(COALESCE(tahun_mulai, ''), '-', COALESCE(tahun_selesai, ''))
            WHERE tahun_mulai IS NOT NULL AND tahun_selesai IS NOT NULL
        ");

        Schema::table('renstra', function (Blueprint $table) {
            $table->dropColumn(['tahun_mulai', 'tahun_selesai', 'fakultas_id']);
        });
    }
};
