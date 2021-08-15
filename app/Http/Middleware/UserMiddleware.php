<?php

namespace App\Http\Middleware;


use App\Models\User;
use App\Models\Pengguna\UserOtorisasi;
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
        //middleware->user
        //cek token klien
        if ($this->auth->guard($guard)->guest()) {
            return response()->json([
                'status' => false,
                'message' => 'Request User Di Tolak!',
                'Token' => 'Token tidak Valid'
                ], 401);
        } else {
            //jika token valid
            $nama = $request->input('nama');
            $sandi = $request->input('sandi');
        
            // $klien = ClientModel::where('token', $token)->first();
            $user = User::where('nama', $nama)->first();
        
            if ($user) {
                if ($user->sandi == $sandi) {
                    //simpan kode-penguna pengguna yang login
                    $data = $user->nama;
                    $request->session()->put('name', $data);
                    //update waktu akses terakhir
                    $user->update([
                        'akses_terakhir' => Carbon::now()
                    ]);
                    //lanjutkan request
                    return $next($request);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'kata sandi pengguna salah'
                        ], 401);
                }
            } else {
                
                return response()->json([
                    'status' => false,
                    'message' => 'Akun Pengguna tidak ditemukan pada Aplikasi'
                    ], 401);
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
