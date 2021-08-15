<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//AuthController - untuk mendapatkan token //bebas akses
//public
$router->group(['prefix' => 'api-v1/klien/auth'], function() use ($router) {
    //login klien
     //url/klien/auth/login
    $router->post('login', ['uses' => 'AuthController@loginAuth']);
    // register
    //url/klien/auth/register  
    $router->post('register', ['uses' => 'AuthController@register']);
});

//public-daftarkan endpoint
$router->group(['prefix' => 'api-v1'], function() use ($router) {
     $router->group(['namespace' => 'URL'], function() use ($router) {
          //situ/uri-endpoint
          $router->get('uri-endpoint', ['uses' => 'EnpointController@getData']);
          $router->get('uri-endpoint/{id}', ['uses' => 'EnpointController@showData']);
          $router->post('uri-endpoint', ['uses' => 'EnpointController@createData']);
          $router->delete('uri-endpoint/{id}', ['uses' => 'EnpointController@deleteData']);
          $router->put('uri-endpoint/{id}', ['uses' => 'EnpointController@editData']);
     });
 });


//halaman sebelum login-> syarat token-klien 
//klien
$router->group(['prefix' => 'api-v1', 'middleware' => 'klien'], function() use ($router) {
    //url/situ/menu-public
    $router->get('index', 'LogController@beranda');  
    $router->get('testing', 'LogController@testing');
    $router->get('data-klien', 'LogController@dataKlien');
});

//akses dasboard user->parameter nama user, sandi user, token klien (header)
//user
$router->group(['prefix' => 'api-v1/user' , 'middleware' => 'user'], function() use ($router) {
    //login pengguna aplikasi
    //url/situ/user/login
    $router->post('login', ['uses' => 'UserController@userLogin']);
});

//syarat harus sudah login->nama user dan token
//menu user
$router->group(['prefix' => 'api-v1/user' , 'middleware' => 'cekLogin'], function() use ($router) {
    //url/situ/user/logout
    $router->delete('logout', ['uses' => 'UserController@logout']);
    //url/situ/user/change-password
    $router->patch('change-password', ['uses' => 'UserController@changePassword']);
});


//================================================MODUL==============================================//
//daftar menu modul PMB
//cek hak akses
//menu-lms
$router->group(['prefix' => 'api-v1/modul/pmb/lms', 'middleware' => 'cekLogin'], function() use ($router) {
    //lms
     $router->group(['namespace' => 'Pmb'], function() use ($router) {
         
         //lms/prc-pmb
         $router->get('prc-pmb', ['uses' => 'LmsPrcPmbController@getData']);
         $router->get('prc-pmb/{id}', ['uses' => 'LmsPrcPmbController@showData']);
         $router->post('prc-pmb', ['uses' => 'LmsPrcPmbController@createData']);
         $router->delete('prc-pmb/{id}', ['uses' => 'LmsPrcPmbController@deleteData']);
         $router->put('prc-pmb/{id}', ['uses' => 'LmsPrcPmbController@editData']);

          //lms/trn-pmb
          $router->get('trn-pmb', ['uses' => 'LmsTrnPmbController@getData']);
          $router->get('trn-pmb/{id}', ['uses' => 'LmsTrnPmbController@showData']);
          $router->post('trn-pmb', ['uses' => 'LmsTrnPmbController@createData']);
          $router->delete('trn-pmb/{id}', ['uses' => 'LmsTrnPmbController@deleteData']);
          $router->put('trn-pmb/{id}', ['uses' => 'LmsTrnPmbController@editData']);
     });
 });

 //cek hak akses
