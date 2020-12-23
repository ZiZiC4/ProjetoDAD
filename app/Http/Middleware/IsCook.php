<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsCook
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
        if ($request->user() && $request->user()->type === "EC") {
            return $next($request);
        }
        throw new AccessDeniedHttpException('Unauthorized.');
    }
}