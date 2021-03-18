<?php

namespace App\Http\Controllers;

class LoginController extends SITUController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // public function index()
    // {
    //     return response()->json("Akses Auth COntroller!!");
    // }
    // public function register()
    // {
    //     return  response()->json("ini method register");
    // }

    // public function login(Request $request)
    // {
    //     $username = $request->input('username');
    //     $password = $request->input('password');

    //     $user = DB::select("Call cp_cek_login('$username','$password')");

    //     if (is_array($user)) {
    //         $user = $user[0];
            
    //         if ($user->result == "Kode Pengguna tidak ditemukan") {                   
                
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Kode Pengguna tidak ditemukan'
    //             ], 404);

    //         } elseif ($user->result == "OK") {
    //             //create api-token
    //             $apiToken = base64_encode(Str::random(40));
                
    //             //update api token di DB
    //             // $user->update([
    //             //     'api_token' => $token
    //             // ]);

    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Login Berhasil',
    //                 'data' => [
    //                     'user' => $user,
    //                     'api-token' => $apiToken
    //                 ]
    //                 ], 200);
    //         } else {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Kata kunci Salah',
    //                 'data' => ''
    //             ], 400);
    //         }
    //     }
    // }
}
