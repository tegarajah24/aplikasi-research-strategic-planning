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
        return view('dashboard.index');
    })->name('dashboard');

    // Modul Penelitian
    Route::get('/penelitian', function () {
        return view('penelitian.index');
    })->name('penelitian');

    // Modul Pengabmas
    Route::get('/pengabmas', function () {
        return view('pengabmas.index');
    })->name('pengabmas');

    // Modul Renop
    Route::get('/renop', function () {
        return view('renop.index');
    })->name('renop');

    // Modul Bidang Keahlian
    Route::get('/bidang-keahlian', function () {
        return view('bidang-keahlian.index');
    })->name('bidang-keahlian');

    // Modul Fakultas
    Route::post('/fakultas/import', [App\Http\Controllers\FakultasController::class, 'import'])->name('fakultas.import');
    Route::get('/fakultas/export', [App\Http\Controllers\FakultasController::class, 'export'])->name('fakultas.export');
    Route::resource('fakultas', App\Http\Controllers\FakultasController::class)->except(['create', 'show', 'edit']);

    // Modul Prodi
    Route::post('/prodi/import', [App\Http\Controllers\ProdiController::class, 'import'])->name('prodi.import');
    Route::get('/prodi/export', [App\Http\Controllers\ProdiController::class, 'export'])->name('prodi.export');
    Route::resource('prodi', App\Http\Controllers\ProdiController::class)->except(['create', 'show', 'edit']);

    // Modul Pengguna
    Route::get('/pengguna', function () {
        return view('pengguna.index');
    })->name('pengguna');

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
    Route::get('/bidang', function () {
        return view('master-data.bidang.index');
    })->name('bidang');

    // Master Data – Program
    Route::get('/program', function () {
        return view('master-data.program.index');
    })->name('program');

    // Master Data – Renstra
    Route::get('/renstra', function () {
        return view('master-data.renstra.index');
    })->name('renstra');

});