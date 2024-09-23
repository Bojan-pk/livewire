<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            // Ako korisnik nije ulogovan, preusmeri ga na login
            return redirect('/login');
        }

        // Proveri da li korisnik ima potrebnu ulogu
        if (!in_array(Auth::user()->role, $roles)) {
            // Ako korisnik nema odgovarajuću ulogu, preusmeri ga
            return redirect('/ves')->with('error','Нисто овлашћени за приступ');  // Ili 403 stranica, zavisi od tvog dizajna
        }

        return $next($request);
    }
}
