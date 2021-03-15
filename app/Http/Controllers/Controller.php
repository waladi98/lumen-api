<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        //$this->middleware('cekLogin');

    }
    public function cek()
    {
        echo 'session ada !';
    }
    public function setUser(Request $request){
        return response()->json([
            'success' => true,
            'session.name' => $request->session()->get('name'),
            'session.token' => $request->session()->get('token'),
            ], 200);
        // return response()->json([
        //     'session.name' => $request->session()->get('name'),
        //     'session.token' => $request->session()->get('token'),
        // ]);
        // if ($request->session()->get('name') == null && $request->session()->get('token') == null) {
        //     return response()->json([
        //         'session.name' => $request->session()->get('name'),
        //         'session.token' => $request->session()->get('token'),
        //     ]);
        // }
        //  else {
        //     return response()->json([
        //         'session.name' => $request->session()->get('name'),
        //         'session.token' => $request->session()->get('token'),
        //     ]);
        // }
        
    }

    


    public function login(){
        echo 'anda harus  login';
    }
    // public function index(Request $request){
    //     echo 'ini beranda';
    //     // return response()->json([
    //     //     'session.name' => $request->session()->get('name'),
    //     //     'session.token' => $request->session()->get('token'),
    //     // ]);
    // }

    
}
