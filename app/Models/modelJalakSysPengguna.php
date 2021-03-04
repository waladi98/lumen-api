<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class modelJalakSysPengguna extends Model
{
    //akses tabel
    protected $table = 'jalak_sys_pengguna';
    protected $fillable = [
        'kode', 
        'nama',
        'sandi',
        'kelompok'
    ];
}
