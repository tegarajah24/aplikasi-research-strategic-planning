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
            ['label' => 'Fakultas',           'count' => \App\Models\Fakultas::count(),            'color' => 'blue',    'icon' => 'building'],
            ['label' => 'Prodi',              'count' => \App\Models\Prodi::count(),               'color' => 'indigo',  'icon' => 'academic'],
            ['label' => 'Kerja Sama',         'count' => \App\Models\Kerjasama::count(),           'color' => 'cyan',    'icon' => 'handshake'],
            ['label' => 'Dosen',              'count' => \App\Models\Penelitian::distinct('ketua')->count('ketua'),'color' => 'teal', 'icon' => 'users'],
            ['label' => 'Prestasi Akademik',  'count' => \App\Models\PrestasiAkademik::count(),    'color' => 'amber',   'icon' => 'trophy'],
            ['label' => 'Prestasi Non-Akademik','count' => 0,                                      'color' => 'orange',  'icon' => 'star'],
            ['label' => 'HKI',                'count' => \App\Models\Hki::count(),                 'color' => 'rose',    'icon' => 'shield'],
            ['label' => 'Buku',               'count' => \App\Models\Buku::count(),                'color' => 'pink',    'icon' => 'book'],
            ['label' => 'Artikel',            'count' => \App\Models\Artikel::count(),             'color' => 'fuchsia', 'icon' => 'document'],
            ['label' => 'Bidang',             'count' => \App\Models\Bidang::count(),              'color' => 'red',     'icon' => 'tag'],
            ['label' => 'Program',            'count' => \App\Models\Program::count(),             'color' => 'violet',  'icon' => 'folder'],
            ['label' => 'Kegiatan RKT',       'count' => \App\Models\Kegiatan::count(),            'color' => 'emerald', 'icon' => 'clipboard'],
        ];

        return view('dashboard.index', compact('stats'));
    })->name('dashboard');

    // Modul Penelitian
    Route::get('/penelitian', [App\Http\Controllers\PenelitianController::class, 'index'])->name('penelitian');

    // Modul Pengabmas
    Route::get('/pengabmas', [App\Http\Controllers\PengabmasController::class, 'index'])->name('pengabmas');

    // Modul Pengguna
    Route::get('/pengguna', [App\Http\Controllers\UserController::class, 'index'])->name('pengguna');

    // Modul Fakultas
    Route::resource('fakultas', App\Http\Controllers\FakultasController::class)->except(['create', 'show', 'edit']);

    // Modul Prodi
    Route::resource('prodi', App\Http\Controllers\ProdiController::class)->except(['create', 'show', 'edit']);

    // Modul Kerja Sama
    Route::post('/kerjasama/import', [App\Http\Controllers\KerjasamaController::class, 'import'])->name('kerjasama.import');
    Route::resource('kerjasama', App\Http\Controllers\KerjasamaController::class)->except(['create', 'show', 'edit']);

    // Modul Dosen
    Route::get('/dosen', function () {
        return view('dosen.index');
    })->name('dosen');

    // Modul Prestasi Akademik
    Route::post('/prestasi-akademik/import', [App\Http\Controllers\PrestasiAkademikController::class, 'import'])->name('prestasi-akademik.import');
    Route::get('/prestasi-akademik/export', [App\Http\Controllers\PrestasiAkademikController::class, 'export'])->name('prestasi-akademik.export');
    Route::resource('prestasi-akademik', App\Http\Controllers\PrestasiAkademikController::class)->except(['create', 'show', 'edit']);

    // Modul Prestasi Non-Akademik
    Route::get('/prestasi-non-akademik', function () {
        return view('prestasi-non-akademik.index');
    })->name('prestasi-non-akademik');

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
        return view('rkt.kalender.index');
    })->name('rkt.kalender');

    // Master Data – Bidang
    Route::get('/bidang', [App\Http\Controllers\BidangController::class, 'index'])->name('bidang');

    // Master Data – Program
    Route::get('/program', [App\Http\Controllers\ProgramController::class, 'index'])->name('program');

    // Master Data – Renstra
    Route::get('/renstra', [App\Http\Controllers\RenstraController::class, 'index'])->name('renstra');

});