<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GedungController;

// Halaman utama (home)
Route::get('/', function () {
    return view('home');
});

// 1. Route Khusus / Spesifik (WAJIB DITARUH DI ATAS {id})
Route::get('/gedung', [GedungController::class, 'index'])->name('gedung.index');
Route::get('/gedung/create', [GedungController::class, 'create'])->name('gedung.create');
Route::post('/gedung', [GedungController::class, 'store'])->name('gedung.store');
Route::get('/gedung/search', [GedungController::class, 'search'])->name('gedung.search');

// 2. Route Dinamis dengan Parameter {id} (WAJIB DITARUH DI PALING BAWAH)
Route::get('/gedung/{id}', [GedungController::class, 'show'])->name('gedung.show');