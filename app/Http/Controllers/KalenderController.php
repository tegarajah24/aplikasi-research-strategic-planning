<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Kegiatan;

class KalenderController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::with('program.renstraStrategi.renstraSasaran.bidang')
            ->whereNotNull('tgl_mulai_pelaksanaan')
            ->orderBy('tgl_mulai_pelaksanaan')
            ->get();

        $eventsData = $kegiatans->map(function ($k) {
            return [
                'id'        => $k->id,
                'title'     => $k->nama_kegiatan,
                'program'   => $k->program?->nama_program ?? '-',
                'bidang'    => $k->program?->renstraStrategi?->renstraSasaran?->bidang?->nama_bidang ?? '-',
                'start'     => $k->tgl_mulai_pelaksanaan,
                'end'       => $k->tgl_selesai_pelaksanaan ?? $k->tgl_mulai_pelaksanaan,
                'pj'        => $k->penanggung_jawab,
                'status'    => Kegiatan::STATUS_CSS[$k->status] ?? 'upcoming',
                'anggaran'  => $k->kebutuhan_anggaran,
                'indikator' => $k->indikator_kinerja,
                'target'    => $k->target_kegiatan,
                'dokumen'   => $k->dokumen ?? '-',
            ];
        })->values();

        $bidangList = Bidang::where('status', Bidang::STATUS_AKTIF)->orderBy('nama_bidang')->get();

        return view('rkt.kalender.index', compact('eventsData', 'bidangList'));
    }
}
