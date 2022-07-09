<?php

namespace App\Http\Middleware;

use App\Events\ReviewEvent;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        event(new ReviewEvent());

        if(! (Auth::check() && Auth::user()->isAdmin()))
        {
            abort(404);
        }
        return $next($request);
    }
}
