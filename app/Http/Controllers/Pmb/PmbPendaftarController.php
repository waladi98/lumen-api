<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Pmb\SimakMstPmbPendaftar;

class PmbPendaftarController extends SITUController
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
       $this->_namaTabel = new SimakMstPmbPendaftar;
       $this->_kolom = 'kode';
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
                'message' => 'data not found',
                'data' => ''
            ], 404);
        }          
    }
    //tambah data  baru
    public function createData(Request $request)
    {
        //Validasi data berdasarkan request # 12
        $this->validate($request,[
            'kode'  => 'required|unique:simak_mst_pmb_pendaftar',
            'kode_pmb_gelombang' => 'required',
            'id_siswa' => 'required|unique:simak_mst_pmb_pendaftar',
            'npsn' => 'required',
            'nama_siswa' => 'required',
            'kode_prodi' => 'required',
            'id_kategori_pendaftar' => 'required',
            'id_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat_lengkap' => 'required',
            'email' => 'required|email',
            'no_tlp' => 'required',
            'nama_orangtua' => 'required',
            'id_pekerjaan_ortu' => 'required',
            'penghasilan' => 'required',
            'alamat_orangtua' => 'required',
            'no_tlp_orangtua' => 'required',
            'asal_sekolah' => 'required',
            'jurusan' => 'required',
            'guru_pendaftar' => 'required',
            'dok_1' => 'required',
            'dok_2' => 'required',
            'dok_3' => 'required',
            'dok_4' => 'required',
            'dok_5' => 'required',
            'dok_6' => 'required',
            'id_status_konfirmasi' => 'required',
            'status' => 'required',
            'tgl_diterima' => 'required|date',
        ]);
    
        

        
        $data = [
            'kode' => $request->input('kode'),
            'kode_pmb_gelombang' => $request->input('kode_pmb_gelombang'),
            'id_siswa' => $request->input('id_siswa'),
            'npsn' => $request->input('npsn'),
            'nama_siswa' => $request->input('nama_siswa'),
            'kode_prodi' => $request->input('kode_prodi'),
            'id_kategori_pendaftar' => $request->input('id_kategori_pendaftar'),
            'id_kelamin' => $request->input('id_kelamin'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'alamat_lengkap' => $request->input('alamat_lengkap'),
            'email' => $request->input('email'),
            'no_tlp' => $request->input('no_tlp'),
            'nama_orangtua' => $request->input('nama_orangtua'),
            'id_pekerjaan_ortu' => $request->input('id_pekerjaan_ortu'),
            'penghasilan' => $request->input('penghasilan'),
            'alamat_orangtua' => $request->input('alamat_orangtua'),
            'no_tlp_orangtua' => $request->input('no_tlp_orangtua'),
            'asal_sekolah' =>  $request->input('asal_sekolah'),
            'jurusan' => $request->input('jurusan'),
            'guru_pendaftar' => $request->input('guru_pendaftar'),
            'dok_1' => $request->input('dok_1'),
            'dok_2' => $request->input('dok_2'),
            'dok_3' => $request->input('dok_3'),
            'dok_4' => $request->input('dok_4'),
            'dok_5' => $request->input('dok_5'),
            'dok_6' => $request->input('dok_6'),
            'id_status_konfirmasi' => $request->input('id_status_konfirmasi'),
            'status' => $request->input('status'),
            'tgl_diterima' => $request->input('tgl_diterima'),
        ];

        // dd($data);
        // die();

        $tambahData = SimakMstPmbPendaftar::create($data);
        return response([
            'status' => false,
            'message' => $tambahData,
            'data' => ''
        ], 404);
        //Insert Data
        // $namaTable= new SimakMstPmbPendaftar;
        // $table = $namaTable->getTable();
        // $results = parent::create($table,$data);
        // if ($results) {
        //     return $results;   
        // } else {
        //     return response([
        //         'status' => false,
        //         'message' => 'data not found',
        //         'data' => ''
        //     ], 404);
        // } 
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
        //Update Data
        $table = $this->_namaTabel->getTable();
        $kolom = $this->_kolom;
        $this->$id=$id;
        $data = $request->all(); 
        $data = parent::update($table,$kolom,$id,$data);
        return $data;    
    }

   
}
