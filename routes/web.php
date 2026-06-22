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
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

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
        Route::get('renstra', [App\Http\Controllers\RenstraController::class, 'index'])->name('renstra.index');
        Route::post('renstra', [App\Http\Controllers\RenstraController::class, 'store'])->name('renstra.store');
        Route::match(['PUT', 'PATCH', 'POST'], 'renstra/{renstra}', [App\Http\Controllers\RenstraController::class, 'update'])->name('renstra.update');
        Route::delete('renstra/{renstra}', [App\Http\Controllers\RenstraController::class, 'destroy'])->name('renstra.destroy');
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

        Route::get('/rkt/kalender', [App\Http\Controllers\KalenderController::class, 'index'])->name('rkt.kalender');
    });

});