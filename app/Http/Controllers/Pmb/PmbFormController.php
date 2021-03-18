<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pmb\SimakMstPmbFormulir;

class PmbFormController extends SITUController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function getData()
    {
        $namaTable= new SimakMstPmbFormulir;
        $table = $namaTable->getTable();
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
        
        $namaTable = new SimakMstPmbFormulir;
        $table = $namaTable->getTable();
        $kolom = 'PMBFormulirID';
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
        //Validasi data berdasarkan request # 12
        $this->validate($request,[
            'PMBFormulirID' => 'required',
            'Nama' => 'required',
            'KodeID' => 'required',
            'JumlahPilihan' => 'required', 
            'Harga' => 'required',
            'HanyaProdi1' => 'required',
            'KecualiProdi1' => 'required',
            'HanyaProdi2' => 'required',
            'KecualiProdi2' => 'required',
            'HanyaProdi3' => 'required',
            'KecualiProdi3' => 'required',
            'Keterangan' => 'required',
            'NA' => 'required'
        ]);
        $data = [
            'PMBFormulirID' => $request->input('PMBFormulirID'),
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
        ];
        //Insert Data
        $namaTable= new SimakMstPmbFormulir;
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
    public function deleteData($id)
    {
        //Hapus data berdasarkan ID
        $namaTable = new SimakMstPmbFormulir;
        $table = $namaTable->getTable();
        $kolom = 'PMBFormulirID';
        $this->$id=$id; 
        $data = parent::destroy($table,$kolom,$id);
        return $data;
    }
    
    public function editData(Request $request, $id)
    {
        //Update Data
        $namaTable = new SimakMstPmbFormulir;
        $table = $namaTable->getTable();
        $kolom = 'PMBFormulirID';
        $this->$id=$id;
        $data = $request->all(); 
        $data = parent::update($table,$kolom,$id,$data);
        return $data;    
    }
}
