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

//login
$router->get('api/login', ['uses' => 'LoginController@index']);
$router->post('api/login', ['uses' => 'LoginController@login']);

//pengaturan route
$router->group(['prefix' => 'api','middleware' => 'auth'], function() use ($router) {
        
    //Layanan Dosen
    $router->group(['namespace' => 'Dosen'], function() use ($router) {
        $router->get('dosen', ['uses' => 'dosenController@index']);
    });
    //Modul PMB
    $router->group(['namespace' => 'Pmb'], function() use ($router) { 
        $router->get('pengguna', ['uses' => 'jalakPenggunaController@index']);
        $router->get('mahasiswa', ['uses' => 'mahasiswaController@index']);
        $router->get('mahasiswa/{id}', ['uses' => 'mahasiswaController@show']);
        $router->post('mahasiswa', ['uses' => 'mahasiswaController@create']);
        $router->delete('mahasiswa/{id}', ['uses' => 'mahasiswaController@destroy']);
        $router->put('mahasiswa/{id}', ['uses' => 'mahasiswaController@update']);
    });    
});

// $router->group(['prefix' => 'api', 'middleware' => 'auth'], function() use ($router){
//     //vid 4
//     //nama model kiri memanggil, kanan dipanggil controller namakelas@namaFunction
//     //KategoriModel
//     $router->get('kategori',['uses' => 'KategoriController@index']);
//     $router->get('kategori/{id}',['uses' => 'KategoriController@show']);
//     $router->post('kategori',['uses' => 'KategoriController@create']);
//     $router->delete('kategori/{id}',['uses' => 'KategoriController@destroy']);
//     $router->put('kategori/{id}',['uses' => 'KategoriController@update']);
    
//     //PelangganModel
//     $router->get('pelanggan',['uses' => 'PelangganController@index']);
//     $router->get('pelanggan/{id}',['uses' => 'PelangganController@show']);
//     $router->post('pelanggan',['uses' => 'PelangganController@create']);
//     $router->delete('pelanggan/{id}',['uses' => 'PelangganController@destroy']);
//     $router->put('pelanggan/{id}',['uses' => 'PelangganController@update']);

//     //Menu
//     $router->post('menu',['uses' => 'MenuController@create']);
//     $router->get('menu',['uses' => 'MenuController@index']);
//     $router->get('menu/{id}',['uses' => 'MenuController@show']);
//     $router->delete('menu/{id}',['uses' => 'MenuController@destroy']);
//     $router->put('menu/{id}',['uses' => 'MenuController@update']);
// });