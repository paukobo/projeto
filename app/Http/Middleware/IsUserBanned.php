<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsUserBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->bloqueado != null) {

            if (auth()->user()->bloqueado == 1) {
                $message = 'A sua conta foi bloqueada. Contacte um administrador.';
            }

            auth()->logout();
            return redirect()->route('login')->with('message', $message);
        }

        return $next($request);
    }
}
