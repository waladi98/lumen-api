<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;

use Closure;

class UserMiddleware
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
        if ($request->user <> 'mahasiswa' ) {
            return redirect('/api/auth');
        } else {
            return $next($request);
        }
    }
}
