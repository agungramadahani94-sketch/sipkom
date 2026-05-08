<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AlatLabController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', function () {
    return view('welcome');
});



//login
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginProses'])->name('loginProses');

//register
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registerProses'])->name('registerProses');
//logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');



//----------------------------Admin Routes----------------------------
// Beranda
Route::get('beranda', [BerandaController::class, 'index'])->name('beranda');

// User page
Route::get('/user', [UserController::class, 'index'])->name('user.index');

// Peminjam
Route::resource('peminjam', PeminjamController::class);
Route::post('/peminjam/kembali/{id}', [PeminjamController::class, 'kembali'])
    ->name('peminjam.kembali');
// Alat Lab
Route::resource('alatlab', AlatLabController::class)->except(['show']);


// Pengembalian
Route::view('pengembalian', 'admin.pages.pengembalian.index')->name('pengembalian');
Route::get('/pengembalian', [PeminjamController::class, 'pengembalian'])
    ->name('pengembalian');

    