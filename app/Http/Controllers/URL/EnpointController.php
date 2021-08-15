<?php

namespace App\Http\Controllers\URL;
use App\Http\Controllers\SITUController; 
use Illuminate\Http\Request;
use App\Models\URL\UrlModel;

class EnpointController extends SITUController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }
    //tampilkan semua data
    public function getData()
    {
        $namaTable= new UrlModel;
        $table = $namaTable->getTable();
        $data = parent::index($table);
        if ($data) {
            return $data;   
        } else {
            return response([
                'status' => false,
                'message' => 'data not found',
                'data' => ''
            ], 404);
        }             
    }
    //tampilkan 1 data  berdasarkan ID
    public function showData($id)
    {
        
        $namaTable = new UrlModel;
        $table = $namaTable->getTable();
        $kolom = 'kode';
        $this->$id=$id; 
        $data = parent::show($table,$kolom,$id);
        if ($data) {
            return $data;   
        } else {
            return response([
                'status' => false,
                'message' => "Data dengan $id data tidak ditemukan",
                'data' => ''
            ], 404);
        }          
    }
    //tambah data  baru
    public function createData(Request $request)
    {
        //Validasi data berdasarkan request # 12
        $this->validate($request,[
            'kode' => 'required |numeric|unique:ws_mst_endpoint',
            'endpoint' => 'required|unique:ws_mst_endpoint',
            'verb' => 'required',
            'jenis' => 'required',
            //12 atribut
        ]);
        $data = [
            'kode' => $request->input('kode'),
            'endpoint' => $request->input('endpoint'),
            'verb' => $request->input('verb'),
            'jenis' => $request->input('jenis'),
        ];
        //Insert Data
        $namaTable= new UrlModel;
        $table = $namaTable->getTable();
        $results = parent::create($table,$data);
        if ($results) {
            return $results;   
        } else {
            return response([
                'status' => false,
                'message' => 'data not found',
                'data' => ''
            ], 404);
        } 
    }

    //Hapus data berdasarkan ID
    public function deleteData($id)
    {
        $namaTable = new UrlModel;
        $table = $namaTable->getTable();
        $kolom = 'kode';
        $this->$id=$id; 
        $data = parent::destroy($table,$kolom,$id);
        return $data;
    }
    //edit Data
    public function editData(Request $request, $id)
    {
        //Update Data
        $namaTable = new UrlModel;
        $table = $namaTable->getTable();
        $kolom = 'kode';
        $this->$id=$id;
        $data = $request->all(); 
        $data = parent::update($table,$kolom,$id,$data);
        return $data;    
    }

   
}
