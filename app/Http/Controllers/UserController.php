<?php

namespace App\Http\Controllers;
use App\Models\ClientModel;
use App\Models\Pengguna\UserOtorisasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
//use model user

class UserController extends SITUController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        

    }

    //user login ke aplikasi situ 
    public function userLogin(Request $request)
    {
        //simpan kode-klien dan nama pengguna dari session
        $token = $request->session()->get('token');
        $Pengguna = $request->session()->get('name');

        //cek token dan nama pengguna
        $user = User::where('nama', $Pengguna)->first();
        $klien = ClientModel::where('token', $token)->first();
        
        //simpan value disetiap variabel
        $kodeKlien = $klien->email;
        $kodePengguna = $user->kode;
        $waktu = $user->akses_terakhir;

        //kirim data ke method parent SITUController
        $data = parent::createUserLogin($kodePengguna,$kodeKlien,$waktu);
        return $data;
    }
    
   //user logout dari aplikasi situ
    public function logout(Request $request){       
        $userKode = $request->header('username');

        $kodePengguna = $userKode;
        $waktu = Carbon::now();
            $data = [
                'waktu_logout' => $waktu,
            ]; 
        $user = User::where('kode', $kodePengguna)->first();
        if ($user) {
            $logUser = UserOtorisasi::where('kode_pengguna', 'LIKE', '%'. $user->kode .'%')->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Logout Berhasil'
                // 'session.name' => $request->session()->forget('name'),
                // 'session.token' => $request->session()->forget('token'),
                ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User belum login',
                    'data' => ''
                ], 404);
        }        
    }   
    
    //merubah password
    public function changePassword(Request $request){
        //Validasi data berdasarkan request
        $this->validate($request,[
            'current_password' => 'required',
            'new_password' => 'required|min:5|same:password_confirmation|different:current_password',
            'password_confirmation' => 'required|min:5|same:new_password',
        ]);
        
        $sandi = $request->input('current_password');
        $userKode =  $userKode = $request->header('username');
        
        $user = User::where('kode', $userKode)->first();

        if ($user) {
            if ( $sandi == $user->sandi) {
                $sandiBaru = $request->input('new_password');
                $KonfirmasiSandi = $request->input('password_confirmation');
    
                $user->update([
                    'sandi' => $KonfirmasiSandi
                ]);
    
                return response()->json([
                    'success' => true,
                    'message' => 'Kata Sandi Berhasil Diperbarui',
                    ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Kata sandi gagal diperbarui',
                    'error' => 'sandi lama pengguna tidak cocok'
                    ], 404);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kata sandi tidak sesuai dengan akun pengguna!',
                'error' => 'sandi lama pengguna tidak cocok'
                ], 404);
        }  
    }
}
