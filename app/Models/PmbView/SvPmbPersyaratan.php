<?php

namespace App\Models\PmbView;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SvPmbPersyaratan extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'sv_pmb_persyaratan';
    protected $primaryKey = 'PMBID';
    public $timestamps = false;
   
    protected $fillable = [
        'PMBID',
        'PMBSyaratID',
        'Dokumen',
        'StatusID',
        'PMBRef',
        'PMBFormulirID',
        'PMBPeriodID',
        'PMBFormJualID',
        'PSSBID',
        'BuktiSetoran',
        'NIM',
        'KodeID',
        'BIPOTID',
        'Nama',
        'StatusAwalID',
        'StatusMundur',
        'MhswPindahanID',
        'ProgramID',
        'ProdiID',
        'Kelamin',
        'WargaNegara',
        'Kebangsaan',
        'TempatLahir',
        'TanggalLahir',
        'Agama',
        'StatusSipil',
        'Alamat',
        'Kota',
        'RT',
        'RW',
        'KodePos',
        'Propinsi',
        'Negara',
        'Telepon',
        'Handphone',
        'Email',
        'AlamatAsal',
        'KotaAsal',
        'RTAsal',
        'RWAsal',
        'KodePosAsal',
        'PropinsiAsal',
        'NegaraAsal',
        'TeleponAsal',
        'NamaAyah',
        'AgamaAyah',
        'PendidikanAyah',
        'PekerjaanAyah',
        'HidupAyah',
        'NamaIbu',
        'AgamaIbu',
        'PendidikanIbu',
        'PekerjaanIbu',
        'HidupIbu',
        'AlamatOrtu',
        'KotaOrtu',
        'RTOrtu',
        'RWOrtu',
        'KodePosOrtu',
        'PropinsiOrtu',
        'NegaraOrtu',
        'TeleponOrtu',
        'HandphoneOrtu',
        'EmailOrtu',
        'AsalSekolah',
        'JenisSekolahID',
        'AlamatSekolah',
        'KotaSekolah',
        'JurusanSekolah',
        'NilaiSekolah',
        'TahunLulus',
        'AsalPT',
        'ProdiAsalPT',
        'LulusAsalPT',
        'TglLulusAsalPT',
        'Pilihan1',
        'Pilihan2',
        'Harga',
        'SudahBayar',
        'NA',
        'TanggalUjian',
        'LulusUjian',
        'RuangID',
        'NomerUjian',
        'NilaiUjian',
        'DetailNilai',
        'GradeNilai',
        'Catatan',
        'NomerSurat',
        'Syarat',
        'SyaratLengkap',
        'BuktiSetoranMhsw',
        'TanggalSetoranMhsw',
        'TotalBiayaMhsw',
        'TotalSetoranMhsw',
        'Dispensasi',
        'DispensasiID',
        'JudulDispensasi',
        'CatatanDispensasi',
        'OPMBID',
        'KelompokOPMB',
        //author
        'LoginBuat',
        'WaktuBuat',
        'LoginUbah',
        'WaktuUbah',

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
