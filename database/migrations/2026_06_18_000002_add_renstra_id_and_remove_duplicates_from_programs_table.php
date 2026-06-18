<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->foreignId('renstra_id')->nullable()->constrained('renstra')->onDelete('cascade');
        });

        $programs = DB::table('programs')->get();
        $fakultasIds = DB::table('fakultas')->pluck('id')->toArray();
        $defaultFakultasId = !empty($fakultasIds) ? $fakultasIds[0] : null;

        foreach ($programs as $program) {
            if ($program->sasaran || $program->strategi_renstra || $program->program_tahunan) {
                $existing = DB::table('renstra')
                    ->where('sasaran', $program->sasaran)
                    ->where('strategi', $program->strategi_renstra)
                    ->where('program_tahunan', $program->program_tahunan)
                    ->first();

                if ($existing) {
                    $renstraId = $existing->id;
                } else {
                    $renstraId = DB::table('renstra')->insertGetId([
                        'fakultas_id'    => $defaultFakultasId,
                        'kode'           => 'MIG-' . $program->id,
                        'sasaran'        => $program->sasaran ?? '',
                        'strategi'       => $program->strategi_renstra ?? '',
                        'program_tahunan'=> $program->program_tahunan ?? '',
                        'tahun_mulai'    => date('Y'),
                        'tahun_selesai'  => date('Y') + 4,
                        'status'         => 'belum_tercapai',
                        'created_at'     => now(),
                        'updated_at'     => now(),
                    ]);
                }

                DB::table('programs')
                    ->where('id', $program->id)
                    ->update(['renstra_id' => $renstraId]);
            }
        }

        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn(['sasaran', 'strategi_renstra', 'program_tahunan']);
        });
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->string('sasaran')->nullable();
            $table->string('strategi_renstra')->nullable();
            $table->string('program_tahunan')->nullable();
        });

        $programs = DB::table('programs')
            ->join('renstra', 'programs.renstra_id', '=', 'renstra.id')
            ->whereNotNull('programs.renstra_id')
            ->select('programs.id', 'renstra.sasaran', 'renstra.strategi', 'renstra.program_tahunan')
            ->get();

        foreach ($programs as $program) {
            DB::table('programs')
                ->where('id', $program->id)
                ->update([
                    'sasaran'          => $program->sasaran,
                    'strategi_renstra' => $program->strategi,
                    'program_tahunan'  => $program->program_tahunan,
                ]);
        }

        Schema::table('programs', function (Blueprint $table) {
            $table->dropForeign(['renstra_id']);
            $table->dropColumn('renstra_id');
        });
    }
};
