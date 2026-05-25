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
    Route::get('/fakultas', function () {
        return view('fakultas.index');
    })->name('fakultas');

    // Modul Prodi
    Route::get('/prodi', function () {
        return view('prodi.index');
    })->name('prodi');

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

    // Modul RKT
    Route::get('/rkt/kegiatan', function () {
        return view('rkt.kegiatan.index');
    })->name('rkt.kegiatan');

    Route::get('/rkt/kalender', function () {
        return view('rkt.kalender.index');
    })->name('rkt.kalender');

});