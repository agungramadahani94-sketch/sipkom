<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    // ================= LOGIN =================
    public function login()
    {
        return view('auth.login');
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.min'      => 'Password minimal 6 karakter',
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('beranda')
                    ->with('success', 'Login Admin berhasil');
            }

            if (Auth::user()->role === 'user') {
                return redirect()->route('user.dashboard')
                    ->with('success', 'Login berhasil');
            }

            Auth::logout();
            return redirect('/login')->with('error', 'Role tidak valid');
        }

        return redirect()->back()->with('error', 'Email atau Password salah');
    }

    // ================= REGISTER =================
    public function register()
    {
        return view('auth.register');
    }

    public function registerProses(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'no_tlp'   => 'required',
            'password' => 'required|min:6',
        ]);

        User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'no_tlp'   => $request->no_tlp,
            'role'     => 'user',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // ================= LOGOUT =================
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }
}