<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AlatLab;
use App\Models\Peminjam;

class BerandaController extends Controller
{
    public function index()
    {
        $totalUser        = User::where('role', 'user')->count();
        $totalAlat        = AlatLab::count();
        $totalPeminjaman  = Peminjam::count();
        $totalPengembalian = Peminjam::where('status', 'kembali')->count();

        return view('admin.pages.beranda.index', compact(
            'totalUser',
            'totalAlat',
            'totalPeminjaman',
            'totalPengembalian'
        ));
    }
}