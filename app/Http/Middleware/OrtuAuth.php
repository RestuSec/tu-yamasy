<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class OrtuAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('ortu_siswa_id')) {
            return redirect()->route('ortu.login');
        }

        return $next($request);
    }
}
