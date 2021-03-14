<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct()
    {
        // $this->middleware('user');
        // $this->middleware('user', ['only' => 'register', 'login']);
        // if ($this->session()->has('users')) {
        //     echo 'ini index beranda';
        // }
        // if (!$this->session->userdata('nama')) {
        //     return redirect('user/login2');
        // }

    }

    public function setUser(Request $request){
        return response()->json([
            'session.name' => $request->session()->get('name'),
            'session.token' => $request->session()->get('token'),
        ]);
    }

    public function logout(Request $request){       
        $user = $request->session()->get('name');
        $token = $request->session()->get('token');

        $user = User::where('nama', $user)->first();

        if ($user) {
            $user->update([
                'akses_terakhir' => null,
                 'data' =>[
                    'session.name' => $request->session()->forget('name'),
                    'session.token' => $request->session()->forget('token')
                ]
            ]);
            return response()->json([
                'success' => true,
                'message' => 'keluar',
                'session.name' => $request->session()->get('name'),
                'session.token' => $request->session()->get('token'),
                ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'belum login',
                    'data' => ''
                ], 200);
        }
        
        
        // $request->session->forget('token');
        
    }


    public function login(){
        echo 'anda harus  login';
    }
    public function index(Request $request){
        echo 'ini beranda';
        // return response()->json([
        //     'session.name' => $request->session()->get('name'),
        //     'session.token' => $request->session()->get('token'),
        // ]);
    }

    
}
