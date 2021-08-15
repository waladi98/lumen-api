<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Pmb\SimakMstPmbUsmKunci;

class PmbUsmKunciController extends SITUController
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
       $this->_namaTabel = new SimakMstPmbUsmKunci;
       $this->_kolom = 'ID';
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
            //auto-increment
            //'ID' => 'required',
            'PMBID' => 'required',
            'PMBPeriodID' => 'required',
            'TglLahir' => 'required',
            'KodeTest' => 'required|exists:simak_mst_pmb_usm_kunci,KodeTest',
            'TglUjian' => 'required',
            'Jawaban' => 'required',
            'Lain' => 'required',
            'Benar' => 'required | numeric',
            'Nilai' => 'required | numeric',
            'DetailNilai' => 'required',
            'SPC' => 'required',
            //12 atribut
        ]);
        $data = [
            //'ID' => $request->input('ID'),
            'PMBID' => $request->input('PMBID'),
            'PMBPeriodID' => $request->input('PMBPeriodID'),
            'TglLahir' => $request->input('TglLahir'),
            'KodeTest' => $request->input('KodeTest'),
            'TglUjian' => $request->input('TglUjian'),
            'Jawaban' => $request->input('Jawaban'),
            'Lain' => $request->input('Lain'),
            'Benar' => $request->input('Benar'),
            'Nilai' => $request->input('Nilai'),
            'DetailNilai' => $request->input('DetailNilai'),
            'SPC' => $request->input('SPC'),

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
            'PMBID' => 'required',
            'PMBPeriodID' => 'required',
            'TglLahir' => 'required',
            'KodeTest' => 'required|exists:simak_mst_pmb_usm_kunci,KodeTest',
            'TglUjian' => 'required',
            'Jawaban' => 'required',
            'Lain' => 'required',
            'Benar' => 'required | numeric',
            'Nilai' => 'required | numeric',
            'DetailNilai' => 'required',
            'SPC' => 'required',
            //12 atribut
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
