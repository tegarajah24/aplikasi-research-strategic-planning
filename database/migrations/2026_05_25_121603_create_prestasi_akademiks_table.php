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
        Schema::create('prestasi_akademiks', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun')->unique();
            $table->integer('regional')->default(0);
            $table->integer('nasional')->default(0);
            $table->integer('internasional')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi_akademiks');
    }
};
