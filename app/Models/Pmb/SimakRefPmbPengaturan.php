<?php

namespace App\Models\Pmb;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SimakRefPmbPengaturan extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'simak_ref_pmb_pengaturan';
    protected $primaryKey = 'id_user';
    // public $timestamps = false;
    // const CREATED_AT = 'tgl_diterima';
    // const UPDATED_AT = 'TanggalEdit'; 
    protected $fillable = [
        'id_user',
        'tahun_akademik',
        'gelombang',
        'jangka_waktu_registrasi',
        'jam_registrasi',
        'cabang_bank',
        'nomor_rekening',
        'atas_nama'
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
