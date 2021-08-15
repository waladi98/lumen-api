<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Pmb\SimakRefPmbPengaturan;

class PmbPengaturanController extends SITUController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $_namaTabel;
    private $_kolom;
    public function __construct()
    {
       $this->_namaTabel = new SimakRefPmbPengaturan;
       $this->_kolom = 'id_user';
    }
    //tampilkan semua data
    public function getData()
    {
        $table = $this->_namaTabel->getTable();
        
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
        
        $table = $this->_namaTabel->getTable();
        $kolom = $this->_kolom;
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
        //Validasi data berdasarkan request
        $this->validate($request,[
            'id_user' => 'required|numeric|unique:simak_ref_pmb_pengaturan',
            'tahun_akademik' => 'required',
            'gelombang' => 'required|numeric',
            'jangka_waktu_registrasi' => 'required',
            'jam_registrasi' => 'required',
            'cabang_bank' => 'required',
            'nomor_rekening' => 'required',
            'atas_nama' => 'required',
            //8 atribut
        ]);
        $data = [
            'id_user' => $request->input('id_user'),
            'tahun_akademik' => $request->input('tahun_akademik'),
            'gelombang' => $request->input('gelombang'),
            'jangka_waktu_registrasi' => $request->input('jangka_waktu_registrasi'),
            'jam_registrasi' => $request->input('jam_registrasi'),
            'cabang_bank' => $request->input('cabang_bank'),
            'nomor_rekening' => $request->input('nomor_rekening'),
            'atas_nama' => $request->input('atas_nama'),
        ];
        //Insert Data
        $table = $this->_namaTabel->getTable();
        
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
        $table = $this->_namaTabel->getTable();
        $kolom = $this->_kolom;
        $this->$id=$id; 
        $data = parent::destroy($table,$kolom,$id);
        return $data;
    }
    //edit Data
    public function editData(Request $request, $id)
    {
        //Validasi data berdasarkan request
        $this->validate($request,[
            'tahun_akademik' => 'required',
            'gelombang' => 'required|numeric',
            'jangka_waktu_registrasi' => 'required',
            'jam_registrasi' => 'required',
            'cabang_bank' => 'required',
            'nomor_rekening' => 'required',
            'atas_nama' => 'required',
            //8 atribut
        ]);
        //Update Data
        $table = $this->_namaTabel->getTable();
        $kolom = $this->_kolom;
        $this->$id=$id;
        $data = $request->all(); 
        $data = parent::update($table,$kolom,$id,$data);
        return $data;    
    }

   
}
