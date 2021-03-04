<?php

namespace App\Http\Controllers;

use App\Models\modelJalakSysPengguna;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = modelJalakSysPengguna::where("kode" ,);
        // $user = DB::select("SELECT * FROM jalak_sys_pengguna");
        return response()->json("Belum login");
    }
    public function login(Request $request)
    {
        //tampilkan satu data berdasarkan ID
        // $data = modelJalakSysPengguna::where('kode', $id)->get();
        // return response()->json($data);
        $kode = $request->input('kode');
        $sandi = $request->input('sandi');

        // $user =  modelJalakSysPengguna::where('kode', $kode)->first();
        $user = DB::select("Call cp_cek_login('$kode','$sandi')");
        
        if (is_array($user)) {
            $user = $user[0];
            if ($user->result == "Kode Pengguna tidak ditemukan") {
                return response()->json([
                    'pesan' => 'Kode Pengguna tidak ditemukan',
                    'status' => '404'
                ]);
            }elseif ($user->result == "OK") {
                //buat token
                $token = Str::random(40);
                //update api token di DB
                // $user->update([
                //     'api_token' => $token
                // ]);
                return response()->json([
                    'pesan' => 'Login berhasil',
                    'status' => '200',
                    'token' => $token,
                    'data' => $user
                ]);
            }else {
                return response()->json([
                    'pesan' => 'kata Kunci Salah',
                    'status' => '404'
                ]);
            }
        }        
    }
}
