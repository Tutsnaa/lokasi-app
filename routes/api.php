<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GedungController;

// Route untuk Gedung
Route::get('/gedung', [GedungController::class, 'index']);
Route::get('/gedung/create', [GedungController::class, 'create']);
Route::post('/gedung', [GedungController::class, 'store']);
Route::get('/gedung/{id}', [GedungController::class, 'show']);
Route::put('/gedung/{id}', [GedungController::class, 'update']);
Route::delete('/gedung/{id}', [GedungController::class, 'destroy']);

// Route pencarian dari halaman home
Route::get('/gedung/search', [GedungController::class, 'search']);

// Route detail gedung berdasarkan ID
Route::get('/gedung/{id}', [GedungController::class, 'show']);