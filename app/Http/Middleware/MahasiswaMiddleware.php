<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MahasiswaMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('mahasiswa')->check()) {
            abort(403, 'Hanya untuk Mahasiswa.');
        }

        $timeout = 20000;
        if ($request->session()->has('login_time')) {
            $lastLogin = strtotime($request->session()->get('login_time'));
            if ((time() - $lastLogin) > $timeout) {
                Auth::guard('mahasiswa')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login')->with('error', 'Sesi Anda telah habis, silakan login kembali.');
            }
        }

        return $next($request);
    }
}
