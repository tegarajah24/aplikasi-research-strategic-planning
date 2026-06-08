<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')->where('role', 'Operator')->update(['role' => 'LPPM']);
        DB::table('users')->where('role', 'Viewer')->update(['role' => 'Dekan']);

        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('Admin')->change();
        });
    }

    public function down(): void
    {
        DB::table('users')->where('role', 'LPPM')->update(['role' => 'Operator']);
        DB::table('users')->where('role', 'Dekan')->update(['role' => 'Viewer']);

        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('Operator')->change();
        });
    }
};
