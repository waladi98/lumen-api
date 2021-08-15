<?php

namespace App\Models\Pmb;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class RekapPmbProdi extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'pdpt_rekap_pmb_prodi';
    protected $primaryKey = 'PMBPeriodID';
    //public $timestamps = false;
    //const CREATED_AT = 'WaktuBuat';
    // const UPDATED_AT = 'TanggalEdit';
   
    protected $fillable = [
        'PMBPeriodID',
        'StatusAwalID',
        'ProdiID',
        'Pendaftar',
        'Peserta',
        'Lulus',
        'Registrasi',
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
