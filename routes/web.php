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


//AuthController
$router->group(['prefix' => 'api/auth', 'middleware' => 'auth'], function() use ($router) {
    $router->get('/', ['uses' => 'AuthController@index']);
    $router->get('register', ['uses' => 'AuthController@register']);
    $router->post('login', ['uses' => 'AuthController@login']);
});


//pengaturan route
$router->group(['prefix' => 'api','middleware' => 'auth'], function() use ($router) {
        
    //Layanan Dosen
    $router->group(['namespace' => 'Dosen'], function() use ($router) {
        $router->get('dosen', ['uses' => 'DosenController@index']);
        $router->get('show', ['uses' => 'DosenController@show']);
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