//daftar menu modul PMB
//menu-besan-pmb
$router->group(['prefix' => 'api-v1/modul/pmb', 'middleware' => 'cekLogin'], function() use ($router) {
    //BESAN
     $router->group(['namespace' => 'Pmb'], function() use ($router) {
         
         //situ/besan-pmb
         $router->get('besan-pmb', ['uses' => 'BesanPmbController@getData']);
         $router->get('besan-pmb/{id}', ['uses' => 'BesanPmbController@showData']);
         $router->post('besan-pmb', ['uses' => 'BesanPmbController@createData']);
         $router->delete('besan-pmb/{id}', ['uses' => 'BesanPmbController@deleteData']);
         $router->put('besan-pmb/{id}', ['uses' => 'BesanPmbController@editData']);

          //situ/besan-pmb-online
          $router->get('besan-pmb-online', ['uses' => 'BesanPmbOnController@getData']);
          $router->get('besan-pmb-online/{id}', ['uses' => 'BesanPmbOnController@showData']);
          $router->post('besan-pmb-online', ['uses' => 'BesanPmbOnController@createData']);
          $router->delete('besan-pmb-online/{id}', ['uses' => 'BesanPmbOnController@deleteData']);
          $router->put('besan-pmb-online/{id}', ['uses' => 'BesanPmbOnController@editData']);
     });
 });

 //cek hak akses
//daftar menu modul PMB
//menu-besan-pmb
$router->group(['prefix' => 'api-v1/modul/pmb/mst', 'middleware' => 'cekLogin'], function() use ($router) {
    //BESAN
     $router->group(['namespace' => 'Pmb'], function() use ($router) { 
         //situ/besan-pmb
         $router->get('opmb', ['uses' => 'OpmbController@getData']);
         $router->get('opmb/{id}', ['uses' => 'OpmbController@showData']);
         $router->post('opmb', ['uses' => 'OpmbController@createData']);
         $router->delete('opmb/{id}', ['uses' => 'OpmbController@deleteData']);
         $router->put('opmb/{id}', ['uses' => 'OpmbController@editData']);
     });
 });

 //cek hak akses
//daftar menu modul PMB
//menu-pdpt-rekap-pmb-prodi
$router->group(['prefix' => 'api-v1/modul/pmb/rekap', 'middleware' => 'cekLogin'], function() use ($router) {
    //PDPT-REKAP
     $router->group(['namespace' => 'Pmb'], function() use ($router) {
         
         //rekap/pmb-prodi
         $router->get('pmb-prodi', ['uses' => 'RekapPmbController@getData']);
         $router->get('pmb-prodi/{id}', ['uses' => 'RekapPmbController@showData']);
         $router->post('pmb-prodi', ['uses' => 'RekapPmbController@createData']);
         $router->delete('pmb-prodi/{id}', ['uses' => 'RekapPmbController@deleteData']);
         $router->put('pmb-prodi/{id}', ['uses' => 'RekapPmbController@editData']);

     });
 });
