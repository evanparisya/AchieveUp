<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DosenMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::guard('dosen')->user();

        if (!$user) {
            $user = Auth::guard('admin')->user();
        }

        if (!$user || !in_array($user->role, $roles)) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin.');
        }

        $timeout = 20000;
        if ($request->session()->has('login_time')) {
            $lastLogin = strtotime($request->session()->get('login_time'));
            if ((time() - $lastLogin) > $timeout) {
                Auth::guard('dosen')->logout();
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login')->with('error', 'Sesi Anda telah habis, silakan login kembali.');
            }
        }

        return $next($request);
    }
}
