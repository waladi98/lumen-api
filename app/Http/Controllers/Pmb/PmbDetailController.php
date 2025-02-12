<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Pmb\SimakTmpPmbDetail;

class PmbDetailController extends SITUController
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
       $this->_namaTabel = new SimakTmpPmbDetail;
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
        //Validasi data 
        $this->validate($request,[
            'PMBID' => 'required|unique:simak_tmp_pmb_detail',
            'NoReff' => 'required|unique:simak_tmp_pmb_detail',
            'Waktu' => 'required',
            'Keterangan' => 'required|max:225',
            'Kirim' => 'required|in:Y,N',
            //5 atribut
        ]);
        $data = [
            'PMBID' => $request->input('PMBID'),
            'NoReff' => $request->input('NoReff'),
            'Keterangan' => $request->input('Keterangan'),
            'Waktu' => $request->input('Waktu'),
            'Kirim' => $request->input('Kirim'),
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
        //Validasi data 
        $this->validate($request,[
            'NoReff' => 'required|unique:simak_tmp_pmb_detail',
            'Waktu' => 'required',
            'Keterangan' => 'required|max:225',
            'Kirim' => 'required|in:Y,N',
            //5 atribut
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
