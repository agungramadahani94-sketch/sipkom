<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjam;

class PeminjamApiController extends Controller
{
    // ✅ GET semua data
    public function index()
    {
        $data = Peminjam::all();

        return response()->json([
            'message' => 'Data peminjaman berhasil diambil',
            'data' => $data
        ], 200);
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_alat' => 'required',
            'nama_alat' => 'required',
            'jumlah' => 'required|integer',
            'tgl_pinjam' => 'required|date',
            'tgl_pengembalian' => 'required|date'
        ]);

        $data = Peminjam::create($request->all());

        return response()->json([
            'message' => 'Data berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    // ✅ GET by ID
    public function show(string $id)
    {
        $data = Peminjam::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Detail data',
            'data' => $data
        ], 200);
    }

    // ✅ PUT / UPDATE
    public function update(Request $request, string $id)
    {
        $data = Peminjam::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $data->update($request->all());

        return response()->json([
            'message' => 'Data berhasil diupdate',
            'data' => $data
        ], 200);
    }

    // ✅ DELETE
    public function destroy(string $id)
    {
        $data = Peminjam::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}