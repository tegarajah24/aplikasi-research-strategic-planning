<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Bidang;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = Program::with('bidang')->withCount('kegiatans');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_program', 'like', "%{$search}%")
                  ->orWhere('kode_program', 'like', "%{$search}%");
            });
        }

        if ($request->filled('bidang_id')) {
            $query->where('bidang_id', $request->bidang_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $programs = $query->latest()->paginate(10)->withQueryString();

        $totalProgram  = Program::count();
        $totalKegiatan = \App\Models\Kegiatan::count();
        $totalAnggaran = Program::sum('anggaran');
        $bidangs       = Bidang::withCount('programs')->get();

        return view('master-data.program.index', compact(
            'programs', 'totalProgram', 'totalKegiatan', 'totalAnggaran', 'bidangs'
        ));
    }

    public function store(StoreProgramRequest $request)
    {
        Program::create($request->validated());
        return redirect()->route('program.index')->with('success', 'Program berhasil ditambahkan.');
    }

    public function update(UpdateProgramRequest $request, Program $program)
    {
        $program->update($request->validated());
        return redirect()->route('program.index')->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('program.index')->with('success', 'Program berhasil dihapus.');
    }
}
