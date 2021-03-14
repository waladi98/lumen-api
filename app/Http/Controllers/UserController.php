<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
//use model user

class UserController extends Controller
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
    public function index()
    {
        echo 'ini beranda UseController';
    }

    public function UserLogin(Request $request)
    {
        $nama = $request->input('nama');
        $sandi = $request->input('sandi');

        $user = User::where('nama', $nama)->first();

        if ($user->sandi == $sandi) {
            $user->update([
                'akses_terakhir' => Carbon::now()
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                    'data' => $user
                ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'login gagal',
                    'data' => ''
                ], 200);
        }
    }

    public function getUserLogin(Request $request)
    {
        return response()->json([
            'status' => 'klien', 
            'data1' => $request->user(),
            'data2' => $request->user()
            ]);
    }
    public function logout(Request $request)
    {
        $user = User::where('nama', $nama)->first();
        $user->update(['akses_terakhir' => null]); //UPDATE VALUENYA JADI NULL
        return response()->json(['status' => 'success']);
    }


    public function getUserLogin1(Request $request)
    {
        $username = $request->header('username');
        $password = $request->header('password');

        $user = DB::select("Call cp_cek_login('$username','$password')");

        if (is_array($user)) {
            $user = $user[0];
            
            if ($user->result == "Kode Pengguna tidak ditemukan") {                   
                
                return response()->json([
                    'success' => false,
                    'message' => 'Kode Pengguna tidak ditemukan'
                ], 404);

            } elseif ($user->result == "OK") {
                return response()->json([
                    'success' => true,
                    'message' => 'Login Berhasil',
                    'user' => $user,
                    'Client' => $request->user()
                    ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Kata kunci Salah',
                    'data' => ''
                ], 400);
            }
        }
    }
    public function getUserLogin2(Request $request)
    {
        return response()->json(
        ['status' => 'success', 
        'data' => $request->user()]);
    }
    
}
