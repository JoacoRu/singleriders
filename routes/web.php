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
Route::get('/travel','TravelController@show');
Route::post('/travel', 'TravelController@validator');
/**Ruta para ver todos lost viajes */
Route::get('/allTravel', 'TravelController@getAllTravels');
/**Ruta para ver mis viajes */
Route::get('/myTravel', 'TravelController@getMyTravels');
/** Ruta para viajes compartidos */
Route::get('/sharedTravel','TravelController@allTravels');
/**ruta para las acciones de seguidos */

Route::post('/allTravel', 'FollowersController@follows');


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
Route::post('/profilePost', 'ProfileController@store');
Route::get('/profile', 'ProfileController@getAllPost');
Route::post('/profileLike', 'ProfileController@insertLike');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sharedTravel', function () {
    return view('sharedTravel');
});

Route::get('/search', 'SearchController@viewSearch');
Route::get('/searchH', 'SearchController@search');
