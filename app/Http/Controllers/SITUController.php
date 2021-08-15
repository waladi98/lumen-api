<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pengguna\UserOtorisasi;
use App\Models\User;
use Illuminate\Support\Std;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class SITUController extends BaseController
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
    //tampilkan semua data
    public function index($tabel){

        if ($tabel) {
            $query = DB::table($tabel)->paginate(20);
            
            $results = $query;
            
            if ($results != null) {
                return response()->json([
                    'success' => true,
                    'message' => 'Request Sukses',
                    'result' => $results 
                    ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Request Sukses',
                    'data' => null
                ], 200);
            }
        }  else {
            return response()->json([
                'status' => false,
                'message' => 'Table not found',
                'data' => ''
            ], 404);
        }     
    }

    //tampilkan satu data berdasarkan id
    public function show($tabel,$kolom,$id)
    {
        $query = DB::table($tabel)->where($kolom, $id)->first();
        
        $results = $query;

        if ($results) {
            return response()->json([
                'success' => true,
                'message' => 'succsess',
                'data' => [
                    $results 
                ]
                ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Data dengan ID[$id] tidak ditemukan",
               // 'message' => "Data dengan ID[$id] tidak ditemukan",
                'data' => ''
                ], 404);
        }    
    }

    //tambah data baru
    public function create($tabel,$data)
    {
        //Insert Data
        $results = DB::table($tabel)->insert($data);

        if ($results) {
            return response()->json([
                'success' => true,
                'message' => 'Tambah data Berhasil',
                'result' => [$data]
                ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data gagal ditambahkan',
                'data' => ''
                ], 404);
        }
    }
    
    //hapus 1 data berdasarkan id
    public function destroy($tabel,$kolom,$id){
        
        $query = DB::table($tabel)->where($kolom, $id)->delete();
        if ($query) {
             return response()->json([
                 'success' => true,
                 'message' => 'Berhasil Menghapus Data',
                 $kolom => $id
                 ], 201);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Data tidak ditemukan!',
                'Id data' => null
                ], 404);
        }
    }

    //edit 1 data berdasarkan id
    public function update($tabel,$kolom,$id,$data)
    {
        $query = DB::table($tabel)->where($kolom, $id)->update($data);
        if ($query) {
            return response()->json([
                'success' => true,
                'message' => 'Update data succsess',
                $kolom => $id
                ], 201);
        }else {
            return response()->json([
                'status' => false,
                'message' => 'update failed',
                'id' => 'ID tidak ditemukan'
            ], 404);
        }
    }

    //buat log login pengguna
    public function createUserLogin($kodePengguna,$kodeKlien,$waktu){

        $data = [
            'kode_pengguna' => $kodePengguna,
            'kode_klien' => $kodeKlien,
            'waktu_login' => $waktu,
        ];
        $cek = UserOtorisasi::where('kode_pengguna', $kodePengguna)->first();
        if ($cek) {
            $cek->update([
                'waktu_login' => $waktu
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Login User Sukses SITU',
                'kode-pengguna' => $kodePengguna,
                'kode-klien' => $kodeKlien
                ], 201);
        } else {
            $userLogin = UserOtorisasi::create($data);
            return response()->json([
                'success' => true,
                'message' => 'Login User Sukses',
                'kode-pengguna' => $kodePengguna,
                'kode-klien' => $kodeKlien
                ], 201);
        }
    }
}
