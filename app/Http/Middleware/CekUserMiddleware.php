<?php

namespace App\Http\Middleware;

use Closure;

class CekUserMiddleware
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
        $user = $request->session()->get('name');
        $token = $request->session()->get('token');
        
        if ($user == null && $token == null) {
            return redirect('situ/index');
        } elseif ($user == null ) {
            return redirect('situ/index');
        } else {
            return $next($request);
        }
       
    }
}
