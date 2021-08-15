<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Pmb\SimakMstPmbFormOnline;

class PmbFormONController extends SITUController
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
       $this->_namaTabel = new SimakMstPmbFormOnline;
       $this->_kolom = 'PMBFormJualOLID';
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
            'PMBFormJualOLID' => 'required|unique:simak_prc_pmb_formulir_online|max:25',
            'KirimPendaftaran' => 'required|in:Y,N',
            'KirimFormulir' => 'required|in:Y,N',
            'KirimLMS' => 'required|in:Y,N',
            'KirimHasil' => 'required|in:Y,N',
            //5 atribut
        ]);
        $data = [
            'PMBFormJualOLID' => $request->input('PMBFormJualOLID'),
            'KirimPendaftaran' => $request->input('KirimPendaftaran'),
            'KirimFormulir' => $request->input('KirimFormulir'),
            'KirimLMS' => $request->input('KirimLMS'),
            'KirimHasil' => $request->input('KirimHasil'),
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
            'KirimPendaftaran' => 'required|in:Y,N',
            'KirimFormulir' => 'required|in:Y,N',
            'KirimLMS' => 'required|in:Y,N',
            'KirimHasil' => 'required|in:Y,N',
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
