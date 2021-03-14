<?php

namespace App\Http\Middleware;
use App\Models\ClientModel;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
class UserMiddleware
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
        if ($this->auth->guard($guard)->guest()) {
            return response('Request User Di Tolak!', 401);
        } else {
         
            $nama = $request->header('nama');
            $sandi = $request->header('sandi');
        
            // $klien = ClientModel::where('token', $token)->first();
            $user = User::where('nama', $nama)->first();
        
            if ($user ) {
                if ($user->sandi == $sandi) {
                    $data = [
                        'nama' => $user->nama,
                    ];
                    
                    $request->session()->put('name', $data);
                
                    $user->update([
                        'akses_terakhir' => Carbon::now()
                    ]);
                    return $next($request);
                    
                } else {
                    return response()->json("kata sandi salah");
                }
            } else {
                return response()->json("Kode Pengguna tidak ditemukan");
            }              
        }
    }
    // public function handle($request, Closure $next)
    // {
    //     // $token = $request->header('token');
    //     $nama = $request->header('nama');
    //     $sandi = $request->header('sandi');
        
    //     // $klien = ClientModel::where('token', $token)->first();
    //     $user = User::where('nama', $nama)->first();
        
    //     if ($user ) {
    //         if ($user->sandi == $sandi) {
    //             $user->update([
    //                 'akses_terakhir' => Carbon::now()
    //             ]);
    //             return $next($request);
                
    //         } else {
    //            return redirect('user/login2');
    //         }
    //     } else {
    //         return response()->json("user no found");
    //     }
    // }
}
