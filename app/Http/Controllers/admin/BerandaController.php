<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $data =array(
            'title' => 'beranda',
            'menuDashboard' => 'active'
        );
        return view('admin.pages.beranda.index', $data);
    }
}