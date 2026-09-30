<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('home');
});

// Route Pencarian Global
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Route CRUD lengkap (Index, Create, Store, Show, Edit, Update, Destroy)
Route::resource('gedung', GedungController::class);

// Resource Route untuk Ruangan
Route::resource('ruangan', RuanganController::class);