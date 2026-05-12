<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    // Tampilkan data pengembalian
    public function index()
    {
        $pengembalian = Pengembalian::with('peminjaman.user', 'peminjaman.alatlab')
            ->latest()
            ->get();

        return view('admin.pages.pengembalian.index', compact('pengembalian'));
    }

    // Simpan pengembalian baru
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamen,id',
            'tanggal_kembali' => 'required|date',
            'kondisi' => 'required',
        ]);

        // simpan data pengembalian
        Pengembalian::create([
            'peminjaman_id' => $request->peminjaman_id,
            'tanggal_kembali' => $request->tanggal_kembali,
            'kondisi' => $request->kondisi,
        ]);

        // update status peminjaman jadi dikembalikan
        $peminjaman = Peminjaman::find($request->peminjaman_id);
        $peminjaman->status = 'dikembalikan';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Barang berhasil dikembalikan');
    }

    // Detail pengembalian
    public function show($id)
    {
        $pengembalian = Pengembalian::with('peminjaman.alatlab', 'peminjaman.user')
            ->findOrFail($id);

        return view('admin.pengembalian.show', compact('pengembalian'));
    }

    // Hapus data pengembalian (opsional)
    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();

        return redirect()->back()->with('success', 'Data pengembalian dihapus');
    }
}