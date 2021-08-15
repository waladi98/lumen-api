<?php

namespace App\Models\PmbView;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SvFormJualOnlineAktif extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sv_pmb_formulir_jual_online_aktif';
    protected $primaryKey = 'PMBFormJualOLID';
    //public $timestamps = false;
    // const CREATED_AT = 'TanggalBuat';
    // const UPDATED_AT = 'TanggalEdit';
   
    protected $fillable = [
        'PMBFormJualOLID',
        'PMBPeriodID',
        'PMBFormulirID',
        'KodeID',
        'Nama',
        'Alamat',
        'Telepon',
        'TanggalLahir',
        'NamaIbu',
        'StatusBayar',
        'Jumlah',
        'BuktiSetoran',
        'IPAddress',
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
        'password',
    ];
}
