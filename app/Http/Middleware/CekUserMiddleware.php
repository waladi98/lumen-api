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
            return response()->json([
                'status' => false,
                'message' => 'Request User Di Tolak!'
                ], 401);
        } else {
            return $next($request);
        }
       
    }
}
