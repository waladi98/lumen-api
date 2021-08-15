<?php

namespace App\Http\Controllers\PmbView;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\PmbView\SvPmbSekolahBelumAda;

class SVPmbSekolahBelumAdaController extends SITUController
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
       $this->_namaTabel = new SvPmbSekolahBelumAda;
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
         
         //Validasi data 
         $this->validate($request,[
             'npsn' => 'required|unique:sv_pmb_sekolah_belum_ada',
             'nama_sekolah' => 'required',
             'alamat_sekolah' => 'required',
             'desa_kel' => 'required',
             //'kec' => 'required', 
             'kab_kota' => 'required',
             'provinsi' => 'required',
             'email' => 'required|email:rfc,dns',
             'no_telepon' => 'required',
             'id_guru' => 'required',
             //'id_status_konfirmasi' => 'required|numeric',
             //'STATUS' => 'required',
         ]);
         
         $data = [
             'npsn' => $request->input('npsn'),
             'nama_sekolah' => $request->input('nama_sekolah'),
             'alamat_sekolah' => $request->input('alamat_sekolah'),
             'desa_kel' => $request->input('desa_kel'),
            //'kec' => $request->input('kec'),
             'kab_kota' => $request->input('kab_kota'),
             'provinsi' => $request->input('provinsi'),
             'email' => $request->input('email'),
             'no_telepon' => $request->input('no_telepon'),
             'id_guru' => $request->input('id_guru'),
             //'id_status_konfirmasi' => $request->input('id_status_konfirmasi'),
             //'STATUS' => $request->input('STATUS'),
         ];
         //Insert Data
         $namaTable = new SvPmbSekolahBelumAda;
         $table = $namaTable->getTable();
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
             'PMBRef' => 'required',
             'PMBFormulirID' => 'required|exists:simak_trn_pmb,PMBFormulirID',
             'PMBPeriodID' => 'required|exists:simak_trn_pmb,PMBPeriodID',
             'PMBFormJualID' => 'required|exists:simak_trn_pmb,PMBFormJualID', 
             'PSSBID' => 'required|exists:simak_trn_pmb,PSSBID',
             // 'BuktiSetoran' => 'required',
             'NIM' => 'numeric|exists:simak_trn_pmb,NIM',
             'KodeID' => 'required|exists:simak_trn_pmb,KodeID',
             'BIPOTID' => 'required',
             'Nama' => 'required',
             'StatusAwalID' => 'required|exists:simak_trn_pmb,StatusAwalID',
             'StatusMundur' => 'required',
             // 'MhswPindahanID' => 'required',
             'ProgramID' => 'required',
             'ProdiID' => 'required',
             'Kelamin' => 'required',
             'WargaNegara' => 'required',
             'Kebangsaan'=> 'required',
             'TempatLahir' => 'required',
             'TanggalLahir' => 'required|date',
             'Agama' => 'required',
             'StatusSipil' => 'required',
             'Alamat' => 'required',
             'Kota' => 'required',
             'RT' => 'required',
             'RW'=> 'required',
             'KodePos' => 'required',
             'Propinsi' => 'required',
             'Negara' => 'required',
             'Telepon' => 'required',
             'Handphone' => 'required',
             'Email' => 'required|email',
             'AlamatAsal' => 'required',
             'KotaAsal' => 'required',
             'RTAsal' => 'required',
             'RWAsal' => 'required',
             'KodePosAsal' => 'required',
             'PropinsiAsal' => 'required',
             'NegaraAsal' => 'required',
             'TeleponAsal' => 'required',
             'NamaAyah' => 'required',
             'AgamaAyah' => 'required',
             'PendidikanAyah' => 'required',
             'PekerjaanAyah' => 'required',
             'HidupAyah' => 'required',
             'NamaIbu' => 'required',
             'AgamaIbu' => 'required',
             'PendidikanIbu' => 'required',
             'PekerjaanIbu' => 'required',
             'HidupIbu' => 'required',
             'AlamatOrtu' => 'required',
             'KotaOrtu' => 'required',
             'RTOrtu' => 'required',
             'RWOrtu' => 'required',
             'KodePosOrtu' => 'required',
             'PropinsiOrtu' => 'required',
             'NegaraOrtu' => 'required',
             'TeleponOrtu' => 'required',
             'HandphoneOrtu' => 'required',
             'EmailOrtu' => 'required|email',
             'AsalSekolah' => 'required',
             'JenisSekolahID' => 'required',
             'AlamatSekolah' => 'required',
             'KotaSekolah' => 'required',
             'JurusanSekolah' => 'required',
             'NilaiSekolah' => 'required|numeric',
             'TahunLulus' => 'required',
             'AsalPT' => 'required',
             'ProdiAsalPT' => 'required',
             'LulusAsalPT' => 'required',
             'TglLulusAsalPT' => 'required|date',
             'Pilihan1' => 'required|numeric',
             'Pilihan2' => 'required|numeric',
             'Pilihan3' => 'required|numeric',
             'Harga' => 'required|numeric',
             'SudahBayar' => 'required|in:N,R,Y',
             'NA' => 'required|in:N,Y',
             'IkutUjian' => 'required|in:N,Y',
             // 'TanggalUjian' => 'required',
             'LulusUjian' => 'required|in:N,Y',
             'RuangID'=> 'required',
             // 'NomerUjian' => 'required',
             'NilaiUjian' => 'numeric',
             // 'DetailNilai' => 'required',
             // 'GradeNilai' => 'required',
             // 'Catatan' => 'required',
             // 'NomerSurat' => 'required',
             // 'Syarat' => 'required',
             'SyaratLengkap'=> 'in:N,Y',
             // 'BuktiSetoranMhsw' => 'required',
             'TanggalSetoranMhsw' => 'date',
             'TotalBiayaMhsw' => 'numeric',
             'TotalSetoranMhsw' => 'numeric',
             'Dispensasi' => 'in:N,Y',
             // 'DispensasiID' => 'required',
             // 'JudulDispensasi' => 'required',
             // 'CatatanDispensasi' => 'required',
             'OPMBID' => 'numeric',
             'KelompokOPMB' => 'numeric',
             //waktu
             // 'LoginBuat',
             // 'TanggalBuat',
             // 'LoginEdit',
             // 'TanggalEdit',
             // '_nim' => 'required',
                 //waktu
         ]);
         //data user pembuat
         $waktu = Carbon::now();
         $userKode = $request->header('username');
 
         $data = [
             'PMBRef' => $request->input('PMBRef'),
             'PMBFormulirID' => $request->input('PMBFormulirID'),
             'PMBPeriodID' => $request->input('PMBPeriodID'),
             'PMBFormJualID' => $request->input('PMBFormJualID'),
             'PSSBID' => $request->input('PSSBID'),
             'BuktiSetoran' => $request->input('BuktiSetoran'),
             'NIM' => $request->input('NIM'),
             'KodeID' => $request->input('KodeID'),
             'BIPOTID' => $request->input('BIPOTID'),
             'Nama' => $request->input('Nama'),
             'StatusAwalID' => $request->input('StatusAwalID'),
             'StatusMundur' => $request->input('StatusMundur'),
             'MhswPindahanID' => $request->input('MhswPindahanID'),
             'ProgramID' => $request->input('ProgramID'),
             'ProdiID' => $request->input('ProdiID'),
             'Kelamin' => $request->input('Kelamin'),
             'WargaNegara' =>$request->input('WargaNegara'),
             'Kebangsaan'=> $request->input('Kebangsaan'),
             'TempatLahir' => $request->input('TempatLahir'),
             'TanggalLahir' => $request->input('TanggalLahir'),
             'Agama' => $request->input('Agama'),
             'StatusSipil' => $request->input('StatusSipil'),
             'Alamat' => $request->input('Alamat'),
             'Kota' => $request->input('Kota'),
             'RT' => $request->input('RT'),
             'RW'=> $request->input('RW'),
             'KodePos' => $request->input('KodePos'),
             'Propinsi' => $request->input('Propinsi'),
             'Negara' => $request->input('Negara'),
             'Telepon' => $request->input('Telepon'),
             'Handphone' => $request->input('Handphone'),
             'Email' => $request->input('Email'),
             'AlamatAsal' => $request->input('AlamatAsal'),
             'KotaAsal' => $request->input('KotaAsal'),
             'RTAsal' => $request->input('RTAsal'),
             'RWAsal' => $request->input('RWAsal'),
             'KodePosAsal' => $request->input('KodePosAsal'),
             'PropinsiAsal' => $request->input('PropinsiAsal'),
             'NegaraAsal' => $request->input('NegaraAsal'),
             'TeleponAsal' => $request->input('TeleponAsal'),
             'NamaAyah' => $request->input('NamaAyah'),
             'AgamaAyah' => $request->input('AgamaAyah'),
             'PendidikanAyah' => $request->input('PendidikanAyah'),
             'PekerjaanAyah' => $request->input('PekerjaanAyah'),
             'HidupAyah' => $request->input('HidupAyah'),
             'NamaIbu' => $request->input('NamaIbu'),
             'AgamaIbu' => $request->input('AgamaIbu'),
             'PendidikanIbu' => $request->input('PendidikanIbu'),
             'PekerjaanIbu' => $request->input('PekerjaanIbu'),
             'HidupIbu' => $request->input('HidupIbu'),
             'AlamatOrtu' => $request->input('AlamatOrtu'),
             'KotaOrtu' => $request->input('KotaOrtu'),
             'RTOrtu' => $request->input('RTOrtu'),
             'RWOrtu' => $request->input('RWOrtu'),
             'KodePosOrtu' => $request->input('KodePosOrtu'),
             'PropinsiOrtu' => $request->input('PropinsiOrtu'),
             'NegaraOrtu' => $request->input('NegaraOrtu'),
             'TeleponOrtu' => $request->input('TeleponOrtu'),
             'HandphoneOrtu' => $request->input('HandphoneOrtu'),
             'EmailOrtu' => $request->input('EmailOrtu'),
             'AsalSekolah' => $request->input('AsalSekolah'),
             'JenisSekolahID' => $request->input('JenisSekolahID'),
             'AlamatSekolah' => $request->input('AlamatSekolah'),
             'KotaSekolah' => $request->input('KotaSekolah'),
             'JurusanSekolah' => $request->input('JurusanSekolah'),
             'NilaiSekolah' => $request->input('NilaiSekolah'),
             'TahunLulus' => $request->input('TahunLulus'),
             'AsalPT' => $request->input('AsalPT'),
             'ProdiAsalPT' => $request->input('ProdiAsalPT'),
             'LulusAsalPT' => $request->input('LulusAsalPT'),
             'TglLulusAsalPT' => $request->input('TglLulusAsalPT'),
             'Pilihan1' => $request->input('Pilihan1'),
             'Pilihan2' => $request->input('Pilihan2'),
             'Pilihan3' => $request->input('Pilihan3'),
             'Harga' => $request->input('Harga'),
             'SudahBayar' => $request->input('SudahBayar'),
             'NA' => $request->input('NA'),
             'IkutUjian' => $request->input('IkutUjian'),
             'TanggalUjian' => $request->input('TanggalUjian'),
             'LulusUjian' => $request->input('LulusUjian'),
             'RuangID'=> $request->input('RuangID'),
             'NomerUjian' => $request->input('NomerUjian'),
             'NilaiUjian' => $request->input('NilaiUjian'),
             'DetailNilai' => $request->input('DetailNilai'),
             'GradeNilai' => $request->input('GradeNilai'),
             'Catatan' => $request->input('Catatan'),
             'NomerSurat' => $request->input('NomerSurat'),
             'Syarat' => $request->input('Syarat'),
             'SyaratLengkap'=> $request->input('SyaratLengkap'),
             'BuktiSetoranMhsw' => $request->input('BuktiSetoranMhsw'),
             'TanggalSetoranMhsw' => $request->input('TanggalSetoranMhsw'),
             'TotalBiayaMhsw' => $request->input('TotalBiayaMhsw'),
             'TotalSetoranMhsw' => $request->input('TotalSetoranMhsw'),
             'Dispensasi' => $request->input('Dispensasi'),
             'DispensasiID' => $request->input('DispensasiID'),
             'JudulDispensasi' => $request->input('JudulDispensasi'),
             'CatatanDispensasi' => $request->input('CatatanDispensasi'),
             'OPMBID' => $request->input('OPMBID'),
             'KelompokOPMB' => $request->input('KelompokOPMB'),
             '_nim' => $request->input('_nim'),
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
