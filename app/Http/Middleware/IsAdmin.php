<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth; // Tetap gunakan Facade
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pilihan 1: Menggunakan Facade Auth (Mengatasi masalah Intelephense)
        // Perbaikan: Gunakan Auth::check() untuk Intelephense
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); 
        }

        // Pilihan 2: Menggunakan helper auth() (jika Intelephense tetap error)
        /*
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request); 
        }
        */

        // Jika tidak lolos cek, hentikan request
        abort(403, 'ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI.');
    }
}