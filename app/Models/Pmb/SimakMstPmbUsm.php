<?php

namespace App\Models\Pmb;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SimakMstPmbUsm extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'simak_mst_pmb_usm';
    protected $primaryKey = 'PMBUSMID';
    // public $timestamps = false;
    // const CREATED_AT = 'tgl_diterima';
    // const UPDATED_AT = 'TanggalEdit'; 
    protected $fillable = [
        'PMBUSMID',
        'Nama',
        'LMSName',
        'Keterangan',
        'LoginBuat',
        'TanggalBuat',
        'LoginEdit',
        'TanggalEdit',
        'NA'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        //'password',
    ];
}
