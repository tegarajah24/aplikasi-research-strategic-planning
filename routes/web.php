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
    Route::get('/kerjasama', function () {
        return view('kerjasama.index');
    })->name('kerjasama');

    // Modul Dosen
    Route::get('/dosen', function () {
        return view('dosen.index');
    })->name('dosen');

    // Modul Prestasi Akademik
    Route::get('/prestasi-akademik', function () {
        return view('prestasi-akademik.index');
    })->name('prestasi-akademik');

    // Modul Prestasi Non-Akademik
    Route::get('/prestasi-non-akademik', function () {
        return view('prestasi-non-akademik.index');
    })->name('prestasi-non-akademik');

    // Modul HKI
    Route::get('/hki', function () {
        return view('hki.index');
    })->name('hki');

    // Modul Buku
    Route::get('/buku', function () {
        return view('buku.index');
    })->name('buku');

    // Modul Artikel
    Route::get('/artikel', function () {
        return view('artikel.index');
    })->name('artikel');

});