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
    Route::post('login', 'AuthController@login')->middleware('cors');
    Route::post('register', 'AuthController@signup')->middleware('cors');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout')->middleware('cors');
        Route::get('user', 'AuthController@user')->middleware('cors');

        Route::post('changeprofileavatar', 'AuthController@changeProfileAvatar')->middleware('cors');
        Route::post('userupdate', 'AuthController@userUpdate')->middleware('cors');
    });
});
//rutas para crear y eliminar posteos
Route::post('crearpost', 'PostController@store')->middleware('auth:api')->middleware('cors');
Route::post('eliminarpost', 'PostController@destroy')->middleware('auth:api')->middleware('cors');
//rutas para obtener posteos
Route::get('postusuario', 'PostController@obtenerPost')->middleware('auth:api')->middleware('cors');
Route::get('posteosusuarios', 'PostController@obtenerAllPost')->middleware('auth:api')->middleware('cors');

//rutas para probar sin estar logueado
Route::get('tstposteosusuarios', 'PostController@obtenerAllPost')->middleware('cors');


//rutas para los viajes falta terminar
Route::post('crearviaje', 'TravelController@store')->middleware('auth:api')->middleware('cors');
Route::post('eliminarviaje', 'TravelController@destroy')->middleware('auth:api')->middleware('cors');
//rutas para obtener posteos
Route::get('viajeusuario', 'TravelController@getTravel')->middleware('auth:api')->middleware('cors');
Route::get('viajesusuarios', 'TravelController@getAllTravel')->middleware('auth:api')->middleware('cors');
