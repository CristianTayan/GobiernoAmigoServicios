<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/resetpassword/{email}','Usuario\UsuarioController@loadResetPassword')->name('resetpassword');
Route::post('/reset','Usuario\UsuarioController@resetPasswordForm')->name('reset');
Route::get('/pageBad','Usuario\UsuarioController@pageBad')->name('pageBad');
/**
 * 

Route::get('/', function () {
    return view('welcome');
    Route::get('/resetPassword/{email}','Usuario\UsuarioController@loadResetPassword')->name('resetPassword');
    Route::get('/pageBad','Usuario\UsuarioController@pageBad')->name('pageBad');
});

 */

// Route::get('/', function () {
//     return view('welcome');
// });