//cek hak akses
//daftar menu modul PMB
//menu-tmp
$router->group(['prefix' => 'api-v1/modul/pmb', 'middleware' => 'cekLogin'], function() use ($router) {
   //TMP
    $router->group(['namespace' => 'Pmb'], function() use ($router) {
        
        //pmb
        $router->get('tmp-pmb', ['uses' => 'PmbController@getData']);
        $router->get('tmp-pmb/{id}', ['uses' => 'PmbController@showData']);
        $router->post('tmp-pmb', ['uses' => 'PmbController@createData']);
        $router->delete('tmp-pmb/{id}', ['uses' => 'PmbController@deleteData']);
        $router->put('tmp-pmb/{id}', ['uses' => 'PmbController@editData']);

        //detail
        $router->get('tmp-pmb-detail', ['uses' => 'PmbDetailController@getData']);
        $router->get('tmp-pmb-detail/{id}', ['uses' => 'PmbDetailController@showData']);
        $router->post('tmp-pmb-detail', ['uses' => 'PmbDetailController@createData']);
        $router->delete('tmp-pmb-detail/{id}', ['uses' => 'PmbDetailController@deleteData']);
        $router->put('tmp-pmb-detail/{id}', ['uses' => 'PmbDetailController@editData']);
    });
});
//menu-trn
$router->group(['prefix' => 'api-v1/modul/pmb/trn', 'middleware' => 'cekLogin'], function() use ($router) {
    //TRN
     $router->group(['namespace' => 'Pmb'], function() use ($router) {
         
         //pmb
         $router->get('pmb', ['uses' => 'TrnPmbController@getData']);
         $router->get('pmb/{id}', ['uses' => 'TrnPmbController@showData']);
         $router->post('pmb', ['uses' => 'TrnPmbController@createData']);
         $router->delete('pmb/{id}', ['uses' => 'TrnPmbController@deleteData']);
         $router->put('pmb/{id}', ['uses' => 'TrnPmbController@editData']);
 
         //formulir
         $router->get('formulir', ['uses' => 'TrnPmbFormController@getData']);
         $router->get('formulir/{id}', ['uses' => 'TrnPmbFormController@showData']);
         $router->post('formulir', ['uses' => 'TrnPmbFormController@createData']);
         $router->delete('formulir/{id}', ['uses' => 'TrnPmbFormController@deleteData']);
         $router->put('formulir/{id}', ['uses' => 'TrnPmbFormController@editData']);

         //formulir-online
         $router->get('formulir-online', ['uses' => 'TrnPmbFormOnController@getData']);
         $router->get('formulir-online/{id}', ['uses' => 'TrnPmbFormOnController@showData']);
         $router->post('formulir-online', ['uses' => 'TrnPmbFormOnController@createData']);
         $router->delete('formulir-online/{id}', ['uses' => 'TrnPmbFormOnController@deleteData']);
         $router->put('formulir-online/{id}', ['uses' => 'TrnPmbFormOnController@editData']);

         //nilai
         $router->get('nilai', ['uses' => 'TrnPmbNilaiController@getData']);
         $router->get('nilai/{id}', ['uses' => 'TrnPmbNilaiController@showData']);
         $router->post('nilai', ['uses' => 'TrnPmbNilaiController@createData']);
         $router->delete('nilai/{id}', ['uses' => 'TrnPmbNilaiController@deleteData']);
         $router->put('nilai/{id}', ['uses' => 'TrnPmbNilaiController@editData']);

         //persyaratan
         $router->get('persyaratan', ['uses' => 'TrnPmbPersyaratanController@getData']);
         $router->get('persyaratan/{id}', ['uses' => 'TrnPmbPersyaratanController@showData']);
         $router->post('persyaratan', ['uses' => 'TrnPmbPersyaratanController@createData']);
         $router->delete('persyaratan/{id}', ['uses' => 'TrnPmbPersyaratanController@deleteData']);
         $router->post('edit-persyaratan/{id}', ['uses' => 'TrnPmbPersyaratanController@editData']);
     });
 });
