<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminDosenMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('dosen')->user();

        if (!$user || $user->role !== 'admin') {
            abort(403, 'Akses hanya untuk dosen admin.');
        }

        return $next($request);
    }
}

