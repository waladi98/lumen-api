<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class LogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    public function index(Request $request)
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
            'message' => 'halaman dasboard, user belum login',
            'session.name' => $request->session()->get('name'),
            'session.token' => $request->session()->get('token'),
            ], 200);
    }
}
