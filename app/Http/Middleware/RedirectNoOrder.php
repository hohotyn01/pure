<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class RedirectNoOrder
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
        if(!(Session::has('orderId'))){
            return redirect(route('home'));
        }

        return $next($request);
    }
}
