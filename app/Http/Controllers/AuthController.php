<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ClientModel;
//use model user

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('user');
        // $this->middleware('user', ['only' => 'register', 'login']);
    }
    
    //buat token untuk klien
    public function loginAuth(Request $request){

        $email = $request->input('email');
        $password = $request->input('password'); 
        
        // $data = DB::table('ws_sys_klien')->where('email', $email)->first();
        $klien = ClientModel::where('email', $email)->first();//objek
        
        if (Hash::check($password, $klien->password)) {
            //create api-token
            $apiToken = base64_encode(Str::random(60));
            
            $klien->update([
                'token' => $apiToken,
           ]);
           return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                    'data' => [
                         'client' => $klien,
                        ]
                ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'login gagal',
                    'data' => [
                        'client' => null,
                        'api-token' => ''
                        ]
                ], 404);
        }
    }

    // public function register(Request $request)
    // {
    //     $kode = $request->input('kode');
    //     $email = $request->input('email');
    //     $password = Hash::make($request->input('password'));
    //     $pin = $request->input('pin');
        
    //     $register = ClientModel::create([
    //         'kode' => $kode,
    //         'email' => $email,
    //         'password' => $password,
    //         'pin' => $pin
    //     ]);

    //     if ($register) {
    //         return response()->json([
    //             'success' => true,
    //             'pesan' => 'register berhasil',
    //             'data' => $register
    //         ], 201);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'pesan' => 'register gagal',
    //             'data' => ''
    //         ], 201);
    //     }       
    // }
}
