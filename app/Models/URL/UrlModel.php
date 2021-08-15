<?php

namespace App\Models\URL;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class UrlModel extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'ws_mst_endpoint';
    protected $primaryKey = 'kode';
    //public $timestamps = false;
    //const CREATED_AT = 'waktu_login';
    // const UPDATED_AT = 'TanggalEdit';
   
    protected $fillable = [
        'kode',
        'endpoint',
        'verb',
        'jenis',
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
