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

/*Route::get('/', function () {
    return view('welcome');
});
*/
/*
Route::get('/', function () {
    return View::make('welcome');
});

//Route::resource('mantenimientos/subcarpeta','Controlador');

Route::get('/hola', function()	{
	return 'Hola !';

});*/



//rutas accessibles slo si el usuario no se ha logueado
Route::group(['middleware' => 'guest'], function () {
	Route::get('/', 'PagesController@index');
	Route::get('login', 'Auth\LoginController@showLoginForm');
	Route::post('login', ['as' =>'login', 'uses' => 'Auth\LoginController@login']); 
	// Registration routes...
	Route::get('registrarse', 'Auth\RegisterController@showRegistrationForm');
	Route::post('registrarse', ['as' => 'registrarse', 'uses' => 'Auth\RegisterController@register']);
});

Route::group(['middleware' => 'auth'], function () {

	Route::get('/home', 'PagesController@home');


});

/* ------ Cursos rutas ------------------- */
Route::get('cursos', 'CursoController@index');
Route::get('cursos_create', 'CursoController@create');
Route::post('cursos_store', 'CursoController@store');