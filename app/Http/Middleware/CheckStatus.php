<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckStatus
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
        if(!in_array("C", session("status")) && $request->url() === route("administration.create"))
            return redirect()->route("administration.index");

        if(!in_array("U", session("status")) 
            && $request->url() === route("administration.show", ["id" => $request->id ?? 0]))
            return redirect()->route("administration.change");

        return $next($request);
    }
}
