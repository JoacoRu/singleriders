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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/travel','travelController@create');
Route::post('/travel', 'travelController@store');

//Rutas paginas Estaticas//
Route::get('/faqs', function(){
    return view('statics/faqs'); //lo hice asi porque no tiene logica y no necesita un controller)//
});
Route::get('/home', 'staticController@index'); //este si necesita controller, porque tiene logica de todos lados! //

Route::get('/profile', 'HomeController@profile');

Route::get('/mensajes', 'MessageController@obtenerMensaje');
Route::post('/mensajes', 'MessageController@storeMensaje');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
