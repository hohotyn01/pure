<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class SessionUserId
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
        if(!empty(Session::get('userId'))){
            return redirect('home');
        }

        return $next($request);
    }
}
