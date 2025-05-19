<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DosenPembimbingMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('dosen')->user();

        if (!$user || $user->role !== 'dosen pembimbing') {
            abort(403, 'Akses hanya untuk dosen pembimbing.');
        }

        return $next($request);
    }
}
