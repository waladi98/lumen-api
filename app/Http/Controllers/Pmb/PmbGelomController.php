<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pmb\SimakMstPmbGelombang;
use Carbon\Carbon;

class PmbGelomController extends SITUController
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
       $this->_namaTabel = new SimakMstPmbGelombang;
       $this->_kolom = 'PMBPeriodID';
    }
    //tampilkan semuda data Gelomabang
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
    //tampilkan satu data gelombang berdasrkan ID
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
                'message' => 'data not found',
                'data' => ''
            ], 404);
        }          
    }
    //tambah Data gelombang baru
    public function createData(Request $request)
    {
        //Validasi data 
        $this->validate($request,[
            'PMBPeriodID' => 'required|unique:simak_mst_pmb_gelombang|max:60',
            'KodeID' => 'required|exists:simak_mst_pmb_gelombang,KodeID',
            'Nama' => 'required|max:100',
            'TglMulai' => 'required|date',
            'TglSelesai' => 'required|date', 
            'WaktuSelesaiOnline' => 'required|date',
            'UjianMulai' => 'required|date',
            'UjianSelesai' => 'required|date',
            'JamUjianMulai' => 'required|date_format:H:i:s',
            'JamUjianSelesai' => 'required|date_format:H:i:s',
            'PengumumanMulai' => 'required|date',
            'PengumumanSelesai' => 'required|date',
            'BayarMulai' => 'required|date',
            'BayarSelesai' => 'required|date',
            'TelitiBayarProdi' => 'required',
            'NA' => 'required|in:Y,N',
            'NomorPengumuman' => 'required',
            'NomorSuket' => 'required'
            //18 atribut
        ]);
        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');

        $data = [
            'PMBPeriodID' => $request->input('PMBPeriodID'),
            'KodeID' => $request->input('KodeID'),
            'Nama' => $request->input('Nama'),
            'TglMulai' => $request->input('TglMulai'),
            'TglSelesai' => $request->input('TglSelesai'),
            'WaktuSelesaiOnline' => $request->input('WaktuSelesaiOnline'),
            'UjianMulai' => $request->input('UjianMulai'),
            'UjianSelesai' => $request->input('UjianSelesai'),
            'JamUjianMulai' => $request->input('JamUjianMulai'),
            'JamUjianSelesai' => $request->input('JamUjianSelesai'),
            'PengumumanMulai' => $request->input('PengumumanMulai'),
            'PengumumanSelesai' => $request->input('PengumumanSelesai'),
            'BayarMulai' => $request->input('BayarMulai'),
            'BayarSelesai' => $request->input('BayarSelesai'),
            'TelitiBayarProdi' => $request->input('TelitiBayarProdi'),
            'NA' => $request->input('NA'), 
            'NomorPengumuman' => $request->input('NomorPengumuman'),
            'PengumumanSelesai' => $request->input('PengumumanSelesai'),
            'NomorSuket' => $request->input('NomorSuket'),
            //waktu
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

    //delete 1 data pmb gelombang
    public function deleteData($id)
    {
        //Hapus data berdasarkan ID
        $table = $this->_namaTabel->getTable();
        $kolom = $this->_kolom;
        $this->$id=$id; 
        $data = parent::destroy($table,$kolom,$id);
        return $data;
    }


    //edit data pmb gelombang berdasarkan PMBPeriodID
    public function editData(Request $request, $id)
    {
        //Validasi data 
        $this->validate($request,[
            'KodeID' => 'required|exists:simak_mst_pmb_gelombang,KodeID',
            'Nama' => 'required|max:100',
            'TglMulai' => 'required|date',
            'TglSelesai' => 'required|date', 
            'WaktuSelesaiOnline' => 'required|date',
            'UjianMulai' => 'required|date',
            'UjianSelesai' => 'required|date',
            'JamUjianMulai' => 'required|date_format:H:i:s',
            'JamUjianSelesai' => 'required|date_format:H:i:s',
            'PengumumanMulai' => 'required|date',
            'PengumumanSelesai' => 'required|date',
            'BayarMulai' => 'required|date',
            'BayarSelesai' => 'required|date',
            'TelitiBayarProdi' => 'required',
            'NA' => 'required|in:Y,N',
            'NomorPengumuman' => 'required',
            'NomorSuket' => 'required'
            //18 atribut
        ]);

        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');

        $data = [
            'KodeID' => $request->input('KodeID'),
            'Nama' => $request->input('Nama'),
            'TglMulai' => $request->input('TglMulai'),
            'TglSelesai' => $request->input('TglSelesai'),
            'WaktuSelesaiOnline' => $request->input('WaktuSelesaiOnline'),
            'UjianMulai' => $request->input('UjianMulai'),
            'UjianSelesai' => $request->input('UjianSelesai'),
            'JamUjianMulai' => $request->input('JamUjianMulai'),
            'JamUjianSelesai' => $request->input('JamUjianSelesai'),
            'PengumumanMulai' => $request->input('PengumumanMulai'),
            'PengumumanSelesai' => $request->input('PengumumanSelesai'),
            'BayarMulai' => $request->input('BayarMulai'),
            'BayarSelesai' => $request->input('BayarSelesai'),
            'TelitiBayarProdi' => $request->input('TelitiBayarProdi'),
            'NA' => $request->input('NA'), 
            'NomorPengumuman' => $request->input('NomorPengumuman'),
            'PengumumanSelesai' => $request->input('PengumumanSelesai'),
            'NomorSuket' => $request->input('NomorSuket'),
            //waktu
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
