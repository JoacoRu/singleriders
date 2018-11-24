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

/** Rutas para  crear los viajes */
Route::get('/travel','travelController@show');
Route::post('/travel', 'travelController@store');
/**Ruta para ver todos los viajes */
Route::get('/allTravel', 'travelController@getAllTravels');
/**Ruta para ver mis viajes */
Route::get('/myTravel', 'travelController@getMyTravels');

//Rutas paginas Estaticas//
Route::get('/faqs', function(){
    return view('statics/faqs'); //lo hice asi porque no tiene logica y no necesita un controller)//
});
Route::get('/home', 'StaticController@index'); //este si necesita controller, porque tiene logica de todos lados! //


Route::get('/mensajes', 'MessageController@obtenerMensaje');
Route::post('/mensajes', 'MessageController@storeMensaje');

Route::get('/edit_profile', 'EditProfileController@show');
Route::post('/edit_profile', 'EditProfileController@validator');

Route::get('/profile', 'ProfileController@showView');
Route::post('/profile', 'ProfileController@store');
Route::get('/profileAjaxGet', 'ProfileController@getAllPost');
Route::post('/profileLike', 'ProfileController@insertLike');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sharedTravel', function () {
    return view('sharedTravel');
});

Route::get('/search', 'SearchController@viewSearch');
Route::get('/searchH', 'SearchController@search');
