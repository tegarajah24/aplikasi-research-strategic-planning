<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE rkt_kegiatan MODIFY kebutuhan_anggaran DECIMAL(15,2) NOT NULL DEFAULT 0');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE rkt_kegiatan MODIFY kebutuhan_anggaran VARCHAR(200) NOT NULL DEFAULT "0"');
    }
};
