<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Pmb\SimakTrnPmbNilai;

class TrnPmbNilaiController extends SITUController
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
       $this->_namaTabel = new SimakTrnPmbNilai;
       $this->_kolom = 'PMBID';
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
        //Validasi data berdasarkan request # 12
        $this->validate($request,[
            'PMBID' => 'required|numeric|unique:simak_trn_pmb_nilai',
            'PMBUSMID' => 'required',
            'Benar' => 'required|numeric',
            'Nilai' => 'required|numeric',
            //17 atribut
        ]);
        $data = [
            'PMBID' => $request->input('PMBID'),
            'PMBUSMID' => $request->input('PMBUSMID'),
            'Benar' => $request->input('Benar'),
            'Nilai' => $request->input('Nilai'),
            
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
        $namaTable = new SimakTrnPmbNilai;
        $table = $namaTable->getTable();
        $kolom = 'PMBID';
        $this->$id=$id; 
        $data = parent::destroy($table,$kolom,$id);
        return $data;
    }
    //edit Data
    public function editData(Request $request, $id)
    {
        $this->validate($request,[
            'PMBUSMID' => 'required',
            'Benar' => 'required|numeric',
            'Nilai' => 'required|numeric',
            //17 atribut
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
