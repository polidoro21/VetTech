<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('usuario') || session('usuario')['tipo'] !== 'admin') {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
