<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 *

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    Route::get('store1', 'Usuario\UsuarioController@store1');
    Route::post('authenticateUser','Usuario\UsuarioController@authenticateUser');
    Route::post('getConnection','Usuario\UsuarioController@getConnection');
});*/

    Route::group(['prefix' => 'auth'], function () {
        Route::get('/resetPassword/{email}','Usuario\UsuarioController@loadResetPassword')->name('resetPassword');
        Route::get('store1', 'Usuario\UsuarioController@store1');
        Route::post('authenticateUser','Usuario\UsuarioController@authenticateUser');
        Route::post('registrarUsuario','Usuario\UsuarioController@registrarUsuario');
        Route::post('updateUsuario','Usuario\UsuarioController@updateUsuario');
        Route::post('update','Denuncia\DenunciaController@create');
        Route::post('getDenuncias','Denuncia\DenunciaController@getDenuncias');
        Route::post('getDenunciasCount','Denuncia\DenunciaController@getDenunciasCount');
        Route::post('readReporteUsuarioDenuncias','Denuncia\DenunciaController@readReporteUsuarioDenuncias');
        Route::post('usuarioByEmail','Usuario\UsuarioController@usuarioByEmail');
        Route::post('usuarioByMovil','Usuario\UsuarioController@usuarioByMovil');
        Route::post('resetPassword','Usuario\UsuarioController@resetPassword');
        Route::post('getConnection','Usuario\UsuarioController@getConnection');
        Route::post('getTipos','Tipo\TipoController@getTipos');
        Route::post('getCategorias','Categoria\CategoriaController@getCategorias');
        Route::post('updateDenunciaRest','Externo\ExternoController@updateDenunciaRest');

    });

    Route::apiResource('/gobusuario','Usuario\UsuarioController');
