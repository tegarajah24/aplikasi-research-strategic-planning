<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Fakultas;
use App\Models\Bidang;
use App\Models\Renstra;
use App\Models\RenstraSasaran;
use App\Models\RenstraStrategi;
use App\Models\RenstraProgram;
use Illuminate\Http\Request;

class RenstraController extends Controller
{
    public function index(Request $request)
    {
        $query = Renstra::with(['fakultas', 'bidang', 'programs', 'sasarans.strategis.programs']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                  ->orWhereHas('sasarans', function ($sq) use ($search) {
                      $sq->where('sasaran', 'like', "%{$search}%")
                        ->orWhereHas('strategis', function ($stq) use ($search) {
                            $stq->where('strategi', 'like', "%{$search}%")
                              ->orWhereHas('programs', function ($prq) use ($search) {
                                  $prq->where('program_tahunan', 'like', "%{$search}%");
                              });
                        });
                  });
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
                'kode' => $r->kode,
                'status' => $r->status ?? 'belum_tercapai',
                'totalProgram' => $r->programs->count(),
                'sasarans' => $r->sasarans->map(function ($s) {
                    return [
                        'id' => $s->id,
                        'sasaran' => $s->sasaran,
                        'urutan' => $s->urutan,
                        'strategis' => $s->strategis->map(function ($st) {
                            return [
                                'id' => $st->id,
                                'strategi' => $st->strategi,
                                'urutan' => $st->urutan,
                                'programs' => $st->programs->map(function ($p) {
                                    return [
                                        'id' => $p->id,
                                        'program_tahunan' => $p->program_tahunan,
                                        'urutan' => $p->urutan,
                                    ];
                                }),
                            ];
                        }),
                    ];
                }),
            ];
        })->toArray();

        return view('master-data.renstra.index', compact('renstras', 'flatRenstra', 'fakultasList', 'bidangList'));
    }

    private function syncSasarans(Renstra $renstra, array $sasarans): void
    {
        $existingIds = $renstra->sasarans()->pluck('id')->toArray();
        $incomingIds = [];

        foreach ($sasarans as $idx => $sasaranData) {
            $sasaran = $renstra->sasarans()->updateOrCreate(
                ['id' => $sasaranData['id'] ?? null],
                ['sasaran' => $sasaranData['sasaran'], 'urutan' => $idx + 1]
            );
            $incomingIds[] = $sasaran->id;

            $existingStrategiIds = $sasaran->strategis()->pluck('id')->toArray();
            $incomingStrategiIds = [];

            foreach ($sasaranData['strategis'] ?? [] as $si => $strategiData) {
                $strategi = $sasaran->strategis()->updateOrCreate(
                    ['id' => $strategiData['id'] ?? null],
                    ['strategi' => $strategiData['strategi'], 'urutan' => $si + 1]
                );
                $incomingStrategiIds[] = $strategi->id;

                $existingProgramIds = $strategi->programs()->pluck('id')->toArray();
                $incomingProgramIds = [];

                foreach ($strategiData['programs'] ?? [] as $pi => $programData) {
                    $program = $strategi->programs()->updateOrCreate(
                        ['id' => $programData['id'] ?? null],
                        ['program_tahunan' => $programData['program_tahunan'], 'urutan' => $pi + 1]
                    );
                    $incomingProgramIds[] = $program->id;
                }

                $toDeletePrograms = array_diff($existingProgramIds, $incomingProgramIds);
                if (!empty($toDeletePrograms)) {
                    RenstraProgram::whereIn('id', $toDeletePrograms)->delete();
                }
            }

            $toDeleteStrategis = array_diff($existingStrategiIds, $incomingStrategiIds);
            if (!empty($toDeleteStrategis)) {
                RenstraStrategi::whereIn('id', $toDeleteStrategis)->delete();
            }
        }

        $toDeleteSasarans = array_diff($existingIds, $incomingIds);
        if (!empty($toDeleteSasarans)) {
            RenstraSasaran::whereIn('id', $toDeleteSasarans)->delete();
        }
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
            'tahun_mulai'     => 'required|integer|min:2000|max:2099',
            'tahun_selesai'   => 'required|integer|min:2000|max:2099|gte:tahun_mulai',
            'status'          => 'nullable|string|in:tercapai,dalam_proses,belum_tercapai',
            'sasarans'        => 'required|array|min:1',
            'sasarans.*.sasaran'         => 'required|string|max:255',
            'sasarans.*.strategis'       => 'nullable|array',
            'sasarans.*.strategis.*.strategi'     => 'required|string|max:255',
            'sasarans.*.strategis.*.programs'     => 'nullable|array',
            'sasarans.*.strategis.*.programs.*.program_tahunan' => 'required|string|max:255',
        ]);

        $renstra = Renstra::create([
            'bidang_id'     => $validated['bidang_id'],
            'fakultas_id'   => $validated['fakultas_id'],
            'kode'          => $validated['kode'],
            'tahun_mulai'   => $validated['tahun_mulai'],
            'tahun_selesai' => $validated['tahun_selesai'],
            'status'        => $validated['status'] ?? 'belum_tercapai',
        ]);

        $this->syncSasarans($renstra, $request->input('sasarans', []));

        ActivityLog::log('Menambahkan renstra', 'Renstra', $renstra->id, $renstra->kode);
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
            'tahun_mulai'     => 'required|integer|min:2000|max:2099',
            'tahun_selesai'   => 'required|integer|min:2000|max:2099|gte:tahun_mulai',
            'status'          => 'nullable|string|in:tercapai,dalam_proses,belum_tercapai',
            'sasarans'        => 'required|array|min:1',
            'sasarans.*.sasaran'         => 'required|string|max:255',
            'sasarans.*.strategis'       => 'nullable|array',
            'sasarans.*.strategis.*.strategi'     => 'required|string|max:255',
            'sasarans.*.strategis.*.programs'     => 'nullable|array',
            'sasarans.*.strategis.*.programs.*.program_tahunan' => 'required|string|max:255',
        ]);

        $renstra->update([
            'bidang_id'     => $validated['bidang_id'],
            'fakultas_id'   => $validated['fakultas_id'],
            'kode'          => $validated['kode'],
            'tahun_mulai'   => $validated['tahun_mulai'],
            'tahun_selesai' => $validated['tahun_selesai'],
            'status'        => $validated['status'] ?? 'belum_tercapai',
        ]);

        $this->syncSasarans($renstra, $request->input('sasarans', []));

        ActivityLog::log('Memperbarui renstra', 'Renstra', $renstra->id, $renstra->kode);
        return redirect()->route('renstra.index')->with('success', 'Data RENSTRA berhasil diperbarui.');
    }

    public function destroy(Renstra $renstra)
    {
        if (!auth()->user()->canWrite('renstra')) {
            abort(403, 'Unauthorized action.');
        }

        ActivityLog::log('Menghapus renstra', 'Renstra', $renstra->id, $renstra->kode);
        $renstra->delete();
        return redirect()->route('renstra.index')->with('success', 'Data RENSTRA berhasil dihapus.');
    }
}