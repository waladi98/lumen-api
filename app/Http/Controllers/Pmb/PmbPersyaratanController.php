<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Pmb\SimakMstPmbPersyaratan;
use App\Models\User;
use Carbon\Carbon;
class PmbPersyaratanController extends SITUController
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
       $this->_namaTabel = new SimakMstPmbPersyaratan;
       $this->_kolom = 'PMBSyaratID';
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
            'PMBSyaratID' => 'required|unique:simak_mst_pmb_persyaratan|max:30',
            'KodeID' => 'required|exists:simak_mst_pmb_persyaratan,KodeID',
            'Nama' => 'required|max:60',
            'StatusAwalID' => 'required',
            'ProdiID' => 'required',
            'NA' => 'required|in:Y,N',
            //6 atribut
        ]);
        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');

        $data = [
            'PMBSyaratID' => $request->input('PMBSyaratID'),
            'KodeID' => $request->input('KodeID'),
            'Nama' => $request->input('Nama'),
            'StatusAwalID' => $request->input('StatusAwalID'),
            'ProdiID' => $request->input('ProdiID'),
            'NA' => $request->input('NA'),
            //author
            'LoginBuat' => $userKode,
            'TanggalBuat' => $waktu
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
        //Validasi data berdasarkan request # 12
        $this->validate($request,[
            'KodeID' => 'required|exists:simak_mst_pmb_persyaratan,KodeID',
            'Nama' => 'required|max:60',
            'StatusAwalID' => 'required',
            'ProdiID' => 'required',
            'NA' => 'required|in:Y,N',
            //6 atribut
        ]);

        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');

        $data = [
            'KodeID' => $request->input('KodeID'),
            'Nama' => $request->input('Nama'),
            'StatusAwalID' => $request->input('StatusAwalID'),
            'ProdiID' => $request->input('ProdiID'),
            'NA' => $request->input('NA'),
            //author
            'LoginEdit' => $userKode,
            'TanggalEdit' => $waktu
        ];

        //Update Data
        $table = $this->_namaTabel->getTable();
        $kolom = $this->_kolom;
        $this->$id=$id;
        $results = parent::update($table,$kolom,$id,$data);
        return $results;    
    }

   
}
