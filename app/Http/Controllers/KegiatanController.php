<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of kegiatan with search, filter, and pagination.
     */
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        // Search by name, code, or PIC
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_kegiatan', 'like', "%{$search}%")
                  ->orWhere('kode_kegiatan', 'like', "%{$search}%")
                  ->orWhere('penanggung_jawab', 'like', "%{$search}%")
                  ->orWhere('indikator_kinerja', 'like', "%{$search}%");
            });
        }

        // Filter by tahun_akademik
        if ($request->filled('tahun_akademik')) {
            $query->where('tahun_akademik', $request->tahun_akademik);
        }

        // Filter by penanggung_jawab
        if ($request->filled('penanggung_jawab')) {
            $query->where('penanggung_jawab', $request->penanggung_jawab);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $kegiatans = $query->latest()->paginate(10)->withQueryString();

        // Dashboard stats
        $totalKegiatan    = Kegiatan::count();
        $targetTercapai   = Kegiatan::where('status', 'selesai')->count();
        $totalAnggaran    = Kegiatan::sum('kebutuhan_anggaran');
        $kegiatanAktif    = Kegiatan::where('status', 'berjalan')->count();

        // Options for filters
        $tahunAkademikOptions   = Kegiatan::select('tahun_akademik')->distinct()->whereNotNull('tahun_akademik')->orderBy('tahun_akademik', 'desc')->pluck('tahun_akademik');
        $penanggungJawabOptions = Kegiatan::select('penanggung_jawab')->distinct()->orderBy('penanggung_jawab')->pluck('penanggung_jawab');

        return view('kegiatan.index', compact(
            'kegiatans',
            'totalKegiatan',
            'targetTercapai',
            'totalAnggaran',
            'kegiatanAktif',
            'tahunAkademikOptions',
            'penanggungJawabOptions'
        ));
    }

    /**
     * Store a newly created kegiatan.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->canWrite('kegiatan')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'kode_kegiatan'     => 'required|string|max:20',
            'nama_kegiatan'     => 'required|string|max:255',
            'indikator_kinerja' => 'required|string',
            'target_kegiatan'   => 'required|string|max:100',
            'penanggung_jawab'  => 'required|string|max:100',
            'waktu_pelaksanaan' => 'required|string|max:150',
            'waktu_mulai'       => 'nullable|date',
            'waktu_selesai'     => 'nullable|date',
            'tahun_akademik'    => 'nullable|string|max:20',
            'kebutuhan_anggaran'=> 'required|string|max:200',
            'status'            => 'required|in:perencanaan,berjalan,selesai,tertunda',
            'catatan'           => 'nullable|string',
            'dokumen'           => 'nullable|string',
        ]);

        $kegiatan = Kegiatan::create($validated);
        ActivityLog::log('Menambahkan kegiatan', 'Kegiatan', $kegiatan->id, $kegiatan->nama_kegiatan);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    /**
     * Update the specified kegiatan.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        if (!auth()->user()->canWrite('kegiatan')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'kode_kegiatan'     => 'required|string|max:20',
            'nama_kegiatan'     => 'required|string|max:255',
            'indikator_kinerja' => 'required|string',
            'target_kegiatan'   => 'required|string|max:100',
            'penanggung_jawab'  => 'required|string|max:100',
            'waktu_pelaksanaan' => 'required|string|max:150',
            'waktu_mulai'       => 'nullable|date',
            'waktu_selesai'     => 'nullable|date',
            'tahun_akademik'    => 'nullable|string|max:20',
            'kebutuhan_anggaran'=> 'required|string|max:200',
            'status'            => 'required|in:perencanaan,berjalan,selesai,tertunda',
            'catatan'           => 'nullable|string',
            'dokumen'           => 'nullable|string',
        ]);

        $kegiatan->update($validated);
        ActivityLog::log('Memperbarui kegiatan', 'Kegiatan', $kegiatan->id, $kegiatan->nama_kegiatan);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified kegiatan.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        if (!auth()->user()->canWrite('kegiatan')) {
            abort(403, 'Unauthorized action.');
        }

        ActivityLog::log('Menghapus kegiatan', 'Kegiatan', $kegiatan->id, $kegiatan->nama_kegiatan);
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}
