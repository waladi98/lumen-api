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


//AuthController - getToken //bebas akses
$router->group(['prefix' => 'auth'], function() use ($router) {
    $router->post('login', ['uses' => 'AuthController@loginAuth']);
    // register Session    
    //$router->post('register', ['uses' => 'AuthController@register']);
});

//halaman sebelum login-> syarat token-klien
$router->group(['prefix' => 'situ', 'middleware' => 'auth'], function() use ($router) {
    $router->get('index', 'LogController@beranda');   
});

//akses dasboard user->syarat nama user, sandi user, token klien (header)
$router->group(['prefix' => 'situ/user' , 'middleware' => 'user'], function() use ($router) {
    $router->post('login', ['uses' => 'UserController@userLogin']);
});

//syarat harus sudah login->nama user dan token
$router->group(['prefix' => 'situ/user' , 'middleware' => 'cekLogin'], function() use ($router) {
    $router->get('logout', ['uses' => 'UserController@logout']);
});
//cek hak akses

$router->group(['prefix' => 'situ/pmb', 'middleware' => 'cekLogin'], function() use ($router) {
    //Modul PMB
    $router->group(['namespace' => 'Pmb'], function() use ($router) {
        
        //formulir
        $router->get('formulir', ['uses' => 'PmbFormController@getData']);
        $router->get('formulir/{id}', ['uses' => 'PmbFormController@showData']);
        $router->post('formulir', ['uses' => 'PmbFormController@createData']);
        $router->delete('formulir/{id}', ['uses' => 'PmbFormController@deleteData']);
        $router->put('formulir/{id}', ['uses' => 'PmbFormController@editData']);

        //gelombang
        $router->get('gelombang', ['uses' => 'SimakMstPmbGelomController@index']);
        $router->get('gelombang/{id}', ['uses' => 'SimakMstPmbGelomController@show']);
        $router->Post('gelombang', ['uses' => 'SimakMstPmbGelomController@create']);
        $router->delete('gelombang/{id}', ['uses' => 'PmbFormController@destroy']);
        $router->put('gelombang/{id}', ['uses' => 'SimakMstPmbGelomController@update']);

        //guru
        $router->get('guru', ['uses' => 'SimakMstPmbGuruController@index']);
        $router->get('guru/{id}', ['uses' => 'SimakMstPmbGuruController@show']);
        $router->Post('guru', ['uses' => 'SimakMstPmbGuruController@create']);
        $router->delete('guru/{id}', ['uses' => 'SimakMstPmbGuruController@destroy']);
        $router->put('guru/{id}', ['uses' => 'SimakMstPmbGuruController@update']);
    });
});



// $router->get('testing', ['uses' => 'Controller@setUser']);
// $router->get('login', ['uses' => 'UserController@index']);
// $router->get('out', ['uses' => 'LogController@index']);
// $router->get('keluar', ['uses' => 'Controller@logout']);
// $router->get('logout', ['uses' => 'UserController@logout']);



























//pengaturan route
// $router->group(['prefix' => 'mst/pmb', 'middleware' => 'auth'], function() use ($router) {
//     $router->get('users/login', 'UserController@getUserLogin2');
//     //Modul PMB
//     $router->group(['namespace' => 'Pmb'], function() use ($router) {
//         //formulir
//         $router->get('formulir', ['uses' => 'SimakMstPmbFormController@getPMBFormulir']);
//         $router->get('formulir/{id}', ['uses' => 'SimakMstPmbFormController@getById']);
//         $router->post('formulir', ['uses' => 'SimakMstPmbFormController@createFormulir']);
//         $router->put('formulir/{id}', ['uses' => 'SimakMstPmbFormController@updatePMBFormulir']);

//         //gelombang
//         $router->get('gelombang', ['uses' => 'SimakMstPmbGelomController@getPMBGelombang']);
//         $router->get('gelombang/{id}', ['uses' => 'SimakMstPmbGelomController@getById']);
//         $router->Post('gelombang', ['uses' => 'SimakMstPmbGelomController@createGelombang']);
//         $router->put('gelombang/{id}', ['uses' => 'SimakMstPmbGelomController@updatePMBGelombang']);

//         //guru
//         $router->get('guru', ['uses' => 'SimakMstPmbGuruController@getPMBGuru']);
//         $router->get('guru/{id}', ['uses' => 'SimakMstPmbGuruController@getById']);
//         $router->Post('guru', ['uses' => 'SimakMstPmbGuruController@createGuru']);
//         $router->put('guru/{id}', ['uses' => 'SimakMstPmbGuruController@updatePMBGuru']);
//         $router->delete('guru/{id}', ['uses' => 'SimakMstPmbGuruController@deletePMBGuru']);
//     });
// });

// $router->get('tes', function (
//     \Illuminate\Http\Request $request) {

//     $request->session()->put('name', 'Lumen-Session');

//     return response()->json([
//         'session.name' => $request->session()->get('name')
//     ]);
//     });


// // Test session
//     $router->get('session', function (\Illuminate\Http\Request $request) {

//         return response()->json([
//             'session.name' => $request->session()->get('name'),
//         ]);
//     });

//pengaturan route
//$router->group(['prefix' => 'api','middleware' => 'auth'], function() use ($router) {
        
    //Layanan Dosen
    // $router->group(['namespace' => 'Dosen'], function() use ($router) {
    //     $router->get('dosen', ['uses' => 'DosenController@index']);
    //     $router->get('show', ['uses' => 'DosenController@show']);
    // });
    //Modul PMB
    // $router->group(['namespace' => 'Pmb'], function() use ($router) { 
    //     $router->get('pengguna', ['uses' => 'jalakPenggunaController@index']);
    //     $router->get('mahasiswa', ['uses' => 'mahasiswaController@index']);
    //     $router->get('mahasiswa/{id}', ['uses' => 'mahasiswaController@show']);
    //     $router->post('mahasiswa', ['uses' => 'mahasiswaController@create']);
    //     $router->delete('mahasiswa/{id}', ['uses' => 'mahasiswaController@destroy']);
    //     $router->put('mahasiswa/{id}', ['uses' => 'mahasiswaController@update']);
    // });    
//});
