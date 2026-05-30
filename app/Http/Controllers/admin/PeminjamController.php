<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;
use App\Models\User;
use App\Models\AlatLab;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    // ========================================================
    // INDEX — Menunggu Approval
    // ========================================================
    public function index()
    {
        $peminjams = Peminjam::with(['user', 'alat'])
            ->where('status', 'menunggu')
            ->latest()
            ->paginate(10);

        return view('admin.pages.peminjam.index', compact('peminjams'));
    }

    // ========================================================
    // AKTIF — Sudah Disetujui / Dipinjam
    // ========================================================
    public function aktif()
    {
        $peminjams = Peminjam::with(['user', 'alat'])
            ->where('status', 'dipinjam')
            ->latest()
            ->paginate(10);

        return view('admin.pages.peminjam.aktif', compact('peminjams'));
    }

    // ========================================================
    // CREATE & STORE — Admin tambah manual (langsung dipinjam)
    // ========================================================
    public function create()
    {
        $users = User::where('role', 'user')->get();
        $alats = AlatLab::where('stok', '>', 0)->get();
        return view('admin.pages.peminjam.create', compact('users', 'alats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user'          => 'required|exists:users,id_user',
            'id_alat'          => 'required|exists:alatlabs,id_alat',
            'tgl_pinjam'       => 'required|date',
            'tgl_pengembalian' => 'required|date|after_or_equal:tgl_pinjam',
        ]);

        $alat = AlatLab::findOrFail($request->id_alat);

        if ($alat->stok <= 0) {
            return back()->with('error', 'Stok alat habis!');
        }

        Peminjam::create([
            'id_user'          => $request->id_user,
            'id_alat'          => $request->id_alat,
            'tgl_pinjam'       => $request->tgl_pinjam,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'status'           => 'dipinjam',
        ]);

        $alat->decrement('stok');

        return redirect()->route('peminjam.index')->with('success', 'Data peminjaman berhasil ditambahkan!');
    }

    // ========================================================
    // EDIT & UPDATE
    // ========================================================
    public function edit($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $users    = User::where('role', 'user')->get();
        $alats    = AlatLab::all();
        return view('admin.pages.peminjam.edit', compact('peminjam', 'users', 'alats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user'          => 'required|exists:users,id_user',
            'id_alat'          => 'required|exists:alatlabs,id_alat',
            'tgl_pinjam'       => 'required|date',
            'tgl_pengembalian' => 'required|date|after_or_equal:tgl_pinjam',
        ]);

        $peminjam = Peminjam::findOrFail($id);

        // Jika alat diganti dan status sudah dipinjam → kembalikan stok lama & kurangi stok baru
        if ($peminjam->id_alat != $request->id_alat && $peminjam->status === 'dipinjam') {
            $alatLama = AlatLab::find($peminjam->id_alat);
            if ($alatLama) $alatLama->increment('stok');

            $alatBaru = AlatLab::findOrFail($request->id_alat);
            if ($alatBaru->stok <= 0) {
                return back()->with('error', 'Stok alat baru habis!');
            }
            $alatBaru->decrement('stok');
        }

        $peminjam->update([
            'id_user'          => $request->id_user,
            'id_alat'          => $request->id_alat,
            'tgl_pinjam'       => $request->tgl_pinjam,
            'tgl_pengembalian' => $request->tgl_pengembalian,
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Data berhasil diupdate!');
    }

    // ========================================================
    // DESTROY
    // ========================================================
    public function destroy($id)
    {
        $peminjam = Peminjam::findOrFail($id);

        // Kembalikan stok hanya jika statusnya dipinjam
        if ($peminjam->status === 'dipinjam') {
            $alat = AlatLab::find($peminjam->id_alat);
            if ($alat) $alat->increment('stok');
        }

        $peminjam->delete();

        return redirect()->route('peminjam.index')->with('success', 'Data berhasil dihapus!');
    }

    // ========================================================
    // APPROVE — Setujui permohonan, stok baru dikurangi
    // ========================================================
    public function approve($id)
    {
        $peminjam = Peminjam::findOrFail($id);

        if ($peminjam->status !== 'menunggu') {
            return back()->with('error', 'Hanya permohonan berstatus menunggu yang bisa disetujui!');
        }

        $alat = AlatLab::findOrFail($peminjam->id_alat);

        if ($alat->stok <= 0) {
            return back()->with('error', 'Stok alat sudah habis, tidak bisa disetujui!');
        }

        $peminjam->update([
            'status'        => 'dipinjam',
            'catatan_admin' => 'Disetujui oleh admin.',
        ]);

        $alat->decrement('stok');

        return back()->with('success', 'Peminjaman berhasil disetujui!');
    }

    // ========================================================
    // TOLAK — Tolak permohonan
    // ========================================================
    public function tolak(Request $request, $id)
    {
        $peminjam = Peminjam::findOrFail($id);

        if ($peminjam->status !== 'menunggu') {
            return back()->with('error', 'Hanya permohonan berstatus menunggu yang bisa ditolak!');
        }

        $peminjam->update([
            'status'        => 'ditolak',
            'catatan_admin' => $request->catatan ?? 'Ditolak oleh admin.',
        ]);

        return back()->with('success', 'Peminjaman berhasil ditolak.');
    }

    // ========================================================
    // KEMBALI — Tandai alat sudah dikembalikan
    // ========================================================
    public function kembali($id)
    {
        $peminjam = Peminjam::findOrFail($id);

        if ($peminjam->status !== 'dipinjam') {
            return back()->with('error', 'Hanya peminjaman aktif yang bisa ditandai dikembalikan!');
        }

        $peminjam->update([
            'status'           => 'kembali',
            'tgl_pengembalian' => now()->toDateString(),
        ]);

        $alat = AlatLab::find($peminjam->id_alat);
        if ($alat) $alat->increment('stok');

        return back()->with('success', 'Alat berhasil ditandai dikembalikan!');
    }

    // ========================================================
    // PENGEMBALIAN — Riwayat yang sudah dikembalikan
    // ========================================================
    public function pengembalian()
    {
        $pengembalian = Peminjam::with(['user', 'alat'])
            ->where('status', 'kembali')
            ->latest()
            ->paginate(10);

        return view('admin.pages.pengembalian.index', compact('pengembalian'));
    }
}