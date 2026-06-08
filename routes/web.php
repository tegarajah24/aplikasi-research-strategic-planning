<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard utama
    Route::get('/dashboard', function () {
        $totalUsers = \App\Models\User::count();
        $totalFakultas = \App\Models\Fakultas::count();
        $totalProdi = \App\Models\Prodi::count();
        $totalDosen = \App\Models\Dosen::count();
        $totalHki = \App\Models\Hki::count();
        $totalBuku = \App\Models\Buku::count();
        $totalArtikel = \App\Models\Artikel::count();
        $totalLuaran = $totalHki + $totalBuku + $totalArtikel;
        $totalKerjasama = \App\Models\Kerjasama::count();
        $totalPrestasi = \App\Models\PrestasiAkademik::count() + \App\Models\PrestasiNonAkademik::count();

        $upcomingKegiatans = \App\Models\Kegiatan::where('waktu_mulai', '>=', now())
            ->orderBy('waktu_mulai')
            ->take(5)
            ->get();

        $recentLogs = \App\Models\ActivityLog::with('user')
            ->latest()
            ->take(10)
            ->get();

        $artikelPerTahun = \App\Models\Artikel::selectRaw('tahun as year, count(*) as total')
            ->groupBy('tahun')->orderBy('tahun')->pluck('total', 'year');
        $bukuPerTahun = \App\Models\Buku::selectRaw('tahun_terbit as year, count(*) as total')
            ->groupBy('tahun_terbit')->orderBy('tahun_terbit')->pluck('total', 'year');
        $hkiPerTahun = \App\Models\Hki::selectRaw('tahun as year, count(*) as total')
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

        $renstraStatus = \App\Models\Renstra::selectRaw('status, count(*) as total')
            ->groupBy('status')->pluck('total', 'status');
        $totalRenstra = \App\Models\Renstra::count();

        return view('dashboard.index', compact(
            'totalUsers', 'totalFakultas', 'totalProdi', 'totalDosen',
            'totalHki', 'totalBuku', 'totalArtikel', 'totalLuaran',
            'totalKerjasama', 'totalPrestasi', 'upcomingKegiatans',
            'recentLogs', 'chartLabels', 'chartArtikel', 'chartBuku', 'chartHki',
            'renstraStatus', 'totalRenstra'
        ));
    })->name('dashboard');

    // Modul Pengguna
    Route::get('/pengguna', [App\Http\Controllers\UserController::class, 'index'])->name('pengguna');
    Route::post('/pengguna', [App\Http\Controllers\UserController::class, 'store'])->name('pengguna.store');
    Route::put('/pengguna/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('pengguna.destroy');
    Route::post('/pengguna/{user}/reset-password', [App\Http\Controllers\UserController::class, 'resetPassword'])->name('pengguna.reset-password');

    // Modul Fakultas
    Route::resource('fakultas', App\Http\Controllers\FakultasController::class)->except(['create', 'show', 'edit']);

    // Modul Prodi
    Route::resource('prodi', App\Http\Controllers\ProdiController::class)->except(['create', 'show', 'edit']);

    // Modul Kerja Sama
    Route::post('/kerjasama/import', [App\Http\Controllers\KerjasamaController::class, 'import'])->name('kerjasama.import');
    Route::resource('kerjasama', App\Http\Controllers\KerjasamaController::class)->except(['create', 'show', 'edit']);

    // Modul Dosen
    Route::post('/dosen/import', [App\Http\Controllers\DosenController::class, 'import'])->name('dosen.import');
    Route::resource('dosen', App\Http\Controllers\DosenController::class)->except(['create', 'show', 'edit']);

    // Modul Prestasi Akademik
    Route::post('/prestasi-akademik/import', [App\Http\Controllers\PrestasiAkademikController::class, 'import'])->name('prestasi-akademik.import');
    Route::get('/prestasi-akademik/export', [App\Http\Controllers\PrestasiAkademikController::class, 'export'])->name('prestasi-akademik.export');
    Route::resource('prestasi-akademik', App\Http\Controllers\PrestasiAkademikController::class)->except(['create', 'show', 'edit']);

    // Modul Prestasi Non-Akademik
    Route::post('/prestasi-non-akademik/import', [App\Http\Controllers\PrestasiNonAkademikController::class, 'import'])->name('prestasi-non-akademik.import');
    Route::get('/prestasi-non-akademik/export', [App\Http\Controllers\PrestasiNonAkademikController::class, 'export'])->name('prestasi-non-akademik.export');
    Route::resource('prestasi-non-akademik', App\Http\Controllers\PrestasiNonAkademikController::class)->except(['create', 'show', 'edit']);

    // Modul HKI
    Route::post('/hki/import', [App\Http\Controllers\HkiController::class, 'import'])->name('hki.import');
    Route::resource('hki', App\Http\Controllers\HkiController::class)->except(['create', 'show', 'edit']);

    // Modul Buku
    Route::post('/buku/import', [App\Http\Controllers\BukuController::class, 'import'])->name('buku.import');
    Route::resource('buku', App\Http\Controllers\BukuController::class)->except(['create', 'show', 'edit']);

    // Modul Artikel
    Route::post('/artikel/import', [App\Http\Controllers\ArtikelController::class, 'import'])->name('artikel.import');
    Route::resource('artikel', App\Http\Controllers\ArtikelController::class)->except(['create', 'show', 'edit']);
    // Modul Kegiatan Penelitian (RKT)
    Route::resource('rkt/kegiatan', App\Http\Controllers\KegiatanController::class)
        ->except(['create', 'show', 'edit'])
        ->names('kegiatan');

    // Modul Kalender RKT
    Route::get('/rkt/kalender', function () {
        $kegiatans = \App\Models\Kegiatan::with('program.bidang')
            ->whereNotNull('waktu_mulai')
            ->orderBy('waktu_mulai')
            ->get();

        $eventsData = $kegiatans->map(function ($k) {
            $statusMap = [
                'perencanaan' => 'upcoming',
                'berjalan'    => 'running',
                'selesai'     => 'done',
                'tertunda'    => 'late',
            ];
            return [
                'id'        => $k->id,
                'title'     => $k->nama_kegiatan,
                'program'   => $k->program?->nama_program ?? '-',
                'bidang'    => $k->program?->bidang?->nama_bidang ?? '-',
                'start'     => $k->waktu_mulai,
                'end'       => $k->waktu_selesai ?? $k->waktu_mulai,
                'pj'        => $k->penanggung_jawab,
                'status'    => $statusMap[$k->status] ?? 'upcoming',
                'anggaran'  => $k->kebutuhan_anggaran,
                'indikator' => $k->indikator_kinerja,
                'target'    => $k->target_kegiatan,
                'dokumen'   => $k->dokumen ?? '-',
            ];
        })->values();

        $bidangList = \App\Models\Bidang::where('status', 'Aktif')->orderBy('nama_bidang')->get();

        return view('rkt.kalender.index', compact('eventsData', 'bidangList'));
    })->name('rkt.kalender');

    // Master Data – Bidang
    Route::resource('bidang', App\Http\Controllers\BidangController::class)->except(['create', 'show', 'edit']);

    // Master Data – Program
    Route::resource('program', App\Http\Controllers\ProgramController::class)->except(['create', 'show', 'edit']);

    // Master Data – Renstra
    Route::resource('renstra', App\Http\Controllers\RenstraController::class)->except(['create', 'show', 'edit']);

});