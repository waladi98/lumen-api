<?php

namespace App\Models\PmbView;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SvPmbSekolahBelumAda extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sv_pmb_sekolah_belum_ada';
    protected $primaryKey = 'npsn';

    protected $fillable = [
        'npsn',
        'nama_sekolah',
        'alamat_sekolah', 
        'desa_kel',
        'kec',
        'kab_kota',
        'provinsi',
        'email',
        'no_telepon',
        'id_guru',
        'id_status_konfirmasi',
        'STATUS',       
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
