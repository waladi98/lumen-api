<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Pmb\SimakMstPmbGuru;

class SimakMstPmbGuruController extends SITUController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }
    public function getPMBGuru()
    {
        $data = SimakMstPmbGuru::all();       
        
        if ($data != null) {
            return response()->json([
                'success' => true,
                'message' => 'succsess',
                'data' => $data 
                ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'data not found',
                'data' => ''
            ], 404);
        }        
    }

    public function getById($id)
    {
        $data = SimakMstPmbGuru::where('id_guru', $id)->first();     
           
        if (!$data){
            return response()->json([
                'success' => false,
                'message' => 'data not found',
                'data' => ''
                ], 404);
                    
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Success',
                'data' => $data
                ], 201);
                    
                
        }        
    }
    public function createGuru(Request $request)
    {
        //Validasi data berdasarkan request # 12
        $this->validate($request,[
            'nama_guru' => 'required',
            'no_tlp_guru' => 'required',
        ]);
        //Insert Data
        $data = SimakMstPmbGuru::create($request->all());
        if ($data ) {
            return response()->json([
                'success' => true,
                'message' => 'succsess',
                'result' => [
                    'data' => $data
                ]
                ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'data not found',
                'data' => ''
            ], 404);
        }
        return response()->json($kategori);
    }
    public function updatePMBGuru(Request $request, $id)
    {
        //Update Data
        $data = SimakMstPmbGuru::where('id_guru',$id)->update($request->all());
        
        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Update data succsess',
                ], 200);
        }else {
            return response([
                'status' => false,
                'message' => 'update failed',
                'data' => ''
            ], 404);
        }
    
    }

    public function deletePMBGuru($id)
    {
        //Hapus data berdasarkan ID
        $data = SimakMstPmbGuru::where('id_guru', $id)->delete();
        if (!$data) {
            return response([
                'status' => false,
                'message' => 'hapus data Gagal',
                'data' => ''
            ], 404);
        }else {
            return response()->json([
                'success' => true,
                'message' => 'hapus data succsess',
                ], 200);
            
        }
    
    }
}
