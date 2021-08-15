<?php

namespace App\Models\Pengguna;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class UserOtorisasi extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'ws_trn_otorisasi';
    protected $primaryKey = 'kode_pengguna';
    public $timestamps = false;
    //const CREATED_AT = 'waktu_login';
    // const UPDATED_AT = 'TanggalEdit';
   
    protected $fillable = [
        'kode_pengguna',
        'kode_klien',
        'waktu_login',
        'waktu_logout',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        // 'password',
    ];
}
