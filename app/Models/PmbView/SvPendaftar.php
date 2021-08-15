<?php

namespace App\Models\PmbView;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SvPendaftar extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sv_pendaftar';
    protected $primaryKey = 'PMBFormJualID';
    //public $timestamps = false;
    //const CREATED_AT = 'WaktuBuat';
    // const UPDATED_AT = 'TanggalEdit';
   
    protected $fillable = [
        'PMBFormJualID',
        'PMBPeriodID',
        'PMBFormulirID',
        'PMBID',
        'Login',
        'Password',
        'pwd',
        'KDPIN',
        'KodeID',
        'Nama',
        'LevelID',
        'ProdiID',
        'TempatLahir',
        'TanggalLahir',
        'AgamaID',
        'KelaminID',
        'Telephone',
        'Handphone',
        'Email',
        'Alamat',
        'Kota',
        'Propinsi',
        'Negara',
        'Foto',
        'LoginBuat',
        'WaktuBuat',
        'LoginEdit',
        'WaktuEdit',
        'NA',
        
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
