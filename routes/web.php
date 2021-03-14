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

$router->get('testing', ['uses' => 'Controller@setUser']);
$router->get('keluar', ['uses' => 'Controller@logout']);

$router->group(['prefix' => 'beranda' , 'middleware' => 'user'], function() use ($router) {
    $router->get('index', ['uses' => 'Controller@index']);
    // $router->post('register', ['uses' => 'AuthController@register']);
});






//AuthController
$router->group(['prefix' => 'auth'], function() use ($router) {
    $router->post('/', ['uses' => 'AuthController@loginAuth']);
    // Save Session
    

    // $router->post('register', ['uses' => 'AuthController@register']);
});

$router->group(['prefix' => 'user', 'middleware' => 'auth'], function() use ($router) {
    $router->post('login', 'UserController@userLogin');
    //$router->get('login/user', 'UserController@getUserLogin');
    //cek user yang sedang aktive
    $router->get('cek-user', 'UserController@getUserLogin');
    //ketika user belum login
    $router->get('login2', ['uses' => 'Controller@login']);
});

$router->group(['prefix' => 'beranda' , 'middleware' => 'user'], function() use ($router) {
    $router->get('login/user', 'UserController@getUserLogin');
    $router->get('index', ['uses' => 'Controller@index']);
    $router->get('logout', 'UserController@logout');
    // $router->post('register', ['uses' => 'AuthController@register']);
});






















//pengaturan route
$router->group(['prefix' => 'mst/pmb', 'middleware' => 'auth'], function() use ($router) {
    $router->get('users/login', 'UserController@getUserLogin2');
    //Modul PMB
    $router->group(['namespace' => 'Pmb'], function() use ($router) {
        //formulir
        $router->get('formulir', ['uses' => 'SimakMstPmbFormController@getPMBFormulir']);
        $router->get('formulir/{id}', ['uses' => 'SimakMstPmbFormController@getById']);
        $router->post('formulir', ['uses' => 'SimakMstPmbFormController@createFormulir']);
        $router->put('formulir/{id}', ['uses' => 'SimakMstPmbFormController@updatePMBFormulir']);

        //gelombang
        $router->get('gelombang', ['uses' => 'SimakMstPmbGelomController@getPMBGelombang']);
        $router->get('gelombang/{id}', ['uses' => 'SimakMstPmbGelomController@getById']);
        $router->Post('gelombang', ['uses' => 'SimakMstPmbGelomController@createGelombang']);
        $router->put('gelombang/{id}', ['uses' => 'SimakMstPmbGelomController@updatePMBGelombang']);

        //guru
        $router->get('guru', ['uses' => 'SimakMstPmbGuruController@getPMBGuru']);
        $router->get('guru/{id}', ['uses' => 'SimakMstPmbGuruController@getById']);
        $router->Post('guru', ['uses' => 'SimakMstPmbGuruController@createGuru']);
        $router->put('guru/{id}', ['uses' => 'SimakMstPmbGuruController@updatePMBGuru']);
        $router->delete('guru/{id}', ['uses' => 'SimakMstPmbGuruController@deletePMBGuru']);
    });
});

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
