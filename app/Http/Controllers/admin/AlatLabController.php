<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AlatLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatLabController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $alat = AlatLab::when($search, function ($query, $search) {
            return $query->where('nama_alat', 'like', '%' . $search . '%')
            ->orWhere('kategori', 'like', '%' . $search . '%');
        })
        ->latest()
        ->paginate(10);

        return view('admin.pages.alatlab.index', compact('alat', 'search'));
    }

    public function create()
    {
        return view('admin.pages.alatlab.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'kondisi' => 'required|in:baik,rusak,diperbaiki',
            'stok' => 'required|integer|min:0',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload gambar
        $gambarPath = $request->file('gambar')->store('alat', 'public');

        //Saat admin mengisi form tambah alat lalu menekan tombol simpan, data dikirim ke controller dan disimpan ke database
        AlatLab::create([
            'nama_alat' => $request->nama_alat,
            'kategori' => $request->kategori,
            'kondisi' => $request->kondisi,
            'stok' => $request->stok,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('alatlab.index')
            ->with('success', 'Data alat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $alat = AlatLab::findOrFail($id);
        return view('admin.pages.alatlab.edit', compact('alat'));
    }

    public function update(Request $request, $id)
    {
        $alat = AlatLab::findOrFail($id);

        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'kondisi' => 'required|in:baik,rusak,diperbaiki',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nama_alat',
            'kategori',
            'kondisi',
            'stok'
        ]);

        if ($request->hasFile('gambar')) {

            // hapus gambar lama
            if ($alat->gambar && Storage::disk('public')->exists($alat->gambar)) {
                Storage::disk('public')->delete($alat->gambar);
            }

            // upload baru
            $data['gambar'] = $request->file('gambar')->store('alat', 'public'); //Gambar diupload oleh admin dan disimpan ke folder storage/app/public/alat
        }

        $alat->update($data); //Admin dapat mengubah informasi alat seperti nama, kategori, kondisi, atau stok

        return redirect()->route('alatlab.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $alat = AlatLab::findOrFail($id);

        // hapus gambar
        if ($alat->gambar && Storage::disk('public')->exists($alat->gambar)) {
            Storage::disk('public')->delete($alat->gambar);
        }

        $alat->delete(); //Jika alat sudah tidak digunakan, admin dapat menghapus data dari database

        return redirect()->route('alatlab.index')
            ->with('success', 'Data berhasil dihapus');
    }
}