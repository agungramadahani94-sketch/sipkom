<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\AlatLab;
use App\Models\Peminjam;
use App\Models\pengembalian;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\AlatLabController;
use App\Http\Controllers\User\BerandaController;
use App\Http\Controllers\User\PeminjamanController;
use App\Http\Controllers\User\PeminjamController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $activeMembers = User::where('role', 'user')->count();
    $loanCount = Peminjam::count();
    $availableCount = AlatLab::where('stok', '>', 0)->count();
    $assetCount = AlatLab::count();
    return view('landingpage.welcome', compact('activeMembers', 'loanCount', 'availableCount', 'assetCount'));
})->name('landingpage.welcome');

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

    Route::get('/dashboard', [BerandaController::class, 'index'])
        ->name('user.dashboard');

    Route::get('/alat', [AlatLabController::class, 'index'])
        ->name('user.alat');

    // ✅ FORM
    Route::get('/pinjam/{id}', [PeminjamController::class, 'create'])
        ->name('user.pinjam');

    // ✅ SIMPAN
    Route::post('/pinjam', [PeminjamController::class, 'store'])
        ->name('user.pinjam.store');

    // RIWAYAT
    Route::get('/peminjaman', [PeminjamController::class, 'index'])
        ->name('user.peminjaman');

    // KEMBALI
    Route::post('/kembali/{id}', [PeminjamController::class, 'kembali'])
        ->name('user.kembali');
});