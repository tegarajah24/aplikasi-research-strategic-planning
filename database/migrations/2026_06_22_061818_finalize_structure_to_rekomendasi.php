<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ═══════════════════════════════════════════════════════════
        // PHASE 1 — Restructure hierarchy tables
        // ═══════════════════════════════════════════════════════════

        // 1a. Add bidang_id + kode_sasaran to renstra_sasaran
        Schema::table('renstra_sasaran', function (Blueprint $table) {
            $table->unsignedBigInteger('bidang_id')->nullable()->after('renstra_id');
            $table->string('kode_sasaran', 20)->nullable()->after('bidang_id');
            $table->renameColumn('sasaran', 'nama_sasaran');
        });
        DB::statement('ALTER TABLE renstra_sasaran ADD CONSTRAINT renstra_sasaran_bidang_id_foreign FOREIGN KEY (bidang_id) REFERENCES bidangs(id) ON DELETE SET NULL');

        // 1b. Propagate bidang_id from renstra → renstra_sasaran (before dropping it)
        DB::statement('UPDATE renstra_sasaran rs JOIN renstra r ON r.id = rs.renstra_id SET rs.bidang_id = r.bidang_id');

        // 1c. Drop bidang_id from renstra
        Schema::table('renstra', function (Blueprint $table) {
            // dropConstrainedForeignId handles both FK constraint and column
            $table->dropConstrainedForeignId('bidang_id');
        });

        // 1d. Rename columns in renstra_strategi
        // Note: renstra_sasaran_id FK was auto-named renstra_strategi_renstra_sasaran_id_foreign
        // We need to drop and recreate it with the new column name
        Schema::table('renstra_strategi', function (Blueprint $table) {
            $table->dropForeign(['renstra_sasaran_id']);
            $table->renameColumn('renstra_sasaran_id', 'sasaran_id');
            $table->renameColumn('strategi', 'nama_strategi');
        });
        Schema::table('renstra_strategi', function (Blueprint $table) {
            $table->foreign('sasaran_id')->references('id')->on('renstra_sasaran')->onDelete('cascade');
        });

        // 1e. Rename columns + add operational fields to renstra_program
        Schema::table('renstra_program', function (Blueprint $table) {
            $table->dropForeign(['renstra_strategi_id']);
            $table->renameColumn('renstra_strategi_id', 'strategi_id');
            $table->renameColumn('program_tahunan', 'nama_program');
            $table->string('kode_program', 50)->nullable()->after('nama_program');
            $table->text('deskripsi')->nullable()->after('kode_program');
            $table->string('status', 20)->nullable()->default('Aktif')->after('deskripsi');
        });
        Schema::table('renstra_program', function (Blueprint $table) {
            $table->foreign('strategi_id')->references('id')->on('renstra_strategi')->onDelete('cascade');
        });

        // ═══════════════════════════════════════════════════════════
        // PHASE 2 — Merge programs → renstra_program + rename kegiatans → rkt_kegiatan
        // ═══════════════════════════════════════════════════════════

        // 2a. Drop FK from kegiatans → programs
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropForeign(['program_id']);
        });

        // 2b. Migrate data: programs → renstra_program
        $programs = DB::table('programs')->get();
        $programIdMap = []; // old program.id → new renstra_program.id

        foreach ($programs as $program) {
            if (!$program->renstra_id) continue;

            // Find the hierarchy: renstra → first sasaran → first strategi
            $sasaran = DB::table('renstra_sasaran')
                ->where('renstra_id', $program->renstra_id)
                ->first();

            if (!$sasaran) {
                // Create a default sasaran for this renstra
                $sasaranId = DB::table('renstra_sasaran')->insertGetId([
                    'renstra_id' => $program->renstra_id,
                    'nama_sasaran' => $program->nama_program,
                    'urutan' => 1,
                ]);
                $sasaran = (object)['id' => $sasaranId];
            }

            $strategi = DB::table('renstra_strategi')
                ->where('sasaran_id', $sasaran->id)
                ->first();

            if (!$strategi) {
                // Create a default strategi for this sasaran
                $strategiId = DB::table('renstra_strategi')->insertGetId([
                    'sasaran_id' => $sasaran->id,
                    'nama_strategi' => $program->nama_program,
                    'urutan' => 1,
                ]);
                $strategi = (object)['id' => $strategiId];
            }

            // Check if a matching renstra_program already exists by name under this strategi
            $existing = DB::table('renstra_program')
                ->where('strategi_id', $strategi->id)
                ->where('nama_program', $program->nama_program)
                ->first();

            if ($existing) {
                $newProgramId = $existing->id;
                DB::table('renstra_program')
                    ->where('id', $existing->id)
                    ->update([
                        'kode_program' => $program->kode_program,
                        'deskripsi' => $program->deskripsi,
                        'status' => $program->status,
                    ]);
            } else {
                $maxUrutan = DB::table('renstra_program')
                    ->where('strategi_id', $strategi->id)
                    ->max('urutan') ?? 0;

                $newProgramId = DB::table('renstra_program')->insertGetId([
                    'strategi_id' => $strategi->id,
                    'nama_program' => $program->nama_program,
                    'kode_program' => $program->kode_program,
                    'deskripsi' => $program->deskripsi,
                    'status' => $program->status,
                    'urutan' => $maxUrutan + 1,
                    'created_at' => $program->created_at ?? now(),
                    'updated_at' => $program->updated_at ?? now(),
                ]);
            }

            $programIdMap[$program->id] = $newProgramId;
        }

        // 2c. Update kegiatan program_id values
        foreach ($programIdMap as $oldId => $newId) {
            DB::table('kegiatans')
                ->where('program_id', $oldId)
                ->update(['program_id' => $newId]);
        }

        // 2d. Drop programs table
        Schema::dropIfExists('programs');

        // 2e. Rename kegiatans → rkt_kegiatan
        Schema::rename('kegiatans', 'rkt_kegiatan');

        // 2f. Rename columns in rkt_kegiatan
        Schema::table('rkt_kegiatan', function (Blueprint $table) {
            $table->renameColumn('waktu_mulai', 'tgl_mulai_pelaksanaan');
            $table->renameColumn('waktu_selesai', 'tgl_selesai_pelaksanaan');
        });

        // 2g. Add new FK: rkt_kegiatan.program_id → renstra_program.id
        Schema::table('rkt_kegiatan', function (Blueprint $table) {
            $table->foreign('program_id')->references('id')->on('renstra_program')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Reverse rkt_kegiatan changes
        Schema::table('rkt_kegiatan', function (Blueprint $table) {
            $table->dropForeign(['program_id']);
            $table->renameColumn('tgl_mulai_pelaksanaan', 'waktu_mulai');
            $table->renameColumn('tgl_selesai_pelaksanaan', 'waktu_selesai');
        });
        Schema::rename('rkt_kegiatan', 'kegiatans');

        // Recreate programs table (basic structure — may lose data)
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('renstra_id')->nullable()->constrained('renstra')->onDelete('cascade');
            $table->string('kode_program', 20);
            $table->string('nama_program');
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->timestamps();
        });

        // Move renstra_program data back to programs (basic)
        DB::statement('INSERT INTO programs (renstra_id, kode_program, nama_program, deskripsi, status, created_at, updated_at) SELECT pr.strategi_id, pr.kode_program, pr.nama_program, pr.deskripsi, pr.status, pr.created_at, pr.updated_at FROM renstra_program pr');

        // Re-link kegiatan
        DB::statement('UPDATE kegiatans k JOIN programs p ON p.nama_program = (SELECT rp.nama_program FROM renstra_program rp WHERE rp.id = k.program_id) SET k.program_id = p.id');

        // Restore FK
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
        });

        // Reverse renstra_program changes
        Schema::table('renstra_program', function (Blueprint $table) {
            $table->dropForeign(['strategi_id']);
            $table->dropColumn(['kode_program', 'deskripsi', 'status']);
            $table->renameColumn('nama_program', 'program_tahunan');
            $table->renameColumn('strategi_id', 'renstra_strategi_id');
        });
        Schema::table('renstra_program', function (Blueprint $table) {
            $table->foreign('renstra_strategi_id')->references('id')->on('renstra_strategi')->onDelete('cascade');
        });

        // Reverse renstra_strategi changes
        Schema::table('renstra_strategi', function (Blueprint $table) {
            $table->dropForeign(['sasaran_id']);
            $table->renameColumn('nama_strategi', 'strategi');
            $table->renameColumn('sasaran_id', 'renstra_sasaran_id');
        });
        Schema::table('renstra_strategi', function (Blueprint $table) {
            $table->foreign('renstra_sasaran_id')->references('id')->on('renstra_sasaran')->onDelete('cascade');
        });

        // Restore bidang_id on renstra
        Schema::table('renstra', function (Blueprint $table) {
            $table->foreignId('bidang_id')->nullable()->constrained('bidangs')->onDelete('set null');
        });

        // Reverse renstra_sasaran changes
        Schema::table('renstra_sasaran', function (Blueprint $table) {
            $table->dropForeign(['bidang_id']);
            $table->dropColumn(['bidang_id', 'kode_sasaran']);
            $table->renameColumn('nama_sasaran', 'sasaran');
        });
    }
};
