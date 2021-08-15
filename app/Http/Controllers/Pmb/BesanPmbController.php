<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Pmb\SimakBesanPmb;

class BesanPmbController extends SITUController
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
       $this->_namaTabel = new SimakBesanPmb;
       $this->_kolom = 'link_id';
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
            //autoIncrement
            //'link_id' => 'required | numeric',
            'link_name' => 'required|unique:simak_besan_pmb|max:100',
            'link_url' => 'required|max:200',
            'link_visibility' => 'required | numeric',
            'link_position' => 'required | numeric',
            'link_window' => 'required | numeric',
            'link_order' => 'required | numeric',
            //12 atribut
        ]);
        $data = [
            //'link_id' => $request->input('link_id'),
            'link_name' => $request->input('link_name'),
            'link_url' => $request->input('link_url'),
            'link_visibility' => $request->input('link_visibility'),
            'link_position' => $request->input('link_position'),
            'link_window' => $request->input('link_window'),
            'link_order' => $request->input('link_order')
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
        $this->validate($request,[
            //autoIncrement
            //'link_id' => 'required | numeric',
            'link_name' => 'required|unique:simak_besan_pmb|max:100',
            'link_url' => 'required|max:200',
            'link_visibility' => 'required | numeric',
            'link_position' => 'required | numeric',
            'link_window' => 'required | numeric',
            'link_order' => 'required | numeric',
            //7 atribut
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
