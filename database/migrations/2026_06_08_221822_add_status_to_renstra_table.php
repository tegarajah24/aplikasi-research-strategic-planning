<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('renstra', function (Blueprint $table) {
            $table->string('status')->nullable()->default('belum_tercapai')->after('periode');
        });
    }

    public function down(): void
    {
        Schema::table('renstra', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
