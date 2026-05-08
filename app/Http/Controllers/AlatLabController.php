<?php

namespace App\Http\Controllers;
use App\Models\AlatLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatLabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alat = AlatLab::latest('created_at')->paginate(10);

        return view('admin.pages.alatlab.index', compact('alat'));
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

        $gambarPath = $request->file('gambar')->store('alat', 'public');

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

        $data = [
            'nama_alat' => $request->nama_alat,
            'kategori' => $request->kategori,
            'kondisi' => $request->kondisi,
            'stok' => $request->stok,
        ];

        if ($request->hasFile('gambar')) {

            // hapus gambar lama
            if ($alat->gambar && Storage::disk('public')->exists($alat->gambar)) {
                Storage::disk('public')->delete($alat->gambar);
            }

            $data['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        $alat->update($data);

        return redirect()->route('alatlab.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $alat = AlatLab::findOrFail($id);

        if ($alat->gambar && Storage::disk('public')->exists($alat->gambar)) {
            Storage::disk('public')->delete($alat->gambar);
        }

        $alat->delete();

        return redirect()->route('alatlab.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
