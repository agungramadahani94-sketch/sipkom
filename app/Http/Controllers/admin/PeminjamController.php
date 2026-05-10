<?php

namespace App\Http\Controllers\admin;

use App\Models\Peminjam;
use App\Models\User;
use App\Models\AlatLab;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    public function index()
    {
        $peminjams = Peminjam::with(['user', 'alat'])->latest()->paginate(10);
        return view('admin.pages.peminjam.index', compact('peminjams'));
    }

    public function create()
    {
        $users = User::all();
        $alats = AlatLab::where('stok', '>', 0)->get();

        return view('admin.pages.peminjam.create', compact('users', 'alats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'id_alat' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_pengembalian' => 'required|date|after_or_equal:tgl_pinjam',
        ]);

        $alat = AlatLab::findOrFail($request->id_alat);

        if ($alat->stok <= 0) {
            return back()->with('error', 'Stok alat habis!');
        }

        Peminjam::create([
            'id_user' => $request->id_user,
            'id_alat' => $request->id_alat,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'status' => 'dipinjam' // 🔥 tambahan
        ]);

        $alat->decrement('stok');

        return redirect()->route('peminjam.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $peminjam = Peminjam::findOrFail($id);
        $users = User::all();
        $alats = AlatLab::all();

        return view('admin.pages.peminjam.edit', compact('peminjam', 'users', 'alats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required',
            'id_alat' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_pengembalian' => 'required|date|after_or_equal:tgl_pinjam',
        ]);

        $peminjam = Peminjam::findOrFail($id);

        // 🔥 kalau alat diganti → balikin stok lama & kurangi stok baru
        if ($peminjam->id_alat != $request->id_alat) {

            $alatLama = AlatLab::find($peminjam->id_alat);
            if ($alatLama) $alatLama->increment('stok');

            $alatBaru = AlatLab::findOrFail($request->id_alat);
            if ($alatBaru->stok <= 0) {
                return back()->with('error', 'Stok alat baru habis!');
            }

            $alatBaru->decrement('stok');
        }

        $peminjam->update([
            'id_user' => $request->id_user,
            'id_alat' => $request->id_alat,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_pengembalian' => $request->tgl_pengembalian,
        ]);

        return redirect()->route('peminjam.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $peminjam = Peminjam::findOrFail($id);

        $alat = AlatLab::find($peminjam->id_alat);
        if ($alat) {
            $alat->increment('stok');
        }

        $peminjam->delete();

        return redirect()->route('peminjam.index')->with('success', 'Data berhasil dihapus');
    }

    // 🔥 FITUR BARU: TANDAI KEMBALI
    public function kembali($id)
    {
        $peminjam = Peminjam::findOrFail($id);

        if ($peminjam->status == 'kembali') {
            return back()->with('error', 'Sudah dikembalikan!');
        }

        $peminjam->update([
            'status' => 'kembali'
        ]);

        // 🔥 balikin stok
        $alat = AlatLab::find($peminjam->id_alat);
        if ($alat) {
            $alat->increment('stok');
        }

        return back()->with('success', 'Alat berhasil dikembalikan');
    }

    public function pengembalian()
    {
        $peminjams = Peminjam::with(['user', 'alat'])
          
            ->latest()
            ->paginate(10);

        return view('admin.pages.pengembalian.index', compact('peminjams'));
    }
}