//menu-mst
$router->group(['prefix' => 'api-v1/modul/pmb/mst-pmb', 'middleware' => 'cekLogin'], function() use ($router) {
    //Modul PMB
    $router->group(['namespace' => 'Pmb'], function() use ($router) {
        
        //formulir
        $router->get('formulir', ['uses' => 'PmbFormController@getData']);
        $router->get('formulir/{id}', ['uses' => 'PmbFormController@showData']);
        $router->post('formulir', ['uses' => 'PmbFormController@createData']);
        $router->delete('formulir/{id}', ['uses' => 'PmbFormController@deleteData']);
        $router->put('formulir/{id}', ['uses' => 'PmbFormController@editData']);


        //gelombang
        $router->get('gelombang', ['uses' => 'PmbGelomController@getData']);
        $router->get('gelombang/{id}', ['uses' => 'PmbGelomController@showData']);
        $router->Post('gelombang', ['uses' => 'PmbGelomController@createData']);
        $router->delete('gelombang/{id}', ['uses' => 'PmbGelomController@deleteData']);
        $router->put('gelombang/{id}', ['uses' => 'PmbGelomController@editData']);

        //guru
        $router->get('guru', ['uses' => 'PmbGuruController@getData']);
        $router->get('guru/{id}', ['uses' => 'PmbGuruController@showData']);
        $router->Post('guru', ['uses' => 'PmbGuruController@createData']);
        $router->delete('guru/{id}', ['uses' => 'PmbGuruController@deleteData']);
        $router->put('guru/{id}', ['uses' => 'PmbGuruController@editData']);

        //Pendaftar
        $router->get('pendaftar', ['uses' => 'PmbPendaftarController@getData']);
        $router->get('pendaftar/{id}', ['uses' => 'PmbPendaftarController@showData']);
        $router->Post('pendaftar', ['uses' => 'PmbPendaftarController@createData']);
        $router->delete('pendaftar/{id}', ['uses' => 'PmbPendaftarController@deleteData']);
        $router->put('pendaftar/{id}', ['uses' => 'PmbPendaftarController@editData']);

        //Pengguna
        $router->get('pengguna', ['uses' => 'PmbPenggunaController@getData']);
        $router->get('pengguna/{id}', ['uses' => 'PmbPenggunaController@showData']);
        $router->Post('pengguna', ['uses' => 'PmbPenggunaController@createData']);
        $router->delete('pengguna/{id}', ['uses' => 'PmbPenggunaController@deleteData']);
        $router->put('pengguna/{id}', ['uses' => 'PmbPenggunaController@editData']);

        //Persyaratan
        $router->get('persyaratan', ['uses' => 'PmbPersyaratanController@getData']);
        $router->get('persyaratan/{id}', ['uses' => 'PmbPersyaratanController@showData']);
        $router->Post('persyaratan', ['uses' => 'PmbPersyaratanController@createData']);
        $router->delete('persyaratan/{id}', ['uses' => 'PmbPersyaratanController@deleteData']);
        $router->put('persyaratan/{id}', ['uses' => 'PmbPersyaratanController@editData']);

        //Persyaratan
        $router->get('sekolah', ['uses' => 'PmbSekolahController@getData']);
        $router->get('sekolah/{id}', ['uses' => 'PmbSekolahController@showData']);
        $router->Post('sekolah', ['uses' => 'PmbSekolahController@createData']);
        $router->delete('sekolah/{id}', ['uses' => 'PmbSekolahController@deleteData']);
        $router->put('sekolah/{id}', ['uses' => 'PmbSekolahController@editData']);
    });
});
//menu-usm
$router->group(['prefix' => 'api-v1/modul/pmb', 'middleware' => 'cekLogin'], function() use ($router) {
    //Modul PMB
    $router->group(['namespace' => 'Pmb'], function() use ($router) {
        //Usm
        $router->get('usm', ['uses' => 'PmbUsmController@getData']);
        $router->get('usm/{id}', ['uses' => 'PmbUsmController@showData']);
        $router->Post('usm', ['uses' => 'PmbUsmController@createData']);
        $router->delete('usm/{id}', ['uses' => 'PmbUsmController@deleteData']);
        $router->put('usm/{id}', ['uses' => 'PmbUsmController@editData']);
        //file
        $router->get('usm-file', ['uses' => 'PmbUsmFileController@getData']);
        $router->get('usm-file/{id}', ['uses' => 'PmbUsmFileController@showData']);
        $router->Post('usm-file', ['uses' => 'PmbUsmFileController@createData']);
        $router->delete('usm-file/{id}', ['uses' => 'PmbUsmFileController@deleteData']);
        $router->put('usm-file/{id}', ['uses' => 'PmbUsmFileController@editData']);

        //kunci
        $router->get('usm-kunci', ['uses' => 'PmbUsmKunciController@getData']);
        $router->get('usm-kunci/{id}', ['uses' => 'PmbUsmKunciController@showData']);
        $router->Post('usm-kunci', ['uses' => 'PmbUsmKunciController@createData']);
        $router->delete('usm-kunci/{id}', ['uses' => 'PmbUsmKunciController@deleteData']);
        $router->put('usm-kunci/{id}', ['uses' => 'PmbUsmKunciController@editData']);
    });
});

