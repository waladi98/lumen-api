<?php

namespace App\Models\Pmb;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SimakMstPmbGelombang extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'simak_mst_pmb_gelombang';
    protected $primaryKey = 'PMBPeriodID';
    //public $timestamps = false;
    const CREATED_AT = 'TanggalBuat';
    const UPDATED_AT = 'TanggalEdit'; 
    protected $fillable = [
        'KodeID',
        'Nama',
        'TglMulai', 
        'TglSelesai',
        'WaktuSelesaiOnline',
        'UjianMulai',
        'JamUjianMulai',
        'JamUjianSelesai',
        'PengumumanMulai',
        'PengumumanSelesai',
        'BayarMulai',
        'BayarSelesai',
        'TelitiBayarProdi',
        'NA',
        'LoginBuat',
        'LoginEdit',
        'NomorPengumuman',
        'NomorSuket'
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
