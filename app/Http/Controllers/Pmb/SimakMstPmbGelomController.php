<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\SITUController; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Pmb\SimakMstPmbGelombang;

class SimakMstPmbGelomController extends SITUController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function getPMBGelombang()
    {
        $data = SimakMstPmbGelombang::all();       
        
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
        $data = SimakMstPmbGelombang::where('PMBPeriodID', $id)->first();     
           
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
    public function createGelombang(Request $request)
    {
        //Validasi data berdasarkan request # 12
        $this->validate($request,[
            'KodeID' => 'required',
            'Nama' => 'required',
            'TglMulai' => 'required',
            'TglSelesai' => 'required', 
            'WaktuSelesaiOnline' => 'required',
            'UjianMulai' => 'required',
            'JamUjianMulai' => 'required',
            'JamUjianSelesai' => 'required',
            'PengumumanMulai' => 'required',
            'PengumumanSelesai' => 'required',
            'BayarMulai' => 'required',
            'BayarSelesai' => 'required',
            'TelitiBayarProdi' => 'required',
            'NA' => 'required',
            'LoginBuat' => 'required',
            'LoginEdit' => 'required',
            'NomorPengumuman' => 'required',
            'NomorSuket' => 'required'
        ]);
        //Insert Data
        $data = SimakMstPmbGelombang::create($request->all());
        if (!$data) {
            return response([
                'status' => false,
                'message' => 'Data gagal ditambahkan',
              ], 404);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'data baru berhasil ditambahkan',
                ], 200);
            
        }
    }
    public function updatePMBGelombang(Request $request,$id)
    {
        //  return response()->json($request);
        //Update Data
        $data = SimakMstPmbGelombang::where('PMBPeriodID',$id)->update($request->all());
        
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
}
