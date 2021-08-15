<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Pmb\SimakTrnPmbFormOn;
use App\Models\User;
use Carbon\Carbon;
class TrnPmbFormOnController extends SITUController
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
       $this->_namaTabel = new SimakTrnPmbFormOn;
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
        //Validasi data berdasarkan request # 12
        $this->validate($request,[
            'PMBFormJualOLID' => 'required|unique:simak_trn_pmb_formulir_online',
            'PMBPeriodID' => 'required',
            'PMBFormulirID' => 'required',
            'KodeID' => 'required|exists:simak_trn_pmb_formulir_online,KodeID',
            'Nama' => 'required',
            'Alamat' => 'required',
            'Telepon' => 'required',
            'TanggalLahir' => 'required|date',
            'NamaIbu' => 'required',
            'StatusBayar' => 'required|in:Y,N',
            'Jumlah' => 'required|numeric',
            'BuktiSetoran' => 'required',
            //'IPAddress' => 'required',
            //  'WaktuBuat' => 'required',
            //  'WaktuEdit' => 'required',
            'NA' => 'required|in:Y,N',
            //17 atribut
        ]);
        
        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');

        $data = [
            'PMBFormJualOLID' => $request->input('PMBFormJualOLID'),
            'PMBPeriodID' => $request->input('PMBPeriodID'),
            'PMBFormulirID' => $request->input('PMBFormulirID'),
            'KodeID' => $request->input('KodeID'),
            'Nama' => $request->input('Nama'),
            'Alamat' => $request->input('Alamat'),
            'Telepon' => $request->input('Telepon'),
            'TanggalLahir' => $request->input('TanggalLahir'),
            'NamaIbu' => $request->input('NamaIbu'),
            'StatusBayar' => $request->input('StatusBayar'),            
            'Jumlah' => $request->input('Jumlah'),
            'BuktiSetoran' => $request->input('BuktiSetoran'),
            'IPAddress' => $request->ip(),
            'NA' => $request->input('NA'),
            //author
            'LoginBuat' => $userKode,
            'WaktuBuat' => $waktu,

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
            'PMBPeriodID' => 'required',
            'PMBFormulirID' => 'required',
            'KodeID' => 'required|exists:simak_trn_pmb_formulir_online,KodeID',
            'Nama' => 'required',
            'Alamat' => 'required',
            'Telepon' => 'required',
            'TanggalLahir' => 'required|date',
            'NamaIbu' => 'required',
            'StatusBayar' => 'required|in:Y,N',
            'Jumlah' => 'required|numeric',
            'BuktiSetoran' => 'required',
            //'IPAddress' => 'required',
            //  'WaktuBuat' => 'required',
            //  'WaktuEdit' => 'required',
            'NA' => 'required|in:Y,N',
            //17 atribut
        ]);
         //data user pembuat
         $waktu = Carbon::now();
         $userKode = $request->header('username');
 
         $data = [
             'PMBPeriodID' => $request->input('PMBPeriodID'),
             'PMBFormulirID' => $request->input('PMBFormulirID'),
             'KodeID' => $request->input('KodeID'),
             'Nama' => $request->input('Nama'),
             'Alamat' => $request->input('Alamat'),
             'Telepon' => $request->input('Telepon'),
             'TanggalLahir' => $request->input('TanggalLahir'),
             'NamaIbu' => $request->input('NamaIbu'),
             'StatusBayar' => $request->input('StatusBayar'),            
             'Jumlah' => $request->input('Jumlah'),
             'BuktiSetoran' => $request->input('BuktiSetoran'),
             'IPAddress' => $request->ip(),
             'NA' => $request->input('NA'),
             //author
             'LoginEdit' => $userKode,
             'WaktuEdit' => $waktu,
 
         ];
        //Update Data
        $table = $this->_namaTabel->getTable();
        $kolom = $this->_kolom;
        $this->$id=$id;
        $results = parent::update($table,$kolom,$id,$data);
        return $results;    
    }

    
}
