<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class LogController extends SITUController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    public function index2(Request $request)
    {
        return response()->json([
            'success' => false,
            'message' => 'user belum login',
            'session.name' => $request->session()->get('name'),
            'session.token' => $request->session()->get('token'),
            ], 200);
    }

    public function beranda(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'menu umum',
            'session.name' => $request->session()->get('name'),
            'session.token' => $request->session()->get('token'),
            ], 200);
    }
}
