<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;

use Closure;

class DosenMiddleware
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
        if ($request->dosen <> 'dosen' ) {
            return redirect('/api/auth');
        } else {
            return $next($request);
        }
    }
}
