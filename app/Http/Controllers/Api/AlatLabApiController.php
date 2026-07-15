<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AlatLabResource;
use App\Models\AlatLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatLabApiController extends Controller
{
    // GET /api/alat?search=mouse
    public function index(Request $request)
    {
        $alat = AlatLab::when($request->search, function ($q) use ($request) {
                $q->where('nama_alat', 'like', "%{$request->search}%")
                  ->orWhere('kategori', 'like', "%{$request->search}%");
            })
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => AlatLabResource::collection($alat),
            'meta' => [
                'current_page' => $alat->currentPage(),
                'last_page'    => $alat->lastPage(),
                'total'        => $alat->total(),
            ],
        ], 200);
    }

    // POST /api/alat
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori'  => 'required|string|max:255',
            'kondisi'   => 'required|in:baik,rusak,diperbaiki',
            'stok'      => 'required|integer|min:0',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        $alat = AlatLab::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Alat berhasil ditambahkan',
            'data'    => new AlatLabResource($alat),
        ], 201);
    }

    // GET /api/alat/{id}
    public function show($id)
    {
        $alat = AlatLab::find($id);

        if (!$alat) {
            return response()->json(['success' => false, 'message' => 'Alat tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => new AlatLabResource($alat)], 200);
    }

    // PUT/PATCH /api/alat/{id}
    public function update(Request $request, $id)
    {
        $alat = AlatLab::find($id);

        if (!$alat) {
            return response()->json(['success' => false, 'message' => 'Alat tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama_alat' => 'sometimes|required|string|max:255',
            'kategori'  => 'sometimes|required|string|max:255',
            'kondisi'   => 'sometimes|required|in:baik,rusak,diperbaiki',
            'stok'      => 'sometimes|required|integer|min:0',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($alat->gambar && Storage::disk('public')->exists($alat->gambar)) {
                Storage::disk('public')->delete($alat->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        $alat->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Alat berhasil diupdate',
            'data'    => new AlatLabResource($alat),
        ], 200);
    }

    // DELETE /api/alat/{id}
    public function destroy($id)
    {
        $alat = AlatLab::find($id);

        if (!$alat) {
            return response()->json(['success' => false, 'message' => 'Alat tidak ditemukan'], 404);
        }

        if ($alat->gambar && Storage::disk('public')->exists($alat->gambar)) {
            Storage::disk('public')->delete($alat->gambar);
        }

        $alat->delete();

        return response()->json(['success' => true, 'message' => 'Alat berhasil dihapus'], 200);
    }
}