<?php

namespace App\Models\PmbView;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SvPmbPendaftar extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sv_pmb_pendaftar';
    protected $primaryKey = 'kode';
    public $timestamps = false;
   
    protected $fillable = [
        'kode',
        'kode_pmb_gelombang',
        'Gelombang',
        'id_siswa',
        'npsn',
        'nama_siswa',
        'kode_prodi',
        'id_kategori_pendaftar',
        'kategori_pendaftar',
        'Prodi',
        'info_pmb',
        'info_pendaftar',
        'info_kontak',
        'id_kelamin',
        'jk',
        'tempat_lahir',
        'tgl_lahir',
        'alamat_lengkap',
        'email',
        'no_tlp',
        'nama_orangtua',
        'id_pekerjaan_ortu',
        'pekerjaan',
        'penghasilan',
        'alamat_orangtua',
        'no_tlp_orangtua',
        'asal_sekolah_t',
        'asal_sekolah',
        'jurusan',
        'guru_pendaftar',
        'dok_1',
        'dok_2',
        'dok_3',
        'dok_4',
        'dok_5',
        'dok_6',
        'id_status_konfirmasi',
        'status',
        'tgl_diterima'

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
