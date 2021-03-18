<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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
            $query =DB::table($tabel)->get();
            
            $results = $query;
            
            if ($results) {
                return response()->json([
                    'success' => true,
                    'message' => 'succsess',
                    'data' => $results 
                    ], 201);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'data not found',
                    'data' => ''
                ]);
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
                'data' => $results 
                ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data not found',
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
                'result' => [
                    'data' => $results
                ]
                ], 200);
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
                 'PMBFormulirID' => $id
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
                ], 200);
        }else {
            return response()->json([
                'status' => false,
                'message' => 'update failed',
                'id' => 'ID tidak ditemukan'
            ], 404);
        }
    }

    

}
