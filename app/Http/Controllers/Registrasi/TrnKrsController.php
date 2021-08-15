<?php

namespace App\Http\Controllers\Registrasi;
use App\Http\Controllers\SITUController; 
use Illuminate\Http\Request;
use App\Models\Registrasi\SimakTrnKrs;
use App\Models\User;
use Carbon\Carbon;
class TrnKrsController extends SITUController
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
       $this->_namaTabel = new SimakTrnKrs;
       $this->_kolom = 'KRSID';
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
            'KRSID' => 'required|unique:simak_trn_krs',
            'KHSID' => 'required|exists:simak_trn_krs,KHSID',
            'MhswID' => 'required|exists:simak_trn_krs,MhswID',
            'TahunID' => 'required|exists:simak_trn_krs,TahunID',
            'JadwalID' => 'required|exists:simak_trn_krs,JadwalID',
            'MKID' => 'required|exists:simak_trn_krs,MKID',
            'MKKode' => 'required|exists:simak_trn_krs,MKKode',
            'SKS' => 'required|numeric',
            'HargaStandar' => 'required|in:Y,N',
            'Harga' => 'required|numeric',
            'Bayar' => 'required',
            'TanggalBayar' => 'required|date',
            'Tugas1' => 'required|numeric',
            'Tugas2' => 'required|numeric',
            'Tugas3' => 'required|numeric',
            'Tugas4' => 'required|numeric',
            'Tugas5' => 'required|numeric',
            'Presensi' => 'required|numeric',
            '_Presensi' => 'required|numeric',
            'UTS' => 'required|numeric',
            'UAS' => 'required|numeric',
            'Responsi' => 'required|numeric',
            'NilaiAkhir' => 'required|numeric',
            'GradeNilai' => 'required|in:A,B,C,D,E',
            'BobotNilai' => 'required|numeric',
            'IndeksUTS' => 'required|numeric',
            'IndeksUAS' => 'required|numeric',
            'StatusKRSID' => 'required',
            'Tinggi' => 'required',
            'Final' => 'required|in:Y,N',
            'Setara' => 'required|in:Y,N',
            'SetaraKode' => 'required',
            'SetaraGrade' => 'required',
            'SetaraNama' => 'required',
            'Dispensasi' => 'required|in:Y,N',
            'DispensasiOleh' => 'required',
            'TanggalDispensasi' => 'required|date',
            'CatatanDispensasi' => 'required',
            'Catatan' => 'required',
            'CatatanError' => 'required',
            'RuangID' => 'required',
            //
            'NA' => 'required|in:Y,N',
            'Kelas' => 'required',
            'KM' => 'required|in:Y,N',
            'RuangID_UTS' => 'required|numeric',
            'No_Urut_UTS' => 'required|numeric',
            'Waktu_Hadir_UTS' => 'required|date_format:Y-m-d H:i:s',
            'RuangID_UAS' => 'required',
            'No_Urut_UAS' => 'required|numeric',
            'Waktu_Hadir_UAS' => 'required|date_format:Y-m-d H:i:s',
            'Validasi' => 'required|in:Y,N',
            'Kwitansi' => 'required|in:Y,N',
            'MKPraktikum' => 'required|in:Y,N',
        ]);
        
        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');

        $data = [
            'KRSID' => $request->input('KRSID'),
            'KHSID' => $request->input('KHSID'),
            'MhswID' => $request->input('MhswID'),
            'TahunID' => $request->input('TahunID'),
            'JadwalID' => $request->input('JadwalID'),
            'MKID' => $request->input('MKID'),
            'MKKode' => $request->input('MKKode'),
            'SKS' => $request->input('SKS'),
            'HargaStandar' => $request->input('HargaStandar'),
            'Harga' => $request->input('Harga'),
            'Bayar' => $request->input('Bayar'),
            'TanggalBayar' => $request->input('TanggalBayar'),
            'Tugas1' => $request->input('Tugas1'),
            'Tugas2' => $request->input('Tugas2'),
            'Tugas3' => $request->input('Tugas3'),
            'Tugas4' => $request->input('Tugas4'),
            'Tugas5' => $request->input('Tugas5'),
            'Presensi' => $request->input('Presensi'),
            '_Presensi' => $request->input('_Presensi'),
            'UTS' => $request->input('UTS'),
            'UAS' => $request->input('UAS'),
            'Responsi' => $request->input('Responsi'),
            'NilaiAkhir' => $request->input('NilaiAkhir'),
            'GradeNilai' => $request->input('NilaiAkhir'),
            'BobotNilai' => $request->input('BobotNilai'),
            'IndeksUTS' => $request->input('IndeksUTS'),
            'IndeksUAS' => $request->input('IndeksUAS'),
            'StatusKRSID' => $request->input('StatusKRSID'),
            'Tinggi' => $request->input('Tinggi'),
            'Final' => $request->input('Final'),
            'Setara' => $request->input('Setara'),
            'SetaraKode' => $request->input('SetaraKode'),
            'SetaraGrade' => $request->input('SetaraGrade'),
            'SetaraNama' => $request->input('SetaraNama'),
            'Dispensasi' => $request->input('Dispensasi'),
            'DispensasiOleh' => $request->input('DispensasiOleh'),
            'TanggalDispensasi' => $request->input('TanggalDispensasi'),
            'CatatanDispensasi' => $request->input('CatatanDispensasi'),
            'Catatan' => $request->input('Catatan'),
            'CatatanError' => $request->input('CatatanError'),
            'RuangID' => $request->input('RuangID'),
           
            //author
            'LoginBuat' => $userKode,
            'TanggalBuat' => $waktu,
            //
             //
            'NA' =>  $request->input('NA'),
            'Kelas' =>  $request->input('Kelas'),
            'KM' =>  $request->input('KM'),
            'RuangID_UTS' =>  $request->input('RuangID_UTS'),
            'No_Urut_UTS' =>  $request->input('No_Urut_UTS'),
            'Waktu_Hadir_UTS' =>  $request->input('Waktu_Hadir_UTS'),
            'RuangID_UAS' =>  $request->input('RuangID_UAS'),
            'No_Urut_UAS' =>  $request->input('No_Urut_UAS'),
            'Waktu_Hadir_UAS' =>  $request->input('Waktu_Hadir_UAS'),
            'Validasi' =>  $request->input('Validasi'),
            'Kwitansi' =>  $request->input('Kwitansi'),
            'MKPraktikum' =>  $request->input('MKPraktikum'),
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
            'KHSID' => 'exists:simak_trn_krs,KHSID',
            'MhswID' => 'exists:simak_trn_krs,MhswID',
            'TahunID' => 'exists:simak_trn_krs,TahunID',
            'JadwalID' => 'exists:simak_trn_krs,JadwalID',
            'MKID' => 'exists:simak_trn_krs,MKID',
            'MKKode' => 'exists:simak_trn_krs,MKKode',
            'SKS' => 'numeric',
            'HargaStandar' => 'in:Y,N',
            'Harga' => 'numeric',
            //'Bayar' => 'required',
            'TanggalBayar' => 'date',
            'Tugas1' => 'numeric',
            'Tugas2' => 'numeric',
            'Tugas3' => 'numeric',
            'Tugas4' => 'numeric',
            'Tugas5' => 'numeric',
            'Presensi' => 'numeric',
            '_Presensi' => 'numeric',
            'UTS' => 'numeric',
            'UAS' => 'numeric',
            'Responsi' => 'numeric',
            'NilaiAkhir' => 'numeric',
            'GradeNilai' => 'in:A,B,C,D,E',
            'BobotNilai' => 'numeric',
            'IndeksUTS' => 'numeric',
            'IndeksUAS' => 'numeric',
            //'StatusKRSID' => 'required',
            //'Tinggi' => 'required',
            'Final' => 'in:Y,N',
            'Setara' => 'in:Y,N',
            //'SetaraKode' => 'required',
            //'SetaraGrade' => 'required',
            //'SetaraNama' => 'required',
            'Dispensasi' => 'in:Y,N',
            //'DispensasiOleh' => 'required',
            'TanggalDispensasi' => 'date',
            //'CatatanDispensasi' => 'required',
            // 'Catatan' => 'required',
            // 'CatatanError' => 'required',
            // 'RuangID' => 'required',
            //
            'NA' => 'in:Y,N',
            //'Kelas' => 'required',
            'KM' => 'in:Y,N',
            'RuangID_UTS' => 'numeric',
            'No_Urut_UTS' => 'numeric',
            'Waktu_Hadir_UTS' => 'date_format:Y-m-d H:i:s',
            //'RuangID_UAS' => 'required',
            'No_Urut_UAS' => 'numeric',
            'Waktu_Hadir_UAS' => 'date_format:Y-m-d H:i:s',
            'Validasi' => 'in:Y,N',
            'Kwitansi' => 'in:Y,N',
            'MKPraktikum' => 'in:Y,N',
        ]);
        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');

        $data = [
            'KHSID' => $request->input('KHSID'),
            'MhswID' => $request->input('MhswID'),
            'TahunID' => $request->input('TahunID'),
            'JadwalID' => $request->input('JadwalID'),
            'MKID' => $request->input('MKID'),
            'MKKode' => $request->input('MKKode'),
            'SKS' => $request->input('SKS'),
            'HargaStandar' => $request->input('HargaStandar'),
            'Harga' => $request->input('Harga'),
            'Bayar' => $request->input('Bayar'),
            'TanggalBayar' => $request->input('TanggalBayar'),
            'Tugas1' => $request->input('Tugas1'),
            'Tugas2' => $request->input('Tugas2'),
            'Tugas3' => $request->input('Tugas3'),
            'Tugas4' => $request->input('Tugas4'),
            'Tugas5' => $request->input('Tugas5'),
            'Presensi' => $request->input('Presensi'),
            '_Presensi' => $request->input('_Presensi'),
            'UTS' => $request->input('UTS'),
            'UAS' => $request->input('UAS'),
            'Responsi' => $request->input('Responsi'),
            'NilaiAkhir' => $request->input('NilaiAkhir'),
            'GradeNilai' => $request->input('NilaiAkhir'),
            'BobotNilai' => $request->input('BobotNilai'),
            'IndeksUTS' => $request->input('IndeksUTS'),
            'IndeksUAS' => $request->input('IndeksUAS'),
            'StatusKRSID' => $request->input('StatusKRSID'),
            'Tinggi' => $request->input('Tinggi'),
            'Final' => $request->input('Final'),
            'Setara' => $request->input('Setara'),
            'SetaraKode' => $request->input('SetaraKode'),
            'SetaraGrade' => $request->input('SetaraGrade'),
            'SetaraNama' => $request->input('SetaraNama'),
            'Dispensasi' => $request->input('Dispensasi'),
            'DispensasiOleh' => $request->input('DispensasiOleh'),
            'TanggalDispensasi' => $request->input('TanggalDispensasi'),
            'CatatanDispensasi' => $request->input('CatatanDispensasi'),
            'Catatan' => $request->input('Catatan'),
            'CatatanError' => $request->input('CatatanError'),
            'RuangID' => $request->input('RuangID'),
           
            //author
            'LoginEdit' => $userKode,
            'TanggalEdit' => $waktu,
            //
             //
            'NA' =>  $request->input('NA'),
            'Kelas' =>  $request->input('Kelas'),
            'KM' =>  $request->input('KM'),
            'RuangID_UTS' =>  $request->input('RuangID_UTS'),
            'No_Urut_UTS' =>  $request->input('No_Urut_UTS'),
            'Waktu_Hadir_UTS' =>  $request->input('Waktu_Hadir_UTS'),
            'RuangID_UAS' =>  $request->input('RuangID_UAS'),
            'No_Urut_UAS' =>  $request->input('No_Urut_UAS'),
            'Waktu_Hadir_UAS' =>  $request->input('Waktu_Hadir_UAS'),
            'Validasi' =>  $request->input('Validasi'),
            'Kwitansi' =>  $request->input('Kwitansi'),
            'MKPraktikum' =>  $request->input('MKPraktikum'),
        ];
        //Update Data
        $table = $this->_namaTabel->getTable();
        $kolom = $this->_kolom;
        $this->$id=$id;
        $results = parent::update($table,$kolom,$id,$data);
        return $results;  
    }

   
}
