<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\AlatLabController;
use App\Http\Controllers\User\BerandaController;
use App\Http\Controllers\User\PeminjamanController;

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

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\Admin\BerandaController::class, 'index'])
        ->name('beranda');

    // USER
    Route::get('/user', [\App\Http\Controllers\Admin\UserController::class, 'index'])
        ->name('user.index');

    // ALAT LAB
    Route::resource('/alatlab', \App\Http\Controllers\Admin\AlatLabController::class)
        ->names('alatlab');

    // PEMINJAMAN
    Route::get('/peminjaman', [\App\Http\Controllers\Admin\PeminjamController::class, 'index'])
        ->name('peminjam.index');

    Route::get('/peminjaman/create', [\App\Http\Controllers\Admin\PeminjamController::class, 'create'])
        ->name('peminjam.create');

    Route::post('/peminjaman', [\App\Http\Controllers\Admin\PeminjamController::class, 'store'])
        ->name('peminjam.store');

    Route::get('/peminjaman/{id}/edit', [\App\Http\Controllers\Admin\PeminjamController::class, 'edit'])
        ->name('peminjam.edit');

    Route::put('/peminjaman/{id}', [\App\Http\Controllers\Admin\PeminjamController::class, 'update'])
        ->name('peminjam.update');

    Route::delete('/peminjaman/{id}', [\App\Http\Controllers\Admin\PeminjamController::class, 'destroy'])
        ->name('peminjam.destroy');

    Route::post('/peminjaman/{id}/kembali', [\App\Http\Controllers\Admin\PeminjamController::class, 'kembali'])
        ->name('peminjam.kembali');

    // PENGEMBALIAN
    Route::get('/pengembalian', [\App\Http\Controllers\Admin\PeminjamController::class, 'pengembalian'])
        ->name('pengembalian');
});



/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\User\BerandaController::class, 'index'])
        ->name('user.dashboard');

   Route::get('/alat', [\App\Http\Controllers\User\AlatLabController::class, 'index'])
    ->name('user.alat');

    Route::get('/peminjaman', [\App\Http\Controllers\User\PeminjamController::class, 'index'])
        ->name('user.peminjaman');

    Route::post('/pinjam', [\App\Http\Controllers\User\PeminjamController::class, 'store'])
        ->name('user.pinjam');

    Route::post('/kembali/{id}', [\App\Http\Controllers\User\PeminjamController::class, 'kembali'])
        ->name('user.kembali');
});