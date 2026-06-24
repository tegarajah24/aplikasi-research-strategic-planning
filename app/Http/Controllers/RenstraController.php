<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Renstra;
use App\Models\RenstraSasaran;
use App\Models\RenstraStrategi;
use App\Models\RenstraProgram;
use App\Models\Fakultas;
use App\Models\Bidang;
use App\Exports\RenstraTableExport;
use Illuminate\Http\Request;

class RenstraController extends Controller
{
    public function index(Request $request)
    {
        $query = Renstra::with(['fakultas', 'sasarans.bidang', 'sasarans.strategis.programs']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                  ->orWhereHas('sasarans', function ($sq) use ($search) {
                      $sq->where('nama_sasaran', 'like', "%{$search}%")
                        ->orWhereHas('strategis', function ($stq) use ($search) {
                            $stq->where('nama_strategi', 'like', "%{$search}%")
                              ->orWhereHas('programs', function ($prq) use ($search) {
                                  $prq->where('nama_program', 'like', "%{$search}%");
                              });
                        });
                  });
            });
        }

        if ($request->filled('fakultas_id')) {
            $query->where('fakultas_id', $request->fakultas_id);
        }

        if ($request->filled('bidang_id')) {
            $query->whereHas('sasarans', function ($q) use ($request) {
                $q->where('bidang_id', $request->bidang_id);
            });
        }

        $renstras = $query->latest()->paginate(10)->withQueryString();

        $fakultasList = Fakultas::orderBy('kode_fakultas', 'asc')->get();
        $bidangList = Bidang::orderBy('kode_bidang', 'asc')->get();

        $flatRenstra = $renstras->map(function ($r) {
            return [
                'id' => $r->id,
                'fakultas_id' => $r->fakultas_id,
                'fakultas' => $r->fakultas?->nama_fakultas ?? 'Semua',
                'tahunMulai' => $r->tahun_mulai,
                'tahunSelesai' => $r->tahun_selesai,
                'kode' => $r->kode,
                'status' => $r->status ?? Renstra::STATUS_BELUM_TERCAPAI,
                'sasarans' => $r->sasarans->map(function ($s) {
                    return [
                        'id' => $s->id,
                        'bidang_id' => $s->bidang_id,
                        'bidang' => $s->bidang?->nama_bidang ?? 'Tanpa Bidang',
                        'nama_sasaran' => $s->nama_sasaran,
                        'urutan' => $s->urutan,
                        'strategis' => $s->strategis->map(function ($st) {
                            return [
                                'id' => $st->id,
                                'nama_strategi' => $st->nama_strategi,
                                'urutan' => $st->urutan,
                                'programs' => $st->programs->map(function ($p) {
                                    return [
                                        'id' => $p->id,
                                        'nama_program' => $p->nama_program,
                                        'tahun_akademik' => $p->tahun_akademik,
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
                [
                    'bidang_id' => $sasaranData['bidang_id'] ?? null,
                    'kode_sasaran' => $sasaranData['kode_sasaran'] ?? null,
                    'nama_sasaran' => $sasaranData['nama_sasaran'],
                    'urutan' => $idx + 1,
                ]
            );
            $incomingIds[] = $sasaran->id;

            $existingStrategiIds = $sasaran->strategis()->pluck('id')->toArray();
            $incomingStrategiIds = [];

            foreach ($sasaranData['strategis'] ?? [] as $si => $strategiData) {
                $strategi = $sasaran->strategis()->updateOrCreate(
                    ['id' => $strategiData['id'] ?? null],
                    ['nama_strategi' => $strategiData['nama_strategi'], 'urutan' => $si + 1]
                );
                $incomingStrategiIds[] = $strategi->id;

                $existingProgramIds = $strategi->programs()->pluck('id')->toArray();
                $incomingProgramIds = [];

                foreach ($strategiData['programs'] ?? [] as $pi => $programData) {
                    $program = $strategi->programs()->updateOrCreate(
                        ['id' => $programData['id'] ?? null],
                        [
                            'nama_program' => $programData['nama_program'],
                            'tahun_akademik' => $programData['tahun_akademik'] ?? null,
                            'urutan' => $pi + 1,
                        ]
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
            'fakultas_id'     => 'nullable|exists:fakultas,id',
            'kode'            => 'nullable|string|max:20',
            'tahun_mulai'     => 'required|integer|min:2000|max:2099',
            'tahun_selesai'   => 'required|integer|min:2000|max:2099|gte:tahun_mulai',
            'status'          => 'nullable|string|in:' . implode(',', array_keys(Renstra::STATUSES)),
            'sasarans'        => 'required|array|min:1',
            'sasarans.*.bidang_id'                => 'nullable|exists:bidangs,id',
            'sasarans.*.kode_sasaran'             => 'nullable|string|max:20',
            'sasarans.*.nama_sasaran'             => 'required|string|max:255',
            'sasarans.*.strategis'                => 'nullable|array',
            'sasarans.*.strategis.*.nama_strategi' => 'required|string|max:255',
            'sasarans.*.strategis.*.programs'     => 'nullable|array',
            'sasarans.*.strategis.*.programs.*.nama_program' => 'required|string|max:255',
            'sasarans.*.strategis.*.programs.*.tahun_akademik' => 'nullable|string|max:20',
        ]);

        $renstra = Renstra::create([
            'fakultas_id'   => $validated['fakultas_id'],
            'kode'          => $validated['kode'],
            'tahun_mulai'   => $validated['tahun_mulai'],
            'tahun_selesai' => $validated['tahun_selesai'],
            'status'        => $validated['status'] ?? Renstra::STATUS_BELUM_TERCAPAI,
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
            'fakultas_id'     => 'nullable|exists:fakultas,id',
            'kode'            => 'nullable|string|max:20',
            'tahun_mulai'     => 'required|integer|min:2000|max:2099',
            'tahun_selesai'   => 'required|integer|min:2000|max:2099|gte:tahun_mulai',
            'status'          => 'nullable|string|in:' . implode(',', array_keys(Renstra::STATUSES)),
            'sasarans'        => 'required|array|min:1',
            'sasarans.*.bidang_id'                => 'nullable|exists:bidangs,id',
            'sasarans.*.kode_sasaran'             => 'nullable|string|max:20',
            'sasarans.*.nama_sasaran'             => 'required|string|max:255',
            'sasarans.*.strategis'                => 'nullable|array',
            'sasarans.*.strategis.*.nama_strategi' => 'required|string|max:255',
            'sasarans.*.strategis.*.programs'     => 'nullable|array',
            'sasarans.*.strategis.*.programs.*.nama_program' => 'required|string|max:255',
            'sasarans.*.strategis.*.programs.*.tahun_akademik' => 'nullable|string|max:20',
        ]);

        $renstra->update([
            'fakultas_id'   => $validated['fakultas_id'],
            'kode'          => $validated['kode'],
            'tahun_mulai'   => $validated['tahun_mulai'],
            'tahun_selesai' => $validated['tahun_selesai'],
            'status'        => $validated['status'] ?? Renstra::STATUS_BELUM_TERCAPAI,
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

    public function exportExcel(Request $request)
    {
        return (new RenstraTableExport($request->only(['periode', 'bidang_id', 'fakultas_id'])))
            ->download('data-program-renstra.xlsx');
    }

    public function exportWord(Request $request)
    {
        $query = RenstraSasaran::with(['bidang', 'strategis.programs', 'renstra']);

        if ($request->filled('periode')) {
            [$tahunMulai, $tahunSelesai] = explode('-', $request->periode);
            $query->whereHas('renstra', function ($q) use ($tahunMulai, $tahunSelesai) {
                $q->where('tahun_mulai', $tahunMulai)
                  ->where('tahun_selesai', $tahunSelesai);
            });
        }

        if ($request->filled('bidang_id')) {
            $query->where('bidang_id', $request->bidang_id);
        }

        if ($request->filled('fakultas_id')) {
            $query->whereHas('renstra', function ($q) use ($request) {
                $q->where('fakultas_id', $request->fakultas_id);
            });
        }

        $sasarans = $query->orderBy('nama_sasaran')->get();

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="data-program-renstra.doc"',
        ];

        return response()->view('master-data.renstra.export-word', compact('sasarans'), 200, $headers);
    }
}
