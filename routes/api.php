<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\AlatLabApiController;
use App\Http\Controllers\Api\PeminjamApiController;
use App\Http\Controllers\Api\PengembalianApiController;


// ================= PUBLIC =================
Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);


// ================= AUTH USER =================
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/me', [AuthApiController::class, 'me']);


    // ================= ALAT LAB =================

    // Semua user bisa melihat alat
    Route::get('/alat', [AlatLabApiController::class, 'index']);
    Route::get('/alat/{id}', [AlatLabApiController::class, 'show']);


    // Khusus admin
    Route::middleware('apirole:admin')->group(function () {

        Route::post('/alat', [AlatLabApiController::class, 'store']);
        Route::put('/alat/{id}', [AlatLabApiController::class, 'update']);
        Route::delete('/alat/{id}', [AlatLabApiController::class, 'destroy']);

    });



    // ================= PEMINJAMAN =================

    // User
    Route::get('/peminjaman/saya', [PeminjamApiController::class, 'riwayatSaya']);
    Route::post('/peminjaman', [PeminjamApiController::class, 'store']);
    Route::get('/peminjaman/{id}', [PeminjamApiController::class, 'show']);
    Route::post('/peminjaman/{id}/kembali', [PeminjamApiController::class, 'kembali']);


    // Admin
    Route::middleware('apirole:admin')->group(function () {

        Route::get('/peminjaman', [PeminjamApiController::class, 'index']);

        Route::post(
            '/peminjaman/{id}/approve',
            [PeminjamApiController::class, 'approve']
        );

        Route::post(
            '/peminjaman/{id}/tolak',
            [PeminjamApiController::class, 'tolak']
        );

        Route::delete(
            '/peminjaman/{id}',
            [PeminjamApiController::class, 'destroy']
        );

    });



    // ================= PENGEMBALIAN =================

    Route::middleware('apirole:admin')->group(function () {

        Route::get(
            '/pengembalian',
            [PengembalianApiController::class, 'index']
        );

        Route::get(
            '/pengembalian/{id}',
            [PengembalianApiController::class, 'show']
        );

    });

});