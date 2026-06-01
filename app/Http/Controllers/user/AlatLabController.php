<?php

namespace App\Http\Controllers\User; // harus User, bukan Admin

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AlatLab;

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
            ->get();

        return view('user.pages.alatlab.index', compact('alat', 'search'));
    }
}