//menu-prc
$router->group(['prefix' => 'api-v1/modul/pmb/prc', 'middleware' => 'cekLogin'], function() use ($router) {
    //Modul PMB
    $router->group(['namespace' => 'Pmb'], function() use ($router) {
         //prc-pmb
        //formulir
        $router->get('formulir-online', ['uses' => 'PmbFormONController@getData']);
        $router->get('formulir-online/{id}', ['uses' => 'PmbFormONController@showData']);
        $router->post('formulir-online', ['uses' => 'PmbFormONController@createData']);
        $router->delete('formulir-online/{id}', ['uses' => 'PmbFormONController@deleteData']);
        $router->put('formulir-online/{id}', ['uses' => 'PmbFormONController@editData']);
    });
});

 //menu-ref
$router->group(['prefix' => 'api-v1/modul/pmb/ref', 'middleware' => 'cekLogin'], function() use ($router) {
    //Modul PMB
    $router->group(['namespace' => 'Pmb'], function() use ($router) {
         //ref-pmb
        //pengaturan
        $router->get('pengaturan', ['uses' => 'PmbPengaturanController@getData']);
        $router->get('pengaturan/{id}', ['uses' => 'PmbPengaturanController@showData']);
        $router->Post('pengaturan', ['uses' => 'PmbPengaturanController@createData']);
        $router->delete('pengaturan/{id}', ['uses' => 'PmbPengaturanController@deleteData']);
        $router->put('pengaturan/{id}', ['uses' => 'PmbPengaturanController@editData']);
    });
});

 //================================================MODUL==============================================//
//daftar menu modul  registrasi
//cek hak akses
$router->group(['prefix' => 'api-v1/modul/registrasi', 'middleware' => 'cekLogin'], function() use ($router) {
    //Views
     $router->group(['namespace' => 'Registrasi'], function() use ($router) {
         //registrasi-KHS
        $router->get('khs', ['uses' => 'TrnKhsController@getData']);
        $router->get('khs/{id}', ['uses' => 'TrnKhsController@showData']);
        $router->Post('khs', ['uses' => 'TrnKhsController@createData']);
        $router->delete('khs/{id}', ['uses' => 'TrnKhsController@deleteData']);
        $router->put('khs/{id}', ['uses' => 'TrnKhsController@editData']);
        //registrasi-KRS
        $router->get('krs', ['uses' => 'TrnKrsController@getData']);
        $router->get('krs/{id}', ['uses' => 'TrnKrsController@showData']); 
        $router->Post('krs', ['uses' => 'TrnKrsController@createData']);
        $router->delete('krs/{id}', ['uses' => 'TrnKrsController@deleteData']);
        $router->put('krs/{id}', ['uses' => 'TrnKrsController@editData']);   
     });
 });




 //================================================View==============================================//
//daftar menu modul View registrasi
//cek hak akses
//tabel view
$router->group(['prefix' => 'api-v1/modul/registrasi-view', 'middleware' => 'cekLogin'], function() use ($router) {
    //Views
     $router->group(['namespace' => 'RegistrasiView'], function() use ($router) {
         //registrasi-view-KHS
         $router->get('khs', ['uses' => 'SVKhsController@getData']);
         $router->get('khs/{id}', ['uses' => 'SVKhsController@showData']);
        //registrasi-view-KRS
        $router->get('krs', ['uses' => 'SVKrsController@getData']);    
        $router->get('krs/{id}', ['uses' => 'SVKrsController@showData']);    
     });
 });


 //daftar menu modul View PMB
