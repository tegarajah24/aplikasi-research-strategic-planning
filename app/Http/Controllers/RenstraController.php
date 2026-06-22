<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Fakultas;
use App\Models\Bidang;
use App\Models\Renstra;
use Illuminate\Http\Request;

class RenstraController extends Controller
{
    public function index(Request $request)
    {
        $query = Renstra::with('fakultas', 'bidang', 'programs');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('sasaran', 'like', "%{$search}%")
                  ->orWhere('strategi', 'like', "%{$search}%")
                  ->orWhere('program_tahunan', 'like', "%{$search}%")
                  ->orWhere('kode', 'like', "%{$search}%");
            });
        }

        if ($request->filled('fakultas_id')) {
            $query->where('fakultas_id', $request->fakultas_id);
        }

        if ($request->filled('bidang_id')) {
            $query->where('bidang_id', $request->bidang_id);
        }

        $renstras = $query->latest()->paginate(10)->withQueryString();

        $fakultasList = Fakultas::orderBy('kode_fakultas', 'asc')->get();
        $bidangList = Bidang::orderBy('kode_bidang', 'asc')->get();

        $flatRenstra = $renstras->map(function ($r) {
            return [
                'id' => $r->id,
                'fakultas_id' => $r->fakultas_id,
                'bidang_id' => $r->bidang_id,
                'fakultas' => $r->fakultas?->nama_fakultas ?? 'Semua',
                'bidang' => $r->bidang?->nama_bidang ?? 'Tanpa Bidang',
                'tahunMulai' => $r->tahun_mulai,
                'tahunSelesai' => $r->tahun_selesai,
                'sasaranKode' => $r->kode,
                'sasaranNama' => $r->sasaran,
                'strategiNama' => $r->strategi,
                'programNama' => $r->program_tahunan,
                'status' => $r->status ?? 'belum_tercapai',
                'totalProgram' => $r->programs->count(),
            ];
        })->toArray();

        return view('master-data.renstra.index', compact('renstras', 'flatRenstra', 'fakultasList', 'bidangList'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->canWrite('renstra')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'bidang_id'       => 'nullable|exists:bidangs,id',
            'fakultas_id'     => 'nullable|exists:fakultas,id',
            'kode'            => 'nullable|string|max:20',
            'sasaran'         => 'required|string|max:255',
            'strategi'        => 'nullable|string|max:255',
            'program_tahunan' => 'nullable|string|max:255',
            'tahun_mulai'     => 'required|integer|min:2000|max:2099',
            'tahun_selesai'   => 'required|integer|min:2000|max:2099|gte:tahun_mulai',
            'status'          => 'nullable|string|in:tercapai,dalam_proses,belum_tercapai',
        ]);

        $renstra = Renstra::create($validated);
        ActivityLog::log('Menambahkan renstra', 'Renstra', $renstra->id, $renstra->sasaran);
        return redirect()->route('renstra.index')->with('success', 'Data RENSTRA berhasil ditambahkan.');
    }

    public function update(Request $request, Renstra $renstra)
    {
        if (!auth()->user()->canWrite('renstra')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'bidang_id'       => 'nullable|exists:bidangs,id',
            'fakultas_id'     => 'nullable|exists:fakultas,id',
            'kode'            => 'nullable|string|max:20',
            'sasaran'         => 'required|string|max:255',
            'strategi'        => 'nullable|string|max:255',
            'program_tahunan' => 'nullable|string|max:255',
            'tahun_mulai'     => 'required|integer|min:2000|max:2099',
            'tahun_selesai'   => 'required|integer|min:2000|max:2099|gte:tahun_mulai',
            'status'          => 'nullable|string|in:tercapai,dalam_proses,belum_tercapai',
        ]);

        $renstra->update($validated);
        ActivityLog::log('Memperbarui renstra', 'Renstra', $renstra->id, $renstra->sasaran);
        return redirect()->route('renstra.index')->with('success', 'Data RENSTRA berhasil diperbarui.');
    }

    public function destroy(Renstra $renstra)
    {
        if (!auth()->user()->canWrite('renstra')) {
            abort(403, 'Unauthorized action.');
        }

        ActivityLog::log('Menghapus renstra', 'Renstra', $renstra->id, $renstra->sasaran);
        $renstra->delete();
        return redirect()->route('renstra.index')->with('success', 'Data RENSTRA berhasil dihapus.');
    }
}