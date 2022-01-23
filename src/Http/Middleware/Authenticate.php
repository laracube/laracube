<?php

namespace Laracube\Laracube\Http\Middleware;

use Illuminate\Http\Request;
use Laracube\Laracube\Laracube;

class Authenticate
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        return Laracube::check($request) ? $next($request) : abort(403);
    }
}
