<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Bidang;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Http\Requests\StoreBidangRequest;
use App\Http\Requests\UpdateBidangRequest;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    public function index(Request $request)
    {
        $query = Bidang::with('renstras.fakultas', 'renstras.programs.kegiatans');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_bidang', 'like', "%{$search}%")
                  ->orWhere('kode_bidang', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bidangs = $query->latest()->paginate(10)->withQueryString();

        $totalBidang   = Bidang::count();
        $totalProgram  = Program::count();
        $totalKegiatan = Kegiatan::count();

        $bidangList = Bidang::with('renstras.programs.kegiatans')->get()->map(function ($b) {
            return [
                'id'        => $b->id,
                'kode'      => $b->kode_bidang,
                'nama'      => $b->nama_bidang,
                'deskripsi' => $b->deskripsi,
                'status'    => $b->status,
                'renstras'  => $b->renstras->map(function ($r) {
                    return [
                        'id'           => $r->id,
                        'fakultas'     => $r->fakultas?->nama_fakultas ?? '-',
                        'tahunMulai'   => $r->tahun_mulai,
                        'tahunSelesai' => $r->tahun_selesai,
                        'sasaran'      => $r->sasaran,
                        'strategi'     => $r->strategi,
                        'programTahunan'=> $r->program_tahunan,
                        'programs'     => $r->programs->map(function ($p) {
                            return [
                                'id'       => $p->id,
                                'nama'     => $p->nama_program,
                                'kegiatan' => $p->kegiatans->count(),
                            ];
                        }),
                    ];
                }),
            ];
        });

        return view('master-data.bidang.index', compact(
            'bidangs', 'totalBidang', 'totalProgram', 'totalKegiatan', 'bidangList'
        ));
    }

    public function store(StoreBidangRequest $request)
    {
        if (!auth()->user()->canWrite('bidang')) {
            abort(403, 'Unauthorized action.');
        }

        $bidang = Bidang::create($request->validated());
        ActivityLog::log('Menambahkan bidang', 'Bidang', $bidang->id, $bidang->nama_bidang);
        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil ditambahkan.');
    }

    public function update(UpdateBidangRequest $request, Bidang $bidang)
    {
        if (!auth()->user()->canWrite('bidang')) {
            abort(403, 'Unauthorized action.');
        }

        $bidang->update($request->validated());
        ActivityLog::log('Memperbarui bidang', 'Bidang', $bidang->id, $bidang->nama_bidang);
        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil diperbarui.');
    }

    public function destroy(Bidang $bidang)
    {
        if (!auth()->user()->canWrite('bidang')) {
            abort(403, 'Unauthorized action.');
        }

        ActivityLog::log('Menghapus bidang', 'Bidang', $bidang->id, $bidang->nama_bidang);
        $bidang->delete();
        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil dihapus.');
    }
}