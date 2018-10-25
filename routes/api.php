<?php

use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//rutas api/auth/login, api/auth/register, api/auth/logout, api/auth/user
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');

        Route::post('changeprofileavatar', 'AuthController@changeProfileAvatar');
        Route::post('userupdate', 'AuthController@userUpdate');
    });
});
//rutas para crear y eliminar posteos
Route::post('crearpost', 'PostController@store')->middleware('auth:api');
Route::post('eliminarpost', 'PostController@destroy')->middleware('auth:api');
//rutas para obtener posteos
Route::get('postusuario', 'PostController@obtenerPost')->middleware('auth:api');
Route::get('posteosusuarios', 'PostController@obtenerAllPost')->middleware('auth:api');

//rutas para los viajes falta terminar
Route::post('crearviaje', 'TravelController@store')->middleware('auth:api');
Route::post('eliminarviaje', 'TravelController@destroy')->middleware('auth:api');
//rutas para obtener posteos
Route::get('viajeusuario', 'TravelController@getTravel')->middleware('auth:api');
Route::get('viajesusuarios', 'TravelController@getAllTravel')->middleware('auth:api');
