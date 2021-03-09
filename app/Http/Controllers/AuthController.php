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

    public function login(Request $request){

        $email = $request->input('email');
        $password = $request->input('password'); 
        
        // $data = DB::table('ws_sys_klien')->where('email', $email)->first();
        $data = ClientModel::where('email', $email)->first();
        
        if ($data->password === $password) {
            //create api-token
            $apiToken = base64_encode(Str::random(60));
            
            $data->update([
                'token' => $apiToken,
                
           ]);
           return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                    'data' => [
                         'user' => $data,
                        ]
                ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'login gagal',
                    'data' => [
                        'user' => null,
                        'api-token' => ''
                        ]
                ], 200);
        }
    }
}
