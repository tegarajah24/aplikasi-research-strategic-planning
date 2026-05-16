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

    // Modul Pengabdian
    Route::get('/pengabdian', function () {
        return view('pengabdian.index');
    })->name('pengabdian');

    // Modul Renop
    Route::get('/renop', function () {
        return view('renop.index');
    })->name('renop');

});