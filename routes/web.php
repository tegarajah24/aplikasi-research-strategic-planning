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

    // Dashboard utama — semua role bisa akses
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

        $upcomingKegiatans = \App\Models\Kegiatan::where('tgl_mulai_pelaksanaan', '>=', now())
            ->orderBy('tgl_mulai_pelaksanaan')
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

    // ── Admin Only ──
    Route::middleware(['role:Admin'])->group(function () {
        Route::get('/pengguna', [App\Http\Controllers\UserController::class, 'index'])->name('pengguna');
        Route::post('/pengguna', [App\Http\Controllers\UserController::class, 'store'])->name('pengguna.store');
        Route::put('/pengguna/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('pengguna.update');
        Route::delete('/pengguna/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('pengguna.destroy');
        Route::patch('/pengguna/{user}/toggle-status', [App\Http\Controllers\UserController::class, 'toggleStatus'])->name('pengguna.toggle-status');
    });

    // ── Admin, Dekan ──
    Route::middleware(['role:Admin,Dekan'])->group(function () {
        Route::resource('fakultas', App\Http\Controllers\FakultasController::class)->parameters(['fakultas' => 'fakultas'])->except(['create', 'show', 'edit']);
        Route::resource('prodi', App\Http\Controllers\ProdiController::class)->except(['create', 'show', 'edit']);
        Route::resource('renstra', App\Http\Controllers\RenstraController::class)->except(['create', 'show', 'edit']);
    });

    // ── Admin, LPPM ──
    Route::middleware(['role:Admin,LPPM'])->group(function () {
        Route::resource('bidang', App\Http\Controllers\BidangController::class)->except(['create', 'show', 'edit']);
    });

    // ── Admin, Dekan, LPPM (non-Kaprodi) ──
    Route::middleware(['role:Admin,Dekan,LPPM'])->group(function () {
        Route::post('/kerjasama/import', [App\Http\Controllers\KerjasamaController::class, 'import'])->name('kerjasama.import');
        Route::resource('kerjasama', App\Http\Controllers\KerjasamaController::class)->except(['create', 'show', 'edit']);
    });

    // ── Admin, Dekan, Kaprodi ──
    Route::middleware(['role:Admin,Dekan,Kaprodi'])->group(function () {
        Route::post('/prestasi-akademik/import', [App\Http\Controllers\PrestasiAkademikController::class, 'import'])->name('prestasi-akademik.import');
        Route::get('/prestasi-akademik/export', [App\Http\Controllers\PrestasiAkademikController::class, 'export'])->name('prestasi-akademik.export');
        Route::resource('prestasi-akademik', App\Http\Controllers\PrestasiAkademikController::class)->except(['create', 'show', 'edit']);

        Route::post('/prestasi-non-akademik/import', [App\Http\Controllers\PrestasiNonAkademikController::class, 'import'])->name('prestasi-non-akademik.import');
        Route::get('/prestasi-non-akademik/export', [App\Http\Controllers\PrestasiNonAkademikController::class, 'export'])->name('prestasi-non-akademik.export');
        Route::resource('prestasi-non-akademik', App\Http\Controllers\PrestasiNonAkademikController::class)->except(['create', 'show', 'edit']);
    });

    // ── Admin, Dekan, LPPM, Kaprodi (semua terotentikasi) ──
    Route::middleware(['role:Admin,Dekan,LPPM,Kaprodi'])->group(function () {
        Route::post('/dosen/import', [App\Http\Controllers\DosenController::class, 'import'])->name('dosen.import');
        Route::resource('dosen', App\Http\Controllers\DosenController::class)->except(['create', 'show', 'edit']);

        Route::post('/hki/import', [App\Http\Controllers\HkiController::class, 'import'])->name('hki.import');
        Route::resource('hki', App\Http\Controllers\HkiController::class)->except(['create', 'show', 'edit']);

        Route::post('/buku/import', [App\Http\Controllers\BukuController::class, 'import'])->name('buku.import');
        Route::resource('buku', App\Http\Controllers\BukuController::class)->except(['create', 'show', 'edit']);

        Route::post('/artikel/import', [App\Http\Controllers\ArtikelController::class, 'import'])->name('artikel.import');
        Route::resource('artikel', App\Http\Controllers\ArtikelController::class)->except(['create', 'show', 'edit']);

        Route::resource('rkt/kegiatan', App\Http\Controllers\KegiatanController::class)
            ->except(['create', 'show', 'edit'])
            ->names('kegiatan');

        Route::get('/rkt/kalender', function () {
            $kegiatans = \App\Models\Kegiatan::with('program.renstraStrategi.renstraSasaran.bidang')
                ->whereNotNull('tgl_mulai_pelaksanaan')
                ->orderBy('tgl_mulai_pelaksanaan')
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
                    'bidang'    => $k->program?->renstraStrategi?->renstraSasaran?->bidang?->nama_bidang ?? '-',
                    'start'     => $k->tgl_mulai_pelaksanaan,
                    'end'       => $k->tgl_selesai_pelaksanaan ?? $k->tgl_mulai_pelaksanaan,
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
    });

});