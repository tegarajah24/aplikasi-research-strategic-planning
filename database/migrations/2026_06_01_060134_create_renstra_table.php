<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('renstra', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('sasaran');
            $table->string('strategi')->nullable();
            $table->string('program_tahunan')->nullable();
            $table->string('periode')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('renstra');
    }
};
