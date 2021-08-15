<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ClientModel;
//use model user

class AuthController extends SITUController
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
        
        //Validasi data berdasarkan request # 12
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
            //12 atribut
        ]);

        $email = $request->input('email');
        $password = $request->input('password'); 
        
        // $data = DB::table('ws_sys_klien')->where('email', $email)->first();
        $klien = ClientModel::where('email', $email)->first();//objek
        
        if ($klien) {
            if (Hash::check($password, $klien->password)) {
                //create api-token
                $apiToken = base64_encode(Str::random(60));
                
                $klien->update([
                    'token' => $apiToken,
               ]);
               return response()->json([
                    'status' => true,
                    'message' => 'Login Klien Berhasil',
                        'data' => [
                             'client' => $klien,
                            ]
                    ], 201);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'sandi Klien Salah',
                        'data' => [
                            'client' => null,
                            'api-token' => ''
                            ]
                    ], 404);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Akun Klien Tidak Tersedia!',
                    'data' => [
                        'client' => null,
                        'api-token' => ''
                        ]
                ], 404);
        }
    }

    public function register(Request $request)
    {
        //Validasi data berdasarkan request # 12
        $this->validate($request,[
            'kode' => 'required|unique:ws_sys_klien',
            'email' => 'required | email |unique:ws_sys_klien',
            'password' => 'required | ',
            'pin' => 'required | numeric',
            //12 atribut
        ]);
    
        $kode = $request->input('kode');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $pin = $request->input('pin');
        
        $register = ClientModel::create([
            'kode' => $kode,
            'email' => $email,
            'password' => $password,
            'pin' => $pin
        ]);

        if ($register) {
            return response()->json([
                'success' => true,
                'message' => 'Klien Baru Berhasil Ditambahkan',
                'data' => $register
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Klien Tidak Berhasil Ditambahkan',
                'data' => ''
            ], 401);
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
