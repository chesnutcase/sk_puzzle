<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
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
        if ($request->session()->get('loggedInAs') == 'admin') {
            return $next($request);
        } else {
            return redirect('/')->with('error', 'You are not admin-authenticated, please login again');
        }
    }
}
