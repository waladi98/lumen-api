<?php

namespace App\Models\Registrasi;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SimakTrnKrs extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'simak_trn_krs';
    protected $primaryKey = 'KRSID';
    //public $timestamps = false;
    //const CREATED_AT = 'WaktuBuat';
    // const UPDATED_AT = 'TanggalEdit';
   
    protected $fillable = [
        'KeyID',
        'KRSID',
        'KHSID',
        'MhswID',
        'TahunID',
        'JadwalID',
        'MKID',
        'MKKode',
        'SKS',
        'HargaStandar',
        'Harga',
        'Bayar',
        'TanggalBayar',
        'Tugas1',
        'Tugas2',
        'Tugas3',
        'Tugas4',
        'Tugas5',
        'Presensi',
        '_Presensi',
        'UTS',
        'UAS',
        'Responsi',
        'NilaiAkhir',
        'GradeNilai',
        'BobotNilai',
        'IndeksUTS',
        'IndeksUAS',
        'StatusKRSID',
        'Tinggi',
        'Final',
        'Setara',
        'SetaraKode',
        'SetaraGrade',
        'SetaraNama',
        'Dispensasi',
        'DispensasiOleh',
        'TanggalDispensasi',
        'CatatanDispensasi',
        'Catatan',
        'CatatanError',
        'RuangID',
        //author
        'LoginBuat',
        'TanggalBuat',
        'LoginEdit',
        'TanggalEdit',
        //
        'NA',
        'Kelas',
        'KM',
        'RuangID_UTS',
        'No_Urut_UTS',
        'Waktu_Hadir_UTS',
        'RuangID_UAS',
        'No_Urut_UAS',
        'Waktu_Hadir_UAS',
        'Validasi',
        'Kwitansi',
        'MKPraktikum',     
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
