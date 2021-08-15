<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Pmb\SimakTrnPmbForm;
use App\Models\User;
use Carbon\Carbon;
class TrnPmbFormController extends SITUController
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
       $this->_namaTabel = new SimakTrnPmbForm;
       $this->_kolom = 'PMBFormJualID';
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
            'PMBFormJualID' => 'required|unique:simak_trn_pmb_formulir',
            'PMBFormulirID' => 'required|numeric',
            'KodeID' => 'required|exists:simak_trn_pmb_formulir,KodeID',
            'Tanggal' => 'required|date',
            'PMBPeriodID' => 'required',
            'BuktiSetoran' => 'required',
            'Nama' => 'required',
            'Keterangan' => 'required',
            'Jumlah' => 'required|numeric',
            'CetakanKe' => 'required|numeric',
            'NA' => 'required|in:Y,N',
            'Batal' => 'required|in:Y,N',
            'OK' => 'required|in:Y,N',
            //17 atribut
        ]);
        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');

        $data = [
            'PMBFormJualID' => $request->input('PMBFormJualID'),
            'PMBFormulirID' => $request->input('PMBFormulirID'),
            'KodeID' => $request->input('KodeID'),
            'Tanggal' => $request->input('Tanggal'),
            'PMBPeriodID' => $request->input('PMBPeriodID'),
            'BuktiSetoran' => $request->input('BuktiSetoran'),
            'Nama' => $request->input('Nama'),
            'Keterangan' => $request->input('Keterangan'),
            'Jumlah' => $request->input('Jumlah'),
            'CetakanKe' => $request->input('CetakanKe'),            
            'NA' => $request->input('NA'),
            'Batal' => $request->input('Batal'),
            'OK' => $request->input('OK'),
            //author
            'LoginBuat' => $userKode,
            'TanggalBuat' => $waktu
        ];
        //Insert Data
        $table = $this->_namaTabel->getTable();
        $kolom = $this->_kolom;
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
            'PMBFormulirID' => 'required|numeric',
            'KodeID' => 'required|exists:simak_trn_pmb_formulir,KodeID',
            'Tanggal' => 'required|date',
            'PMBPeriodID' => 'required',
            'BuktiSetoran' => 'required',
            'Nama' => 'required',
            'Keterangan' => 'required',
            'Jumlah' => 'required|numeric',
            'CetakanKe' => 'required|numeric',
            'NA' => 'required|in:Y,N',
            'Batal' => 'required|in:Y,N',
            'OK' => 'required|in:Y,N',
            //17 atribut
        ]);
        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');

        $data = [
            'PMBFormulirID' => $request->input('PMBFormulirID'),
            'KodeID' => $request->input('KodeID'),
            'Tanggal' => $request->input('Tanggal'),
            'PMBPeriodID' => $request->input('PMBPeriodID'),
            'BuktiSetoran' => $request->input('BuktiSetoran'),
            'Nama' => $request->input('Nama'),
            'Keterangan' => $request->input('Keterangan'),
            'Jumlah' => $request->input('Jumlah'),
            'CetakanKe' => $request->input('CetakanKe'),            
            'NA' => $request->input('NA'),
            'Batal' => $request->input('Batal'),
            'OK' => $request->input('OK'),
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
