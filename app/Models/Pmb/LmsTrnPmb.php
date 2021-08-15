<?php

namespace App\Models\Pmb;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class LmsTrnPmb extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'lms_trn_pmb';
    protected $primaryKey = 'pmb_id';
    public $timestamps = false;
    //const CREATED_AT = 'WaktuBuat';
    // const UPDATED_AT = 'TanggalEdit';
   
    protected $fillable = [
        'pmb_id',
        'id_course',
        'id_role_assignments',
        'id_user_enrolments',
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
