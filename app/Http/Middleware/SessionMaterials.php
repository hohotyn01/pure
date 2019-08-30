<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class SessionMaterials
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
        if(!(session::has('idMaterialsFloor'))){
            return redirect(route('materials'));
        }

        return $next($request);
    }
}
