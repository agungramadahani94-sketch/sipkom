<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\AlatLab;
use App\Models\Peminjam;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\AlatLabController;
use App\Http\Controllers\User\BerandaController;
use App\Http\Controllers\User\PeminjamController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $activeMembers = User::where('role', 'user')->count();
    $loanCount     = Peminjam::count();
    $availableCount = AlatLab::where('stok', '>', 0)->count();
    $assetCount    = AlatLab::count();
    return view('landingpage.welcome', compact('activeMembers', 'loanCount', 'availableCount', 'assetCount'));
})->name('landingpage.welcome');

Route::get('login',  [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginProses'])->name('loginProses');

Route::get('register',  [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registerProses'])->name('registerProses');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Admin\BerandaController::class, 'index'])
        ->name('beranda');

    // User
    Route::get('/user', [\App\Http\Controllers\Admin\UserController::class, 'index'])
        ->name('user.index');

    // Alat Lab
    Route::resource('/alatlab', \App\Http\Controllers\Admin\AlatLabController::class)
        ->names('alatlab');

    // -------------------------------------------------------
    // PEMINJAMAN
    // -------------------------------------------------------

    // Halaman permohonan menunggu approval
    Route::get('/peminjaman', [\App\Http\Controllers\Admin\PeminjamController::class, 'index'])
        ->name('peminjam.index');

    // Halaman peminjaman aktif (sudah diapprove)
    Route::get('/peminjaman-aktif', [\App\Http\Controllers\Admin\PeminjamController::class, 'aktif'])
        ->name('peminjam.aktif');

    // Tambah manual
    Route::get('/peminjaman/create', [\App\Http\Controllers\Admin\PeminjamController::class, 'create'])
        ->name('peminjam.create');
    Route::post('/peminjaman', [\App\Http\Controllers\Admin\PeminjamController::class, 'store'])
        ->name('peminjam.store');

    // Edit & update
    Route::get('/peminjaman/{id}/edit', [\App\Http\Controllers\Admin\PeminjamController::class, 'edit'])
        ->name('peminjam.edit');
    Route::put('/peminjaman/{id}', [\App\Http\Controllers\Admin\PeminjamController::class, 'update'])
        ->name('peminjam.update');

    // Delete
    Route::delete('/peminjaman/{id}', [\App\Http\Controllers\Admin\PeminjamController::class, 'destroy'])
        ->name('peminjam.destroy');

    // Approve permohonan
    Route::post('/peminjaman/{id}/approve', [\App\Http\Controllers\Admin\PeminjamController::class, 'approve'])
        ->name('peminjam.approve');

    // Tolak permohonan
    Route::post('/peminjaman/{id}/tolak', [\App\Http\Controllers\Admin\PeminjamController::class, 'tolak'])
        ->name('peminjam.tolak');

    // Tandai dikembalikan
    Route::post('/peminjaman/{id}/kembali', [\App\Http\Controllers\Admin\PeminjamController::class, 'kembali'])
        ->name('peminjam.kembali');

    // Pengembalian (riwayat kembali)
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

    // Form pinjam
    Route::get('/pinjam/{id}', [PeminjamController::class, 'create'])
        ->name('user.pinjam');

    // Simpan permohonan
    Route::post('/pinjam', [PeminjamController::class, 'store'])
        ->name('user.pinjam.store');

    // Riwayat peminjaman user
    Route::get('/peminjaman', [PeminjamController::class, 'index'])
        ->name('user.peminjaman');

    // Kembalikan alat
    Route::post('/kembali/{id}', [PeminjamController::class, 'kembali'])
        ->name('user.kembali');
});