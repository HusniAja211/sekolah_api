<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\SiswaController;
use App\Http\Controllers\api\GuruController;
use App\Http\Controllers\api\KelasController;
use App\Http\Controllers\api\MapelController;
use App\Http\Controllers\api\JadwalPelajaranController;

// Route untuk user yang membutuhkan autentikasi Sanctum
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API Resource Routes
Route::apiResource('guru', GuruController::class);

Route::apiResource('kelas', KelasController::class);

Route::apiResource('mapel', MapelController::class);

Route::apiResource('siswa', SiswaController::class);

Route::apiResource('jadwalpelajaran', JadwalPelajaranController::class);