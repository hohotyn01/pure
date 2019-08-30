<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class SessionPersonalInfo
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
        if(!(Session::has('first_name'))){
            return redirect(route('info'));
        }

        return $next($request);
    }
}
