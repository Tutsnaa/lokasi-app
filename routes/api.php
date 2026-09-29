<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GedungController;

// Route untuk Gedung
Route::get('/gedung', [Gedung::class, 'index']);
Route::post('/gedung', [Gedung::class, 'store']);
Route::get('/gedung/{id}', [GedungController::class, 'show']);
Route::get('/gedung', [GedungController::class, 'show']);
Route::put('/gedung/{id}', [Gedung::class, 'update']);
Route::delete('/gedung/{id}', [Gedung::class, 'destroy']);