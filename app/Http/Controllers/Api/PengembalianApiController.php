<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PengembalianResource;
use App\Models\Pengembalian;

class PengembalianApiController extends Controller
{
    // GET /api/pengembalian
    public function index()
    {
        $data = Pengembalian::with('peminjam.user', 'peminjam.alat')->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => PengembalianResource::collection($data),
        ], 200);
    }

    // GET /api/pengembalian/{id}
    public function show($id)
    {
        $data = Pengembalian::with('peminjam.user', 'peminjam.alat')->find($id);

        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => new PengembalianResource($data)], 200);
    }
}