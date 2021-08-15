<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Pmb\LmsTrnPmb;

class LmsTrnPmbController extends SITUController
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
       $this->_namaTabel = new LmsTrnPmb;
       $this->_kolom = 'pmb_id';
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
            'pmb_id' => 'required|numeric|unique:lms_trn_pmb',
            'id_course' => 'required | numeric',
            'id_role_assignments' => 'required | numeric',
            'id_user_enrolments' => 'required | numeric',
            //4 atribut
        ]);
        $data = [
            'pmb_id' => $request->input('pmb_id'),
            'id_course' => $request->input('id_course'),
            'id_role_assignments' => $request->input('id_role_assignments'),
            'id_user_enrolments' => $request->input('id_user_enrolments'),
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
            'id_course' => 'required | numeric',
            'id_role_assignments' => 'required | numeric',
            'id_user_enrolments' => 'required | numeric',
            //4 atribut
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
