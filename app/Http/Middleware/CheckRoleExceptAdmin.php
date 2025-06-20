<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleExceptAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Kalau belum login (guest), biarkan akses
        if (!$user) {
            return $next($request);
        }

        $role = $user->role;

        // Kalau admin dan akses /news atau /detail/{id}, tolak akses
        if ($role === 'admin' && ($request->is('news') || $request->is('detail/*'))) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
