<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Pmb\SimakMstPmbFormulir;

class PmbFormController extends SITUController
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
       $this->_namaTabel = new SimakMstPmbFormulir;
       $this->_kolom = 'PMBFormulirID';
    }

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
                'message' => 'data not found2',
                'data' => ''
            ], 404);
        }          
    }
    public function createData(Request $request)
    {
        //Validasi data 
        $this->validate($request,[
            //'PMBFormulirID' => 'required',
            'Nama' => 'required | unique:simak_mst_pmb_formulir',
            'KodeID' => 'required|exists:simak_mst_pmb_formulir,KodeID',
            'JumlahPilihan' => 'required | numeric', 
            'Harga' => 'required | numeric',
            'HanyaProdi1' => 'required',
            'KecualiProdi1' => 'required',
            'HanyaProdi2' => 'required',
            'KecualiProdi2' => 'required',
            'HanyaProdi3' => 'required',
            'KecualiProdi3' => 'required',
            'Keterangan' => 'required',
            'NA' => 'required|in:Y,N'
        ]);
        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');

        $data = [
            //'PMBFormulirID' => $request->input('PMBFormulirID'),
            'Nama' => $request->input('Nama'),
            'KodeID' => $request->input('KodeID'),
            'JumlahPilihan' => $request->input('JumlahPilihan'),
            'Harga' => $request->input('Harga'),
            'HanyaProdi1' => $request->input('HanyaProdi1'),
            'KecualiProdi1' => $request->input('KecualiProdi1'),
            'HanyaProdi2' => $request->input('HanyaProdi2'),
            'KecualiProdi2' => $request->input('KecualiProdi2'),
            'HanyaProdi3' => $request->input('HanyaProdi3'),
            'KecualiProdi3' => $request->input('KecualiProdi3'),
            'Keterangan' => $request->input('Keterangan'),
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
    public function deleteData($id)
    {
        //Hapus data berdasarkan ID
        $table = $this->_namaTabel->getTable();
        $kolom = $this->_kolom;
        $this->$id=$id; 
        $data = parent::destroy($table,$kolom,$id);
        return $data;
    }
    
    public function editData(Request $request, $id)
    {
        //Validasi data 
        $this->validate($request,[
            'Nama' => 'required',
            'KodeID' => 'required|exists:simak_mst_pmb_formulir,KodeID',
            'JumlahPilihan' => 'required | numeric', 
            'Harga' => 'required | numeric',
            'HanyaProdi1' => 'required',
            'KecualiProdi1' => 'required',
            'HanyaProdi2' => 'required',
            'KecualiProdi2' => 'required',
            'HanyaProdi3' => 'required',
            'KecualiProdi3' => 'required',
            'Keterangan' => 'required',
            'NA' => 'required|in:Y,N'
        ]);
        
        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');

        $data = [
            //'PMBFormulirID' => $request->input('PMBFormulirID'),
            'Nama' => $request->input('Nama'),
            'KodeID' => $request->input('KodeID'),
            'JumlahPilihan' => $request->input('JumlahPilihan'),
            'Harga' => $request->input('Harga'),
            'HanyaProdi1' => $request->input('HanyaProdi1'),
            'KecualiProdi1' => $request->input('KecualiProdi1'),
            'HanyaProdi2' => $request->input('HanyaProdi2'),
            'KecualiProdi2' => $request->input('KecualiProdi2'),
            'HanyaProdi3' => $request->input('HanyaProdi3'),
            'KecualiProdi3' => $request->input('KecualiProdi3'),
            'Keterangan' => $request->input('Keterangan'),
            'NA' => $request->input('NA'), 
            //author
            'LoginEdit' => $userKode,
            'TanggalEdit' => $waktu
        ];
        $table = $this->_namaTabel->getTable();
        $kolom = $this->_kolom;
        $this->$id=$id;
        $results = parent::update($table,$kolom,$id,$data);
        return $results;    
    }
}
