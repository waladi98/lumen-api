<?php

namespace App\Models\RegistrasiView;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SvKrs extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sv_krs';
    protected $primaryKey = 'MhswID';
    //public $timestamps = false;
    //const CREATED_AT = 'WaktuBuat';
    // const UPDATED_AT = 'TanggalEdit';
   
    protected $fillable = [
        'JenisJadwalID',
        'ProgramID',
        'ProdiID',
        'DosenID',
        'HariID',
        'JamMulai',
        'JamSelesai',
        'UTSTanggal',
        'UASTanggal',
        'NamaKelas',
        'MKPraktikum',
        'MKKP',
        'MKTA',
        'KeyID',
        'KRSID',
        'KHSID',
        'MhswID',
        'TahunID',
        'JadwalID',
        'MKID',
        'MKKode',
        'MKNama',
        'Tarif',
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
        'StatusMhswID',
        'BIPOTID',
        'StatusDPP',
        'JumlahBayar',
        


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
