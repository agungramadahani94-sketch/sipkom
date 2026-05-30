<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;
use App\Models\AlatLab;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    // ========================================================
    // FORM PINJAM
    // ========================================================
    public function create($id)
    {
        $alat = AlatLab::findOrFail($id);
        return view('user.pages.alatlab.create', compact('alat'));
    }

    // ========================================================
    // RIWAYAT PEMINJAMAN USER
    // ========================================================
    public function index()
    {
        $data = Peminjam::with('alat')
            ->where('id_user', auth()->id())
            ->latest()
            ->get();

        return view('user.pages.peminjam.index', compact('data'));
    }

    // ========================================================
    // SIMPAN PINJAM — Status menunggu, stok BELUM dikurangi
    // ========================================================
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
            return back()->with('error', 'Stok alat habis, tidak bisa dipinjam!');
        }

        // Cegah pinjam double (masih menunggu atau sedang dipinjam)
        $cek = Peminjam::where('id_user', auth()->id())
            ->where('id_alat', $alat->id_alat)
            ->whereIn('status', ['menunggu', 'dipinjam'])
            ->exists();

        if ($cek) {
            return back()->with('error', 'Kamu masih meminjam atau menunggu persetujuan untuk alat ini!');
        }

        // Simpan dengan status menunggu, stok belum dikurangi
        Peminjam::create([
            'id_user'          => auth()->id(),
            'id_alat'          => $alat->id_alat,
            'tgl_pinjam'       => $request->tanggal_pinjam,
            'tgl_pengembalian' => $request->tanggal_kembali,
            'status'           => 'menunggu',
        ]);

        return redirect()->route('user.peminjaman')
            ->with('success', 'Permohonan peminjaman berhasil dikirim! Silakan tunggu persetujuan admin.');
    }

    // ========================================================
    // KEMBALI — User kembalikan alat sendiri
    // ========================================================
    public function kembali($id)
    {
        $peminjam = Peminjam::where('id_user', auth()->id())
            ->where('id_peminjam', $id)
            ->firstOrFail();

        if ($peminjam->status !== 'dipinjam') {
            return back()->with('error', 'Hanya alat yang sedang dipinjam yang bisa dikembalikan!');
        }

        $peminjam->update([
            'status'           => 'kembali',
            'tgl_pengembalian' => now()->toDateString(),
        ]);

        $alat = AlatLab::find($peminjam->id_alat);
        if ($alat) $alat->increment('stok');

        return back()->with('success', 'Alat berhasil dikembalikan!');
    }
}