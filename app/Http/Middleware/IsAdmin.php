<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
// Pastikan user login
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // Log email user yang terautentikasi
        Log::info('IsAdmin middleware dipanggil oleh: ' . Auth::user()->email);

        // Cek role user
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized - Hanya admin yang bisa mengakses halaman ini.');
        }

        return $next($request);

        
    }
}


