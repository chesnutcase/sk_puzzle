<?php

namespace App\Http\Middleware;

use Closure;

class GameAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->get('loggedInAs') == 'SK' || $request->session()->get('loggedInAs') == 'admin') {
            return $next($request);
        } else {
            return redirect('/')->with('error', 'You are not authenticated, please login again');
        }
    }
}
