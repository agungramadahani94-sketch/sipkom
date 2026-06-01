<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;

class BerandaController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id_user;

        $totalDipinjam = Peminjam::where('id_user', $userId)
            ->where('status', 'dipinjam')
            ->count();

        $totalKembali = Peminjam::where('id_user', $userId)
            ->where('status', 'kembali')
            ->count();

        $totalJatuhTempo = Peminjam::where('id_user', $userId)
            ->where('status', 'dipinjam')
            ->whereDate('tgl_pengembalian', '<', now()->toDateString())
            ->count();

        $totalPending = Peminjam::where('id_user', $userId)
            ->where('status', 'menunggu')
            ->count();

        $peminjamanAktif = Peminjam::with('alat')
            ->where('id_user', $userId)
            ->where('status', 'dipinjam')
            ->get();

        return view('user.pages.beranda.index', compact(
            'totalDipinjam',
            'totalKembali',
            'totalJatuhTempo',
            'totalPending',
            'peminjamanAktif'
        ));
    }
}