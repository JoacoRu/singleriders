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
Route::get('/', 'StaticController@index');
/** Rutas para  crear los viajes */
Route::get('/travel','TravelController@show');
Route::post('/travel', 'TravelController@store');
/**Ruta para ver todos lost viajes */
Route::get('/allTravel', 'TravelController@getAllTravels');
/**Ruta para ver mis viajes */
Route::get('/myTravel', 'TravelController@getMyTravels');
/** Ruta para viajes compartidos */
Route::get('/sharedTravel','TravelController@allTravels');
Route::get('/sharedTravel/{travel_id}', 'FollowersController@allSharedTravel');
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
Route::post('/profile', 'ProfileController@store');
Route::get('/profile', 'ProfileController@getAllPost');
/* Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    
}); */
Route::post('/profileLike', 'ProfileController@insertLike');
Route::get('/profileBringLike', 'ProfileController@bringLike');
Route::get('/profileDislike', 'ProfileController@getAllPostJson');
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/sharedTravel', function () {
    return view('sharedTravel');
});
Route::get('/search', 'SearchController@viewSearch');
Route::get('/search', 'SearchController@search');
Route::get('/searchResult/{id}', 'SearchController@bringAll');
Route::post('/searchResult/{id}', 'ProfileController@insertLike');
