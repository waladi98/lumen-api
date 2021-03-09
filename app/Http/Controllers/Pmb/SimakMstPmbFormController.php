<?php

namespace App\Http\Controllers\Pmb;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Std;
use Illuminate\Http\Request;
use App\Models\Pmb\SimakMstPmbFormulir;

class SimakMstPmbFormController extends Controller
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
    public function getPMBFormulir()
    {
        $data = SimakMstPmbFormulir::all();       
        
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
        $data = SimakMstPmbFormulir::where('PMBFormulirID', $id)->first();     
           
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
    // public function createFormulir(Request $request)
    // {
    //     //Validasi data berdasarkan request # 12
    //     $this->validate($request,[
    //         'PMBFormulirID' => 'required',
    //         'Nama' => 'required',
    //         'KodeID' => 'required',
    //         'JumlahPilihan' => 'required', 
    //         'Harga' => 'required',
    //         'HanyaProdi1' => 'required',
    //         'KecualiProdi1' => 'required',
    //         'HanyaProdi2' => 'required',
    //         'KecualiProdi2' => 'required',
    //         'HanyaProdi3' => 'required',
    //         'Keterangan' => 'required',
    //         'NA' => 'required',
    //         'LoginEdit' => 'required',
    //         'LoginBuat' => 'required',

    //     ]);
    //     //Insert Data
    //     $data = SimakMstPmbFormulir::create($request->all());
    //     if ($data ) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'succsess',
    //             'result' => [
    //                 'id' => $id,
    //                 'data' => $data
    //             ]
    //             ], 200);
    //     } else {
    //         return response([
    //             'status' => false,
    //             'message' => 'data not found',
    //             'data' => ''
    //         ], 404);
    //     }
    //     return response()->json($kategori);
    // }
    public function updatePMBFormulir(Request $request, $id)
    {
        //Update Data
        $data = SimakMstPmbFormulir::where('PMBFormulirID',$id)->update($request->all());
        
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
