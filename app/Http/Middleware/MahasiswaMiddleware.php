<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MahasiswaMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('mahasiswa')->check()) {
            // return redirect()->route('mahasiswa.login'); 
            abort(403, 'Hanya untuk Mahasiswa.');
        }

        return $next($request);
    }
}
