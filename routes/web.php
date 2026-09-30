<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\AuthController; // Pindahkan import ke paling atas



// ----------------------------------------------------
// 1. ROUTE KHUSUS GUEST / TAMU (Hanya bisa diakses jika BELUM login)
// ----------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// ----------------------------------------------------
// 2. ROUTE KHUSUS AUTHENTICATED (Hanya bisa diakses setelah LOGIN)
// ----------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Halaman Utama Admin (views/admin/home.blade.php atau views/home/admin.blade.php)
    Route::get('/admin/home', function () {
        return view('admin.home'); // Ubah ke 'home.admin' jika file Anda ada di views/home/admin.blade.php
    })->name('admin.home');

    // Pindahkan rute CRUD internal ke dalam middleware auth
    Route::resource('gedung', GedungController::class);
    Route::resource('ruangan', RuanganController::class);
    Route::resource('pengguna', PenggunaController::class);
});

// ----------------------------------------------------
// 3. ROUTE PUBLIK
// ----------------------------------------------------
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/search', [SearchController::class, 'index'])->name('search');