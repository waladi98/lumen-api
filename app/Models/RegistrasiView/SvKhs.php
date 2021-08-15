<?php

namespace App\Models\RegistrasiView;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SvKhs extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sv_khs';
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
        'StatusKHSID',
        'Angkatan',
        'Nama',
        'NamaProgram',
        'NamaProdi',
        'KurikulumID',
        'KodeDosenWali',
        'DosenWali',
        'HPDosenWali',
        'MStatusMhswID',
        'MStatusMahasiswa',
        'SKKeluar',
        'TglSKKeluar',
        'Handphone',
        'KelaminID',
        'NamaAyah',
        'NamaIbu',
        'AlamatOrtu',
        'HandphoneOrtu',
        'StatusMhswID',
        'StatusMahasiswa',
        'StatusKRSID',
        'Sesi',
        'MaxSKS',
        'SKSK',
        'SKS',
        'IPS',
        'JumlahMK',
        'TotalSKS',
        'RataanPresensi',
        'MKPresensi',
        'RataanUTS',
        'MKUTS',
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
