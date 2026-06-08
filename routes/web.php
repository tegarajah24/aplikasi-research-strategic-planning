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
        $stats = [
            ['label' => 'Fakultas',           'count' => \App\Models\Fakultas::count(),            'color' => 'blue',    'icon' => 'building',   'route' => 'fakultas.index'],
            ['label' => 'Prodi',              'count' => \App\Models\Prodi::count(),               'color' => 'indigo',  'icon' => 'academic',  'route' => 'prodi.index'],
            ['label' => 'Kerja Sama',         'count' => \App\Models\Kerjasama::count(),           'color' => 'cyan',    'icon' => 'handshake', 'route' => 'kerjasama.index'],
            ['label' => 'Dosen',              'count' => \App\Models\Dosen::count(),               'color' => 'teal',    'icon' => 'users',     'route' => 'dosen.index'],
            ['label' => 'Prestasi Akademik',  'count' => \App\Models\PrestasiAkademik::count(),    'color' => 'amber',   'icon' => 'trophy',    'route' => 'prestasi-akademik.index'],
            ['label' => 'Prestasi Non-Akademik','count' => \App\Models\PrestasiNonAkademik::count(),'color' => 'orange', 'icon' => 'star',     'route' => 'prestasi-non-akademik.index'],
            ['label' => 'HKI',                'count' => \App\Models\Hki::count(),                 'color' => 'rose',    'icon' => 'shield',   'route' => 'hki.index'],
            ['label' => 'Buku',               'count' => \App\Models\Buku::count(),                'color' => 'pink',    'icon' => 'book',     'route' => 'buku.index'],
            ['label' => 'Artikel',            'count' => \App\Models\Artikel::count(),             'color' => 'fuchsia', 'icon' => 'document', 'route' => 'artikel.index'],
            ['label' => 'Bidang',             'count' => \App\Models\Bidang::count(),              'color' => 'red',     'icon' => 'tag',      'route' => 'bidang.index'],
            ['label' => 'Program',            'count' => \App\Models\Program::count(),             'color' => 'violet',  'icon' => 'folder',   'route' => 'program.index'],
            ['label' => 'Kegiatan RKT',       'count' => \App\Models\Kegiatan::count(),            'color' => 'emerald', 'icon' => 'clipboard','route' => 'kegiatan.index'],
        ];

        $totalEntities = count($stats);
        $filledEntities = collect($stats)->filter(fn($s) => $s['count'] > 0)->count();
        $dataCompleteness = $totalEntities > 0 ? round($filledEntities / $totalEntities * 100) : 0;

        $semester = now()->month >= 7 ? 'Ganjil' : 'Genap';
        $tahunAkademik = now()->month >= 7
            ? now()->year . ' / ' . (now()->year + 1)
            : (now()->year - 1) . ' / ' . now()->year;

        return view('dashboard.index', compact('stats', 'dataCompleteness', 'semester', 'tahunAkademik'));
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