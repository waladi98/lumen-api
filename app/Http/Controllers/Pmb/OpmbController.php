<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pmb\SimakMstOpmb;
use Carbon\Carbon;
class OpmbController extends SITUController
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
       $this->_namaTabel = new SimakMstOpmb;
       $this->_kolom = 'OPMBID';
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
            //auto-increment
            //'OPMBID' => 'required',
            'Tahun' => 'required|numeric',
            'KodeID' => 'required|exists:simak_mst_opmb,KodeID',
            'Nama' => 'required|max:100',
            'Tempat' => 'required|max:100',
            'PerKelompok' => 'required|numeric',
            'Kelompok' => 'required|max:500',
            'WaktuMulai' => 'required | date',
            'WaktuSelesai' => 'required | date',
            //---
            // 'LoginBuat' => 'required | date',
            // 'WaktuBuat' => 'required | date',
            //---
            'NA' => 'required|in:Y,N',

            //14 atribut
        ]);
        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');
    
        $data = [
            //'OPMBID' => $request->input('OPMBID'),
            'Tahun' => $request->input('Tahun'),
            'KodeID' => $request->input('KodeID'),
            'Nama' => $request->input('Nama'),
            'Tempat' => $request->input('Tempat'),
            'PerKelompok' => $request->input('PerKelompok'),
            'Kelompok' => $request->input('Kelompok'),
            'WaktuMulai' => $request->input('WaktuMulai'),
            'WaktuSelesai' => $request->input('WaktuSelesai'),
            //---
            'LoginBuat' => $userKode,
            'WaktuBuat' => $waktu,
            //--
            'NA' => $request->input('NA'),

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
        

        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');
        
       // $request->input($waktu);
        //Validasi data 
        $this->validate($request,[
            'Tahun' => 'required|numeric',
            'KodeID' => 'required|exists:simak_mst_opmb,KodeID',
            'Nama' => 'required|max:100',
            'Tempat' => 'required',
            'PerKelompok' => 'required|numeric',
            'Kelompok' => 'required|',
            'WaktuMulai' => 'required|date',
            'WaktuSelesai' => 'required|date',
            'NA' => 'required|in:Y,N',
        ]);
         
        $data = [
            'Tahun' => $request->input('Tahun'),
            'KodeID' => $request->input('KodeID'),
            'Nama' => $request->input('Nama'),
            'Tempat' => $request->input('Tempat'),
            'PerKelompok' => $request->input('PerKelompok'),
            'Kelompok' => $request->input('Kelompok'),
            'WaktuMulai' => $request->input('WaktuMulai'),
            'WaktuSelesai' => $request->input('WaktuSelesai'),
            //---
            'LoginEdit' => $userKode,
            'WaktuEdit' => $waktu,
            //--
            'NA' => $request->input('NA'),

        ];

        $table = $this->_namaTabel->getTable();
        $kolom = $this->_kolom;     
        $this->$id=$id;
        
        $results = parent::update($table,$kolom,$id,$data);
        return $results;    
    }

   
}
