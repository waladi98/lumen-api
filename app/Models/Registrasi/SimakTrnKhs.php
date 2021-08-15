<?php

namespace App\Models\Registrasi;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SimakTrnKhs extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'simak_trn_khs';
    protected $primaryKey = 'KHSID';
    //public $timestamps = false;
    //const CREATED_AT = 'WaktuBuat';
    // const UPDATED_AT = 'TanggalEdit';
   
    protected $fillable = [
        'KeyID',
        'KHSID',
        'KodeID',
        'ProgramID',
        'ProdiID',
        'TahunID',
        'MhswID',
        'StatusMhswID',
        'Sesi',
        'MaxSKS',
        'SKSK',
        'SKS',
        'IPS',
        'IPT',
        'IPA',
        'JumlahMK',
        'TotalSKS',
        'RataanPresensi',
        'MKPresensi',
        'RataanUTS',
        'MKUTS',
        'MKUAS',
        'IP',
        'BIPOTID',
        'SaldoAwal',
        'Biaya',
        'Potongan',
        'Bayar',
        'Tarik',
        'JumlahLain',
        'StatusDPP',
        'CetakKRS',
        'Cetak',
        'KaliCetak',
        'Tutup',
        'Autodebet',
        'Blok',
        'KeteranganBlok',
        'NoSurat',
        'TglSurat',
        'Keterangan',
        'Finger',
        'TA',
        '0SKS',
        'BayarUTS',
        'WaktuBayarUTS',
        'BiayaUTS',
        'BayarUAS',
        'WaktuBayarUAS',
        'BiayaUAS',
        'LoginBuat',
        'TanggalBuat',
        'LoginEdit',
        'TanggalEdit',
        'NA',
        '_StatusMhswID1',
        '_StatusMhswID2',

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
