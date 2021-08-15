<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\ClientModel;
use App\Models\Pengguna\UserOtorisasi;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Factory as Auth;
class CekUserMiddleware 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $auth;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    public function handle($request, Closure $next, $guard = null)
    {
        //middleware->user
        //cek token klien
        if ($this->auth->guard($guard)->guest()) {
            return response()->json([
                'status' => false,
                'message' => 'Request User Di Tolak!',
                'Token' => 'Token tidak Valid',
                'mididleware'=> 'cekLogin'
                ], 401);
        } else {

            $userKode = $request->header('username');

            $user = User::where('kode', $userKode)->first();
            
            if($user) {
                $logUser = UserOtorisasi::where('kode_pengguna', 'LIKE', '%'. $user->kode .'%')->first();
                $waktu = Carbon::now();
        
                if ($logUser) {
                    //jika valid
                    $user->update([
                        'akses_terakhir' => $waktu
                    ]);
                    return $next($request);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Request User Di Tolak!',
                        'status' => 'user belum login', 
                    ], 403);
                }
                
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Request User Di Tolak!',
                    'status' => 'username tidak valid',    
                    ], 403);
            }          
        }
    }
}
