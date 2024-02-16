<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect('/feed');
        //     }
        // }
        // return $next($request);

        // if (Auth::check()) {
        //     return $next($request);
        // }

        // return redirect('/login'); // Sesuaikan dengan path halaman login Anda

        // Jika pengguna sudah login, redirect dari rute login
        if (Auth::check() && $request->routeIs('login')) {
            return redirect('/feed'); // Sesuaikan dengan path halaman setelah login
        }

        // Jika pengguna belum login, redirect dari rute logout
        if (!Auth::check() && $request->routeIs('logout')) {
            return redirect('/login'); // Sesuaikan dengan path halaman login
        }

        return $next($request);
    }
}
