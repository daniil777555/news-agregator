<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class IsAuthenticate
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
        if (!session()->has("login")) {
            return redirect()->route("administration.login");
        }

        return $next($request);
    }
}
