<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        // dd($request->all());
        $credentials = $request->only('username', 'password');

        // Coba login sebagai mahasiswa
        if (Auth::guard('mahasiswa')->attempt($credentials)) {
            $request->session()->regenerate();
            // dd('login mahasiswa');
            return redirect()->intended('/mahasiswa/dashboard');
            // return redirect()->intended('/mahasiswa/dashboard');
        }

        // Coba login sebagai dosen
        if (Auth::guard('dosen')->attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::guard('dosen')->user();
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/panel');
                // dd('login admin dosen');
                // return redirect()->intended('/admin/panel');
            } elseif ($user->role === 'dosen pembimbing') {
                // dd('login dosen pembimbing');
                return redirect()->intended('/bimbingan');
                // return redirect()->intended('/bimbingan');
            } else {
                Auth::guard('dosen')->logout();
                return back()->withErrors(['login' => 'Role dosen tidak valid.']);
            }
        }

        // Jika gagal login semua
        return back()->withErrors(['login' => 'Username atau password tidak cocok.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('mahasiswa')->logout();
        Auth::guard('dosen')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
