<?php

namespace App\Models\Pmb;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SimakBesanPmbOnline extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'simak_besan_pmb_online';
    protected $primaryKey = 'link_id';
    // public $timestamps = false;
    // const CREATED_AT = 'Waktu';
    // const UPDATED_AT = 'TanggalEdit'; 
    protected $fillable = [
        'link_id',
        'link_name',
        'link_url',
        'link_visibility',
        'link_position',
        'link_window',
        'link_order',
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
