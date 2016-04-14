<?php

namespace App\Http\Middleware;

use Closure;

class CanAccessMiddleware
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
        if (!($request->user()->isAdmin || $request->user()->isModerator || $request->user()->canAccess))
        {
            return redirect('/');
        }
        return $next($request);
    }
}
