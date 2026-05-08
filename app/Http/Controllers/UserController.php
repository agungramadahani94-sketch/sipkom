<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); 

        return view('admin.pages.user.index', compact('users'));
    }
}