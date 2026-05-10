<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;
use App\Models\AlatLab;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // ✅ RIWAYAT PEMINJAMAN USER
    public function index()
    {
        $data = Peminjam::with('alat')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.pages.peminjam.index', compact('data'));
    }

    // ✅ PROSES PINJAM
    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alat_labs,id_alat'
        ]);

        $alat = AlatLab::where('id_alat', $request->alat_id)->firstOrFail();

        // ❌ kalau stok habis
        if ($alat->stok <= 0) {
            return back()->with('error', 'Stok alat habis!');
        }

        // ❌ cegah pinjam double
        $cek = Peminjam::where('user_id', auth()->id())
            ->where('alat_id', $alat->id_alat)
            ->where('status', 'dipinjam')
            ->exists();

        if ($cek) {
            return back()->with('error', 'Kamu masih meminjam alat ini!');
        }

        // ✅ simpan
        Peminjam::create([
            'user_id' => auth()->id(),
            'alat_id' => $alat->id_alat,
            'tanggal_pinjam' => now(),
            'status' => 'dipinjam'
        ]);

        // ✅ kurangi stok
        $alat->decrement('stok');

        return back()->with('success', 'Berhasil meminjam alat');
    }

    // ✅ KEMBALIKAN (USER)
    public function kembali($id)
    {
        $peminjam = Peminjam::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        // ❌ kalau sudah dikembalikan
        if ($peminjam->status == 'dikembalikan') {
            return back()->with('error', 'Sudah dikembalikan!');
        }

        // ✅ update status
        $peminjam->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()
        ]);

        // ✅ tambah stok kembali
        $peminjam->alat->increment('stok');

        return back()->with('success', 'Berhasil mengembalikan alat');
    }
}