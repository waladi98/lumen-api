<?php

namespace App\Models\Pmb;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SimakTrnPmbForm extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'simak_trn_pmb_formulir';
    protected $primaryKey = 'PMBFormJualID';
    //public $timestamps = false;
    // const CREATED_AT = 'TanggalBuat';
    // const UPDATED_AT = 'TanggalEdit';
   
    protected $fillable = [
        'PMBFormJualID',
        'PMBFormulirID',
        'KodeID',
        'Tanggal', 
        'PMBPeriodID',
        'BuktiSetoran',
        'Nama',
        //waktu
        'LoginBuat',
        'TanggalBuat',
        'LoginEdit',
        'TanggalEdit',
        //--------
        'Keterangan',
        'Jumlah',
        'CetakanKe',
        'NA',
        'Batal',
        'OK',

        
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
