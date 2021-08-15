<?php

namespace App\Models\PmbView;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SimakRefPmbGrade extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'simak_ref_pmb_grade';
    protected $primaryKey = 'GradeNilai';
    //public $timestamps = false;
    // const CREATED_AT = 'TanggalBuat';
    // const UPDATED_AT = 'TanggalEdit';
   
    protected $fillable = [
        'GradeNilai',
        'NA',     
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
