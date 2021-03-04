<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class modelMahasiswa extends Model
{
    //akses tabel
    protected $table = 'simak_mst_mahasiswa';
    protected $fillable = [
        'pelanggan', 
        'alamat',
        'telp'
    ];

}
