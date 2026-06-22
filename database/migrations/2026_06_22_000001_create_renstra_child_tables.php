<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('renstra_sasaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('renstra_id')->constrained('renstra')->onDelete('cascade');
            $table->text('sasaran');
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });

        Schema::create('renstra_strategi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('renstra_sasaran_id')->constrained('renstra_sasaran')->onDelete('cascade');
            $table->text('strategi');
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });

        Schema::create('renstra_program', function (Blueprint $table) {
            $table->id();
            $table->foreignId('renstra_strategi_id')->constrained('renstra_strategi')->onDelete('cascade');
            $table->text('program_tahunan');
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });

        $renstras = DB::table('renstra')->get();
        foreach ($renstras as $renstra) {
            if (empty($renstra->sasaran) && empty($renstra->strategi) && empty($renstra->program_tahunan)) {
                continue;
            }

            $sasaranId = DB::table('renstra_sasaran')->insertGetId([
                'renstra_id' => $renstra->id,
                'sasaran'    => $renstra->sasaran ?? '',
                'urutan'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $strategiId = null;
            if (!empty($renstra->strategi)) {
                $strategiId = DB::table('renstra_strategi')->insertGetId([
                    'renstra_sasaran_id' => $sasaranId,
                    'strategi'           => $renstra->strategi,
                    'urutan'            => 1,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);
            }

            if (!empty($renstra->program_tahunan)) {
                DB::table('renstra_program')->insertGetId([
                    'renstra_strategi_id' => $strategiId ?? $sasaranId,
                    'program_tahunan'     => $renstra->program_tahunan,
                    'urutan'             => 1,
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ]);
            }
        }

        Schema::table('renstra', function (Blueprint $table) {
            $table->dropColumn(['sasaran', 'strategi', 'program_tahunan']);
        });
    }

    public function down(): void
    {
        Schema::table('renstra', function (Blueprint $table) {
            $table->string('sasaran')->nullable();
            $table->string('strategi')->nullable();
            $table->string('program_tahunan')->nullable();
        });

        $sasarans = DB::table('renstra_sasaran')->get();
        foreach ($sasarans as $sasaran) {
            $strategis = DB::table('renstra_strategi')
                ->where('renstra_sasaran_id', $sasaran->id)
                ->get();

            $programs = collect();
            foreach ($strategis as $strategi) {
                $progs = DB::table('renstra_program')
                    ->where('renstra_strategi_id', $strategi->id)
                    ->get();
                $programs = $programs->concat($progs);
            }

            $firstStrategi = $strategis->first();
            $firstProgram  = $programs->first();

            DB::table('renstra')
                ->where('id', $sasaran->renstra_id)
                ->update([
                    'sasaran'         => $sasaran->sasaran,
                    'strategi'        => $firstStrategi?->strategi,
                    'program_tahunan' => $firstProgram?->program_tahunan,
                ]);
        }

        Schema::dropIfExists('renstra_program');
        Schema::dropIfExists('renstra_strategi');
        Schema::dropIfExists('renstra_sasaran');
    }
};
