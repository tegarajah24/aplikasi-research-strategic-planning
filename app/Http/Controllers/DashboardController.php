<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Artikel;
use App\Models\Buku;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Hki;
use App\Models\Kegiatan;
use App\Models\Kerjasama;
use App\Models\PrestasiAkademik;
use App\Models\PrestasiNonAkademik;
use App\Models\Prodi;
use App\Models\Renstra;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalFakultas = Fakultas::count();
        $totalProdi = Prodi::count();
        $totalDosen = Dosen::count();
        $totalHki = Hki::count();
        $totalBuku = Buku::count();
        $totalArtikel = Artikel::count();
        $totalLuaran = $totalHki + $totalBuku + $totalArtikel;
        $totalKerjasama = Kerjasama::count();
        $totalPrestasi = PrestasiAkademik::count() + PrestasiNonAkademik::count();

        $upcomingKegiatans = Kegiatan::where('tgl_mulai_pelaksanaan', '>=', now())
            ->orderBy('tgl_mulai_pelaksanaan')
            ->take(5)
            ->get();

        $recentLogs = ActivityLog::with('user')
            ->latest()
            ->take(10)
            ->get();

        $artikelPerTahun = Artikel::selectRaw('tahun as year, count(*) as total')
            ->groupBy('tahun')->orderBy('tahun')->pluck('total', 'year');
        $bukuPerTahun = Buku::selectRaw('tahun_terbit as year, count(*) as total')
            ->groupBy('tahun_terbit')->orderBy('tahun_terbit')->pluck('total', 'year');
        $hkiPerTahun = Hki::selectRaw('tahun as year, count(*) as total')
            ->groupBy('tahun')->orderBy('tahun')->pluck('total', 'year');

        $allYears = collect([$artikelPerTahun, $bukuPerTahun, $hkiPerTahun])
            ->flatMap(fn($c) => $c->keys())
            ->unique()
            ->sort()
            ->values();

        $chartLabels = $allYears->toArray();
        $chartArtikel = $allYears->map(fn($y) => $artikelPerTahun[$y] ?? 0)->toArray();
        $chartBuku = $allYears->map(fn($y) => $bukuPerTahun[$y] ?? 0)->toArray();
        $chartHki = $allYears->map(fn($y) => $hkiPerTahun[$y] ?? 0)->toArray();

        $renstraStatus = Renstra::selectRaw('status, count(*) as total')
            ->groupBy('status')->pluck('total', 'status');
        $totalRenstra = Renstra::count();

        return view('dashboard.index', compact(
            'totalUsers', 'totalFakultas', 'totalProdi', 'totalDosen',
            'totalHki', 'totalBuku', 'totalArtikel', 'totalLuaran',
            'totalKerjasama', 'totalPrestasi', 'upcomingKegiatans',
            'recentLogs', 'chartLabels', 'chartArtikel', 'chartBuku', 'chartHki',
            'renstraStatus', 'totalRenstra'
        ));
    }
}
