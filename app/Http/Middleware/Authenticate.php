<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Models\User;
use Carbon\Carbon;
class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //middleware->auth
        if ($this->auth->guard($guard)->guest()) {
            return response()->json([
                'status' => false,
                'message' => 'Request Klien Di Tolak!',
                'Token' => 'Token tidak Valid'
                ], 401);
        } else {
            $waktu = Carbon::now();
            $data = [
                'akses_terakhir' => $waktu,
            ]; 
            $user = $request->session()->get('name');
            //jika valid
            $data = User::where('nama', $user)->update($data);
            return $next($request);
        }
        
    }
}
