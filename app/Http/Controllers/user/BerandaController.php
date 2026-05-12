<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;

class BerandaController extends Controller
{
    public function index()
    {
        $totalDipinjam = Peminjam::where('id_user', auth()->id())
            ->where('status', 'dipinjam')
            ->count();

        $totalKembali = Peminjam::where('id_user', auth()->id())
            ->where('status', 'kembali')
            ->count();

        return view('user.pages.beranda.index', compact('totalDipinjam', 'totalKembali'));
    }
}