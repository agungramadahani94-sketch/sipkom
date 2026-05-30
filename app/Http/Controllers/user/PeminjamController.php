<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;
use App\Models\AlatLab;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    // ✅ FORM PINJAM
    public function create($id)
    {
        $alat = AlatLab::findOrFail($id);
        return view('user.pages.alatlab.create', compact('alat'));
    }

    // ✅ RIWAYAT
    public function index()
    {
        $data = Peminjam::with('alat')
            ->where('id_user', auth()->id())
            ->latest()
            ->get();

        return view('user.pages.peminjam.index', compact('data'));
    }

    // ✅ SIMPAN PINJAM
    public function store(Request $request)
    {
        $request->validate([
            'alat_id'         => 'required|exists:alatlabs,id_alat',
            'tanggal_pinjam'  => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ], [
            'tanggal_kembali.after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.',
        ]);

        $alat = AlatLab::findOrFail($request->alat_id);

        if ($alat->stok <= 0) {
            return back()->with('error', 'Stok alat habis!');
        }

        // Cegah pinjam double
        $cek = Peminjam::where('id_user', auth()->id())
            ->where('id_alat', $alat->id_alat)
            ->where('status', 'dipinjam')
            ->exists();

        if ($cek) {
            return back()->with('error', 'Kamu masih meminjam alat ini!');
        }

        Peminjam::create([
            'id_user'          => auth()->id(),
            'id_alat'          => $alat->id_alat,
            'tgl_pinjam'       => $request->tanggal_pinjam,
            'tgl_pengembalian' => $request->tanggal_kembali,
            'status'           => 'dipinjam',
        ]);

        $alat->decrement('stok');

        return redirect()->route('user.alat')->with('success', 'Berhasil meminjam alat!');
    }

    // ✅ KEMBALI
    public function kembali($id)
    {
        $peminjam = Peminjam::where('id_user', auth()->id())
            ->where('id_peminjam', $id)
            ->firstOrFail();

        if ($peminjam->status === 'kembali') {
            return back()->with('error', 'Sudah dikembalikan!');
        }

        $peminjam->update([
            'status'           => 'kembali',
            'tgl_pengembalian' => now()->toDateString(),
        ]);

        $peminjam->alat->increment('stok');

        return back()->with('success', 'Berhasil mengembalikan alat!');
    }
}