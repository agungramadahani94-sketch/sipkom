<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Pengembalian::with('peminjam.user', 'peminjam.alat')
            ->latest()
            ->get();

        return view('admin.pages.pengembalian.index', compact('pengembalian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjam_id'     => 'required|exists:peminjams,id_peminjam',
            'tanggal_kembali' => 'required|date',
        ]);

        Pengembalian::create([
            'peminjam_id'     => $request->peminjam_id,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status'          => 'dikembalikan',
        ]);

        $peminjaman = Peminjam::find($request->peminjam_id);
        $peminjaman->status = 'kembali';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Barang berhasil dikembalikan');
    }

    public function show($id)
    {
        $pengembalian = Pengembalian::with('peminjam.alat', 'peminjam.user')
            ->findOrFail($id);

        return view('admin.pengembalian.show', compact('pengembalian'));
    }

    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();

        return redirect()->back()->with('success', 'Data pengembalian dihapus');
    }
}