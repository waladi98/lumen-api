<?php

namespace App\Models\Pmb;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SimakMstPmbFormulir extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'simak_mst_pmb_formulir';
    protected $primaryKey = 'PMBFormulirID';
    //public $timestamps = false;
    const CREATED_AT = 'TanggalBuat';
    const UPDATED_AT = 'TanggalEdit';
   
    protected $fillable = [
        'PMBFormulirID',
        'Nama',
        'KodeID',
        'JumlahPilihan', 
        'Harga',
        'HanyaProdi1',
        'KecualiProdi1',
        'HanyaProdi2',
        'KecualiProdi2',
        'HanyaProdi3',
        'KecualiProdi3',
        'Keterangan',
        'NA',
        'LoginEdit',
        'LoginBuat',
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
