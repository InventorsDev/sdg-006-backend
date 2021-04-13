<?php

namespace App\Http\Middleware;

use Closure;

class AcceptJsonHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Accept', 'application/json');

        return $response;
    }
}
