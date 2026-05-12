<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AlatLab;

class AlatLabController extends Controller
{
    public function index()
    {
        $alat = AlatLab::latest()->get();

        return view('user.pages.alatlab.index', compact('alat'));
    }
}