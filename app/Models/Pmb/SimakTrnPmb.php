<?php

namespace App\Models\Pmb;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class SimakTrnPmb extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'simak_trn_pmb';
    protected $primaryKey = 'PMBID';
    //public $timestamps = false;
    // const CREATED_AT = 'TanggalBuat';
    // const UPDATED_AT = 'TanggalEdit';
   
    protected $fillable = [
        'PMBID',
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
        'Pilihan3',
        'Harga',
        'SudahBayar',
        'NA',
        'IkutUjian',
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
        //waktu
        'LoginBuat',
        'TanggalBuat',
        'LoginEdit',
        'TanggalEdit',
        '_nim',

        
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
