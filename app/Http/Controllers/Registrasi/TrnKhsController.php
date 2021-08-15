<?php

namespace App\Http\Controllers\Registrasi;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Registrasi\SimakTrnKhs;
use App\Models\User;
use Carbon\Carbon;
class TrnKhsController extends SITUController
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
       $this->_namaTabel = new SimakTrnKhs;
       $this->_kolom = 'KHSID';
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
            //'KeyID' => 'required',
            'KHSID' => 'required|unique:simak_trn_khs',
            'KodeID'=> 'required|exists:simak_trn_khs,KodeID',
            'ProgramID' => 'required|exists:simak_trn_khs,ProgramID',
            'ProdiID' => 'required|numeric',
            'TahunID' => 'required|numeric|unique:simak_trn_khs|max:100',
            'MhswID'=> 'required|numeric|unique:simak_trn_khs',
            'StatusMhswID' => 'required|exists:simak_trn_khs,StatusMhswID',
            'Sesi'=> 'required|numeric',
            'MaxSKS' => 'required|numeric',
            'SKSK'=> 'required|numeric',
            'SKS'=> 'required|numeric',
            'IPS'=> 'required',
            'IPT'=> 'required',
            'IPA' => 'required',
            'JumlahMK' => 'required|numeric',
            'TotalSKS' => 'required|numeric',
            'RataanPresensi' => 'required',
            'MKPresensi' => 'required|numeric',
            'RataanUTS' => 'required',
            'MKUTS' => 'required|numeric',
            'MKUAS' => 'required|numeric',
            'IP' => 'required',
            'BIPOTID' => 'required|numeric',
            'SaldoAwal' => 'required|numeric',
            'Biaya' => 'required|numeric',
            'Potongan' => 'required|numeric',
            'Bayar' => 'required|numeric',
            'Tarik' => 'required|numeric',
            'JumlahLain' => 'required|numeric',
            'StatusDPP' => 'required|numeric',
            'CetakKRS' => 'required|numeric',
            'Cetak' => 'required|in:Y,N',
            'KaliCetak' => 'required|numeric',
            'Tutup' => 'required|in:Y,N',
            'Autodebet' => 'required|numeric',
            'Blok' => 'required',
            'KeteranganBlok' => 'required',
            'NoSurat' => 'required',
            'TglSurat' => 'required|date',
            'Keterangan' => 'required',
            'Finger' => 'required|in:Y,N',
            'TA' => 'required|in:Y,N',
            '0SKS' => 'required|in:0,15,25,30,50,100',
            'BayarUTS' => 'required|in:Y,N',
            'WaktuBayarUTS' => 'required|date',
            'BiayaUTS' => 'required|numeric',
            'BayarUAS' => 'required|in:Y,N',
            'WaktuBayarUAS' => 'required|date',
            'BiayaUAS' => 'required|numeric',
            //
            'NA'=> 'required|in:Y,N',
            '_StatusMhswID1' => 'required|in:Y,N',
            '_StatusMhswID2' => 'required|in:Y,N',
        ]);
        
        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');

        $data = [
            //'KeyID' => $request->input('KeyID'),
            'KHSID' => $request->input('KHSID'),
            'KodeID' => $request->input('KodeID'),
            'ProgramID' => $request->input('ProgramID'),
            'ProdiID' => $request->input('ProdiID'),
            'TahunID' => $request->input('TahunID'),
            'MhswID' => $request->input('MhswID'),
            'StatusMhswID' => $request->input('StatusMhswID'),
            'Sesi' => $request->input('Sesi'),
            'MaxSKS' => $request->input('MaxSKS'),
            'SKSK' => $request->input('SKSK'),
            'SKS' => $request->input('SKS'),
            'IPS' => $request->input('IPS'),
            'IPT' => $request->input('IPT'),
            'IPA' => $request->input('IPA'),
            'JumlahMK' => $request->input('JumlahMK'),
            'TotalSKS' => $request->input('TotalSKS'),
            'RataanPresensi' => $request->input('RataanPresensi'),
            'MKPresensi' => $request->input('MKPresensi'),
            'RataanUTS' => $request->input('RataanUTS'),
            'MKUTS' => $request->input('MKUTS'),
            'MKUAS' => $request->input('MKUAS'),
            'IP' => $request->input('IP'),
            'BIPOTID' => $request->input('BIPOTID'),
            'SaldoAwal' => $request->input('SaldoAwal'),
            'Biaya' => $request->input('Biaya'),
            'Potongan' => $request->input('Potongan'),
            'Bayar' => $request->input('Bayar'),
            'Tarik' => $request->input('Tarik'),
            'JumlahLain' => $request->input('JumlahLain'),
            'StatusDPP' => $request->input('StatusDPP'),
            'CetakKRS' => $request->input('CetakKRS'),
            'Cetak' => $request->input('Cetak'),
            'KaliCetak' => $request->input('KaliCetak'),
            'Tutup' => $request->input('Tutup'),
            'Autodebet' => $request->input('Autodebet'),
            'Blok' => $request->input('Blok'),
            'KeteranganBlok' => $request->input('KeteranganBlok'),
            'NoSurat' => $request->input('NoSurat'),
            'TglSurat' => $request->input('TglSurat'),
            'Keterangan' => $request->input('Keterangan'),
            'Finger' => $request->input('Finger'),
            'TA' => $request->input('TA'),
            '0SKS' => $request->input('0SKS'),
            'BayarUTS' => $request->input('BayarUTS'),
            'WaktuBayarUTS' => $request->input('WaktuBayarUTS'),
            'BiayaUTS' => $request->input('BiayaUTS'),
            'BayarUAS' => $request->input('BayarUAS'),
            'WaktuBayarUAS' => $request->input('WaktuBayarUAS'),
            'BiayaUAS' => $request->input('BiayaUAS'),
            //author
            'LoginBuat' => $userKode,
            'TanggalBuat' => $waktu,
            //
            'NA'=> $request->input('NA'),
            '_StatusMhswID1' => $request->input('_StatusMhswID1'),
            '_StatusMhswID2' => $request->input('_StatusMhswID2'),
        ];
        //Insert Data ke dalam database
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
            'KodeID'=> 'required|exists:simak_trn_khs,KodeID',
            'ProgramID' => 'required|exists:simak_trn_khs,ProgramID',
            'ProdiID' => 'required|numeric',
            //'TahunID' => 'required|numeric|unique:simak_trn_khs',
            //'MhswID'=> 'required|numeric|unique:simak_trn_khs',
            'StatusMhswID' => 'required|exists:simak_trn_khs,StatusMhswID',
            'Sesi'=> 'required|numeric',
            'MaxSKS' => 'required|numeric',
            'SKSK'=> 'required|numeric',
            'SKS'=> 'required|numeric',
            'IPS'=> 'required',
            'IPT'=> 'required',
            'IPA' => 'required',
            'JumlahMK' => 'required|numeric',
            'TotalSKS' => 'required|numeric',
            'RataanPresensi' => 'required',
            'MKPresensi' => 'required|numeric',
            'RataanUTS' => 'required',
            'MKUTS' => 'required|numeric',
            'MKUAS' => 'required|numeric',
            'IP' => 'required',
            'BIPOTID' => 'required|numeric',
            'SaldoAwal' => 'required|numeric',
            'Biaya' => 'required|numeric',
            'Potongan' => 'required|numeric',
            'Bayar' => 'required|numeric',
            'Tarik' => 'required|numeric',
            'JumlahLain' => 'required|numeric',
            'StatusDPP' => 'required|numeric',
            'CetakKRS' => 'required|numeric',
            'Cetak' => 'required|in:Y,N',
            'KaliCetak' => 'required|numeric',
            'Tutup' => 'required|in:Y,N',
            'Autodebet' => 'required|numeric',
            'Blok' => 'required',
            'KeteranganBlok' => 'required',
            'NoSurat' => 'required',
            'TglSurat' => 'required|date',
            'Keterangan' => 'required',
            'Finger' => 'required|in:Y,N',
            'TA' => 'required|in:Y,N',
            '0SKS' => 'required|in:0,15,25,30,50,100',
            'BayarUTS' => 'required|in:Y,N',
            'WaktuBayarUTS' => 'required|date',
            'BiayaUTS' => 'required|numeric',
            'BayarUAS' => 'required|in:Y,N',
            'WaktuBayarUAS' => 'required|date',
            'BiayaUAS' => 'required|numeric',
            //
            'NA'=> 'required|in:Y,N',
            '_StatusMhswID1' => 'required|in:Y,N',
            '_StatusMhswID2' => 'required|in:Y,N',
        ]);
        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');

        $data = [
            'KodeID' => $request->input('KodeID'),
            'ProgramID' => $request->input('ProgramID'),
            'ProdiID' => $request->input('ProdiID'),
            //'TahunID' => $request->input('TahunID'),
            //'MhswID' => $request->input('MhswID'),
            'StatusMhswID' => $request->input('StatusMhswID'),
            'Sesi' => $request->input('Sesi'),
            'MaxSKS' => $request->input('MaxSKS'),
            'SKSK' => $request->input('SKSK'),
            'SKS' => $request->input('SKS'),
            'IPS' => $request->input('IPS'),
            'IPT' => $request->input('IPT'),
            'IPA' => $request->input('IPA'),
            'JumlahMK' => $request->input('JumlahMK'),
            'TotalSKS' => $request->input('TotalSKS'),
            'RataanPresensi' => $request->input('RataanPresensi'),
            'MKPresensi' => $request->input('MKPresensi'),
            'RataanUTS' => $request->input('RataanUTS'),
            'MKUTS' => $request->input('MKUTS'),
            'MKUAS' => $request->input('MKUAS'),
            'IP' => $request->input('IP'),
            'BIPOTID' => $request->input('BIPOTID'),
            'SaldoAwal' => $request->input('SaldoAwal'),
            'Biaya' => $request->input('Biaya'),
            'Potongan' => $request->input('Potongan'),
            'Bayar' => $request->input('Bayar'),
            'Tarik' => $request->input('Tarik'),
            'JumlahLain' => $request->input('JumlahLain'),
            'StatusDPP' => $request->input('StatusDPP'),
            'CetakKRS' => $request->input('CetakKRS'),
            'Cetak' => $request->input('Cetak'),
            'KaliCetak' => $request->input('KaliCetak'),
            'Tutup' => $request->input('Tutup'),
            'Autodebet' => $request->input('Autodebet'),
            'Blok' => $request->input('Blok'),
            'KeteranganBlok' => $request->input('KeteranganBlok'),
            'NoSurat' => $request->input('NoSurat'),
            'TglSurat' => $request->input('TglSurat'),
            'Keterangan' => $request->input('Keterangan'),
            'Finger' => $request->input('Finger'),
            'TA' => $request->input('TA'),
            '0SKS' => $request->input('0SKS'),
            'BayarUTS' => $request->input('BayarUTS'),
            'WaktuBayarUTS' => $request->input('WaktuBayarUTS'),
            'BiayaUTS' => $request->input('BiayaUTS'),
            'BayarUAS' => $request->input('BayarUAS'),
            'WaktuBayarUAS' => $request->input('WaktuBayarUAS'),
            'BiayaUAS' => $request->input('BiayaUAS'),
            //author
            'LoginEdit' => $userKode,
            'TanggalEdit' => $waktu,
            //
            'NA'=> $request->input('NA'),
            '_StatusMhswID1' => $request->input('_StatusMhswID1'),
            '_StatusMhswID2' => $request->input('_StatusMhswID2'),
        ];
        //Update Data
        $table = $this->_namaTabel->getTable();
        $kolom = $this->_kolom;
        $this->$id=$id;
        $results = parent::update($table,$kolom,$id,$data);
        return $results;  
    }

   
}
