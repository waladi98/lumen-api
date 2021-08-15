<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Pmb\SimakMstPmbSekolah;

class PmbSekolahController extends SITUController
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
       $this->_namaTabel = new SimakMstPmbSekolah;
       $this->_kolom = 'npsn';
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
            'npsn' => 'required|numeric|unique:simak_mst_pmb_sekolah',
            'nama_sekolah' => 'required',
            'alamat_sekolah' => 'required',
            'desa_kel' => 'required',
            'kec' => 'required',
            'kab_kota' => 'required',
            'provinsi' => 'required',
            'email' => 'required | email:rfc,dns',
            'no_telepon' => 'required',
            'id_guru' => 'required|numeric',
            'id_status_konfirmasi' => 'required | numeric',
            'status' => 'required',
            //12 atribut
        ]);
        $data = [
            'npsn' => $request->input('npsn'),
            'nama_sekolah' => $request->input('nama_sekolah'),
            'alamat_sekolah' => $request->input('alamat_sekolah'),
            'desa_kel' => $request->input('desa_kel'),
            'kec' => $request->input('kec'),
            'kab_kota' => $request->input('kab_kota'),
            'provinsi' => $request->input('provinsi'),
            'email' => $request->input('email'),
            'no_telepon' => $request->input('no_telepon'),
            'id_guru' => $request->input('id_guru'),
            'id_status_konfirmasi' => $request->input('id_status_konfirmasi'),
            'status' => $request->input('status'),
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
            'nama_sekolah' => 'required',
            'alamat_sekolah' => 'required',
            'desa_kel' => 'required',
            'kec' => 'required',
            'kab_kota' => 'required',
            'provinsi' => 'required',
            'email' => 'required | email:rfc,dns',
            'no_telepon' => 'required',
            'id_guru' => 'required|numeric',
            'id_status_konfirmasi' => 'required | numeric',
            'status' => 'required',
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
