<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Pmb\SimakTrnPmbPersyaratan;
use App\Models\User;
use Carbon\Carbon;

class TrnPmbPersyaratanController extends SITUController
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
       $this->_namaTabel = new SimakTrnPmbPersyaratan;
       $this->_kolom = 'PMBID';
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
            'PMBID' => 'required|numeric',
            'PMBSyaratID' => 'required|exists:simak_trn_pmb_persyaratan,PMBSyaratID',
            'Dokumen' => 'required|file|mimes:pdf|max:2048',
            'StatusID' => 'required | numeric',
            //17 atribut
        ]);
        
        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');

        //menyimpan data file yang diupload ke variabel $_FILES
        $file = $request->file('Dokumen');

        $namaFile = time()."_".$file->getClientOriginalName();

        //isi dengan nama folder tempat file diupload
        $tujuanUpload = 'pmbUpload';
        $file->move($tujuanUpload,$namaFile);

        $data = [
            'PMBID' => $request->input('PMBID'),
            'PMBSyaratID' => $request->input('PMBSyaratID'),
             'Dokumen' => $namaFile,
            // 'Dokumen' => url($tujuanUpload. '-' .$namaFile),
            'StatusID' => $request->input('StatusID'),
            //author
            'LoginBuat' => $userKode,
            'WaktuBuat' => $waktu
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
        $query = SimakTrnPmbPersyaratan::where('PMBID',$id)->first();
               
        //hapus data
        if ($query) {
            //menyimpan data file yang diupload ke variabel $_FILES
          
            //hapus file
            File::delete('pmbUpload/'.$query->Dokumen);
            $query->delete();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Menghapus Data',
                 'PMBID' => $id
                ], 201);
       } else {
           return response()->json([
               'success' => false,
               'message' => 'Data tidak ditemukan!',
               'Id data' => null
               ], 404);
       }
    }
    //edit Data
    public function editData(Request $request, $id)
    {
        //Validasi data berdasarkan request # 12
        $this->validate($request,[
            'PMBSyaratID' => 'required|exists:simak_trn_pmb_persyaratan,PMBSyaratID',
            'Dokumen' => 'required|file|mimes:pdf|max:2048',
            'StatusID' => 'required | numeric',
            //3 atribut
        ]);

        //data user pembuat
        $waktu = Carbon::now();
        $userKode = $request->header('username');

        //menyimpan data file yang diupload ke variabel $_FILES
        $file = $request->file('Dokumen');

        $namaFile = time()."_".$file->getClientOriginalName();

        //isi dengan nama folder tempat file diupload
        $tujuanUpload = 'pmbUpload';
        $file->move($tujuanUpload,$namaFile);

        $data = [
            'PMBSyaratID' => $request->input('PMBSyaratID'),
            'Dokumen' => $namaFile,
            // 'Dokumen' => url($tujuanUpload. '-' .$namaFile),
            'StatusID' => $request->input('StatusID'),
            //author
            'LoginUbah' => $userKode,
            'WaktuUbah' => $waktu
        ];
        //Update Data
        $query = SimakTrnPmbPersyaratan::where('PMBID',$id)->first();
               
        //hapus data
        if ($query) {
            File::delete('pmbUpload/'.$query->Dokumen);
            $query->update($data);
            //hapus file lama
            return response()->json([
                'success' => true,
                'message' => 'Update data succsess',
                'data' => $data
                ], 201);
       } else {
            return response()->json([
                'status' => false,
                'message' => 'update failed',
                'id' => 'ID tidak ditemukan'
            ], 404);
       }
    }

   
}
