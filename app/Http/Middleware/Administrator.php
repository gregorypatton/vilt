<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has the 'administrator' role
        if (! $request->user() || ! $request->user()->hasRole('administrator')) {
            abort(403, 'You do not have the necessary role to access this resource.');
        }

        return $next($request);
    }
}
