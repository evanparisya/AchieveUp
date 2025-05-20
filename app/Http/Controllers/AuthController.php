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
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        if (
            Auth::guard('mahasiswa')->attempt(['NIM' => $username, 'password' => $password]) ||
            Auth::guard('mahasiswa')->attempt(['username' => $username, 'password' => $password])
        ) {
            $request->session()->regenerate();
            return redirect()->route('mahasiswa.dashboard.index')
                ->with('success', 'Selamat datang, Mahasiswa!');
        }

        if (
            Auth::guard('dosen')->attempt(['NIDN' => $username, 'password' => $password]) ||
            Auth::guard('dosen')->attempt(['username' => $username, 'password' => $password])
        ) {
            $request->session()->regenerate();
            $user = Auth::guard('dosen')->user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard.index')
                    ->with('success', 'Selamat datang, Admin!');
            } elseif (in_array($user->role, ['dosen', 'dosen pembimbing'])) {
                return redirect()->route('dosen.dashboard.index')
                    ->with('success', 'Selamat datang, Dosen!');
            } else {
                Auth::guard('dosen')->logout();
                return back()->with('error', 'Role dosen tidak valid.');
            }
        }

        return back()->with('error', 'Username atau password tidak cocok.');
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
