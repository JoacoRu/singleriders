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
Route::get('allTravel', function () {
    return view('allTravel');
});
Route::get('/allTravel', 'allTravelController@getAllTravels');
Route::get('/travel','travelController@create');
Route::post('/travel', 'travelController@store');

//Rutas paginas Estaticas//
Route::get('/faqs', function(){
    return view('statics/faqs'); //lo hice asi porque no tiene logica y no necesita un controller)//
});
Route::get('/home', 'staticController@index'); //este si necesita controller, porque tiene logica de todos lados! //


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
