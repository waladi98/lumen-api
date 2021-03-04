<?php

namespace App\Http\Controllers\Pmb;

use App\Models\modelMahasiswa;
use Illuminate\Http\Request;

class mahasiswaController 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //untuk memanggil semua data mahasiswa
     //$data = modelMahasiswa::all();
    // Urutkan dulu berdasarkan kolom yang dipilih, dari ascending/descending. Lalu ambil 10 row teratas dimulai dari row ke-5 teratas.
       $data = modelMahasiswa::orderBy('MhswID', 'asc')->skip(1)->take(100)->get();
   
       return response()->json($data);
    }

    public function login()
    {
    //untuk memanggil semua data mahasiswa
     //$data = modelMahasiswa::all();
    // Urutkan dulu berdasarkan kolom yang dipilih, dari ascending/descending. Lalu ambil 10 row teratas dimulai dari row ke-5 teratas.
       $data = modelMahasiswa::orderBy('MhswID', 'asc')->skip(1)->take(100)->get();
   
       return response()->json($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //tampilkan satu data berdasarkan ID
         $data = modelMahasiswa::where('MhswID', $id)->get();
         return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return response()->json("update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return response()->json("delete");
    }
}
