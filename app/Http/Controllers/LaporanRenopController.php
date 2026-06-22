<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Exports\RenopExport;
use Illuminate\Http\Request;

class LaporanRenopController extends Controller
{
    public function index(Request $request)
    {
        $tahunAkademik = $request->input('tahun_akademik', '2024/2025');

        $kegiatans = Kegiatan::with([
            'program.renstraStrategi.renstraSasaran.bidang'
        ])->when($tahunAkademik, fn($q, $v) =>
            $q->where('tahun_akademik', $v)
        )->get();

        $grouped = $kegiatans->groupBy([
            fn($k) => $k->program?->renstraStrategi?->renstraSasaran?->bidang?->nama_bidang ?? 'Tanpa Bidang',
            fn($k) => $k->program?->nama_program ?? 'Tanpa Program',
        ])->sortKeys();

        $tahunAkademikOptions = Kegiatan::select('tahun_akademik')
            ->distinct()->whereNotNull('tahun_akademik')
            ->orderBy('tahun_akademik', 'desc')->pluck('tahun_akademik');

        $grandTotal = $kegiatans->sum('kebutuhan_anggaran');

        return view('laporan.renop.index', compact(
            'grouped', 'tahunAkademik', 'tahunAkademikOptions', 'grandTotal'
        ));
    }

    public function exportExcel(Request $request, $tahunAkademik)
    {
        return (new RenopExport($tahunAkademik))->download(
            "renop_tahunan_{$tahunAkademik}.xlsx"
        );
    }
}
