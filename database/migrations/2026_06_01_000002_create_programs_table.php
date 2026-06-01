<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidang_id')->constrained('bidangs')->onDelete('cascade');
            $table->string('kode_program', 20);
            $table->string('nama_program');
            $table->text('deskripsi')->nullable();
            $table->string('sasaran')->nullable();
            $table->string('strategi_renstra')->nullable();
            $table->string('program_tahunan')->nullable();
            $table->decimal('anggaran', 15, 2)->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
