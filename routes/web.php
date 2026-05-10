<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// LOGIN
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginProses'])->name('loginProses');

// REGISTER
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registerProses'])->name('registerProses');

// LOGOUT
Route::post('logout', [AuthController::class, 'logout'])->name('logout');



/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'admin.'])->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\Admin\BerandaController::class, 'index'])
        ->name('admin.dashboard');

    // ALAT LAB
    Route::resource('/alatlab', \App\Http\Controllers\Admin\AlatLabController::class)
        ->names('admin.alatlab');

    // PEMINJAMAN
    Route::get('/peminjaman', [\App\Http\Controllers\Admin\PeminjamController::class, 'index'])
        ->name('admin.peminjaman.index');

    Route::post('/peminjaman/{id}/status', [\App\Http\Controllers\Admin\PeminjamController::class, 'updateStatus'])
        ->name('admin.peminjaman.status');

    // PENGEMBALIAN
    Route::get('/pengembalian', [\App\Http\Controllers\Admin\PengembalianController::class, 'index'])
        ->name('admin.pengembalian.index');
});



/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\User\BerandaController::class, 'index'])
        ->name('user.dashboard');

    Route::get('/alat', [\App\Http\Controllers\User\AlatController::class, 'index'])
        ->name('user.alat');

    Route::get('/peminjaman', [\App\Http\Controllers\User\PeminjamanController::class, 'index'])
        ->name('user.peminjaman');

    Route::post('/pinjam', [\App\Http\Controllers\User\PeminjamanController::class, 'store'])
        ->name('user.pinjam');
});