//cek hak akses
//tabel view
$router->group(['prefix' => 'api-v1/modul/Pmb-view', 'middleware' => 'cekLogin'], function() use ($router) {
    //Views
     $router->group(['namespace' => 'PmbView'], function() use ($router) {
         
        //pmb-view-pmb-grade
        $router->get('pmb-grade', ['uses' => 'SimakRefPmbGradeController@getData']);
        $router->get('pmb-grade/{id}', ['uses' => 'SimakRefPmbGradeController@showData']);
        $router->Post('pmb-grade', ['uses' => 'SimakRefPmbGradeController@createData']);
        $router->delete('pmb-grade/{id}', ['uses' => 'SimakRefPmbGradeController@deleteData']);
        $router->patch('pmb-grade/{id}', ['uses' => 'SimakRefPmbGradeController@editData']);

        //pmb-view-pendafar
         $router->get('pendaftar', ['uses' => 'SVPendaftarController@getData']);
         $router->get('pendaftar/{id}', ['uses' => 'SVPendaftarController@showData']);
         

         //pmb-view-pmb
         $router->get('pmb', ['uses' => 'SVPmbController@getData']);
         $router->get('pmb/{id}', ['uses' => 'SVPmbController@showData']);
         $router->Post('pmb', ['uses' => 'SVPmbController@createData']);
         $router->delete('pmb/{id}', ['uses' => 'SVPmbController@deleteData']);
         $router->patch('pmb/{id}', ['uses' => 'SVPmbController@editData']);

         //pmb-view-form-jual-online
         $router->get('formulir-jual-online', ['uses' => 'SVPmbFormJuOnlineController@getData']);
         $router->get('formulir-jual-online/{id}', ['uses' => 'SVPmbFormJuOnlineController@showData']);
         $router->Post('formulir-jual-online/', ['uses' => 'SVPmbFormJuOnlineController@createData']);
         $router->delete('formulir-jual-online/{id}', ['uses' => 'SVPmbFormJuOnlineController@deleteData']);
         $router->put('formulir-jual-online/{id}', ['uses' => 'SVPmbFormJuOnlineController@editData']);

         //pmb-view-form-jual-online-aktif
         $router->get('formulir-jual-online-aktif', ['uses' => 'SVPmbFormJuOnlineAkController@getData']);
         $router->get('formulir-jual-online-aktif/{id}', ['uses' => 'SVPmbFormJuOnlineAkController@showData']);

         //pmb-view-pmb-pendaftar
         $router->get('pmb-pendaftar', ['uses' => 'SVPmbPendaftarController@getData']);
         $router->get('pmb-pendaftar/{id}', ['uses' => 'SVPmbPendaftarController@showData']);

         //pmb-view-pmb-persyaratan
         $router->get('pmb-persyaratan', ['uses' => 'SVPmbPersyaratanController@getData']);
         $router->get('pmb-persyaratan/{id}', ['uses' => 'SVPmbPersyaratanController@showData']);

         //pmb-view-pmb-sekolah
         $router->get('pmb-sekolah', ['uses' => 'SVPmbSekolahController@getData']);
         $router->get('pmb-sekolah/{id}', ['uses' => 'SVPmbSekolahController@showData']);

         //pmb-view-pmb-sekolah-belum-ada
         $router->get('pmb-sekolah-belum-ada', ['uses' => 'SVPmbSekolahBelumAdaController@getData']);
         $router->get('pmb-sekolah-belum-ada/{id}', ['uses' => 'SVPmbSekolahBelumAdaController@showData']);
         $router->Post('pmb-sekolah-belum-ada/', ['uses' => 'SVPmbSekolahBelumAdaController@createData']);
         $router->delete('pmb-sekolah-belum-ada/{id}', ['uses' => 'SVPmbSekolahBelumAdaController@deleteData']);
         $router->put('pmb-sekolah-belum-ada/{id}', ['uses' => 'SVPmbSekolahBelumAdaController@editData']);
     });
 });

