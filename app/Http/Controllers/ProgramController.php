<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Program;
use App\Models\Bidang;
use App\Models\Kegiatan;
use App\Models\Renstra;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = Program::with('renstra.bidang', 'renstra.fakultas', 'kegiatans');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_program', 'like', "%{$search}%")
                  ->orWhere('kode_program', 'like', "%{$search}%");
            });
        }

        if ($request->filled('renstra_id')) {
            $query->where('renstra_id', $request->renstra_id);
        }

        if ($request->filled('bidang_id')) {
            $query->whereHas('renstra', function ($q) use ($request) {
                $q->where('bidang_id', $request->bidang_id);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $programs = $query->latest()->paginate(10)->withQueryString();

        $totalProgram  = Program::count();
        $totalKegiatan = Kegiatan::count();
        $bidangs       = Bidang::withCount('programs')->get();
        $renstraList   = Renstra::with('fakultas', 'bidang')->orderBy('tahun_mulai', 'desc')->get();

        $bidangMaster = Bidang::all()->map(function ($b, $i) {
            $colors = ['#3b82f6','#6366f1','#8b5cf6','#10b981','#f59e0b','#ef4444','#ec4899','#14b8a6'];
            return [
                'id'    => $b->id,
                'no'    => $i + 1,
                'nama'  => $b->nama_bidang,
                'color' => $colors[$i % count($colors)],
            ];
        });

        $programList = Program::with('renstra.bidang', 'renstra.fakultas', 'kegiatans')->get()->map(function ($p) {
            return [
                'id'           => $p->id,
                'renstraId'    => $p->renstra_id,
                'bidangId'     => $p->renstra?->bidang_id,
                'fakultasId'   => $p->renstra?->fakultas_id,
                'kode'         => $p->kode_program,
                'nama'         => $p->nama_program,
                'sasaran'      => $p->renstra?->sasaran ?? '',
                'strategi'     => $p->renstra?->strategi ?? '',
                'rkt'          => $p->renstra?->program_tahunan ?? '',
                'status'       => $p->status,
                'kegiatan'     => $p->kegiatans->map(function ($k) {
                    return [
                        'nama'    => $k->nama_kegiatan,
                        'selesai' => $k->status === 'selesai',
                        'anggaran'=> $k->kebutuhan_anggaran ? (int) filter_var($k->kebutuhan_anggaran, FILTER_SANITIZE_NUMBER_INT) : 0,
                    ];
                }),
            ];
        });

        return view('master-data.program.index', compact(
            'programs', 'totalProgram', 'totalKegiatan', 'bidangs', 'bidangMaster', 'programList', 'renstraList'
        ));
    }

    public function store(StoreProgramRequest $request)
    {
        if (!auth()->user()->canWrite('program')) {
            abort(403, 'Unauthorized action.');
        }

        $program = Program::create($request->validated());
        ActivityLog::log('Menambahkan program', 'Program', $program->id, $program->nama_program);
        return redirect()->route('program.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function update(UpdateProgramRequest $request, Program $program)
    {
        if (!auth()->user()->canWrite('program')) {
            abort(403, 'Unauthorized action.');
        }

        $program->update($request->validated());
        ActivityLog::log('Memperbarui program', 'Program', $program->id, $program->nama_program);
        return redirect()->route('program.index')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program)
    {
        if (!auth()->user()->canWrite('program')) {
            abort(403, 'Unauthorized action.');
        }

        ActivityLog::log('Menghapus program', 'Program', $program->id, $program->nama_program);
        $program->delete();
        return redirect()->route('program.index')->with('success', 'Program berhasil dihapus.');
    }
}