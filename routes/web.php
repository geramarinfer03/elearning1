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
	Route::get('/', 'PagesController@index')->name('inicio');
	Route::get('login', 'Auth\LoginController@showLoginForm');
	Route::post('login','Auth\LoginController@login')->name('login'); 
	// Registration routes...
	Route::get('registrarse', 'Auth\RegisterController@showRegistrationForm');
	Route::post('registrarse', ['as' => 'registrarse', 'uses' => 'Auth\RegisterController@register']);

});

// Authentication Routes
//Auth::routes();
Route::group(['middleware' => 'auth'], function () {

	Route::get('/home', 'IndexController@home')->name('home');
	Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
	Route::get('misCursos', 'CursoController@misCursos')->name('misCursos');

	Route::post('crearMatricula', 'MatriculaController@store');


});


Route::group( ['middleware'=>['auth','admin']], function() {

	Route::get('usuarios', 'UsuarioController@listado_usuarios')->name('usuarios');
	Route::get('form_editar_usuario/{id}', 'UsuarioController@form_editar_usuario');
 	Route::post('editar_usuario', 'UsuarioController@editar_usuario');
 	Route::post('editar_matricula', 'MatriculaController@update');
 	Route::get('matricularUsuario/{id}', 'MatriculaController@matriculaForm');
	


	Route::get('cursos.create', 'CursoController@create');
	Route::post('cursos', 'CursoController@store');
	Route::get('cursos.edit/{id}', 'CursoController@edit');
	Route::post('cursos.update', 'CursoController@update');

	/*Route::get('cursos', 'CursoController@index');
	Route::get('cursos_create', 'CursoController@create');
	Route::post('cursos_store', 'CursoController@store');*/

});

/* ------ Cursos rutas ------------------- */

Route::get('cursos.index', 'CursoController@index');
Route::get('cursos.show/{id}', 'CursoController@show');

Route::group(['middleware'=>['profe']], function() {
	Route::post('recursos.store', 'RecursoController@store');
	Route::post('recursos.update', 'RecursoController@update');
	Route::post('recursos.updateArchivo', 'UploadController@UpdateArchivo');
	Route::post('recursos.tarea', 'RecursoController@tarea');
    
    
	Route::get('editarRecurso/{id}','RecursoController@edit');
	Route::get('editarRecursoArchivo/{id}','RecursoController@editArchivo');
	Route::get('crearRecursoSemana/{id}/{curso}','RecursoController@crearRecursoSemana');
	Route::get('crearRecurso/{id}/{curso}','RecursoController@crearRecurso'); //crea recurso en seccion
});


Route::post('guardarNombreSemana', 'RecursoController@setNameWeek')->name('guardarNombreSemana');

/*------ Recursos rutas ----- */ 

//Route::get('updateDrag/{r}','RecursoController@updateDrag')->name('updateDrag');

Route::post('updateDrag','RecursoController@updateDrag');



//Route::post('updateRecurso','RecursoController@update');
//Route::get('createRecurso','RecursoController@create');
//Route::post('storeCurso','RecursoController@store');


Route::post('archivos.upload', 'UploadController@upload');

Route::get('dwlImg/{id}', 'UploadController@downloadImageIns');
Route::post('download', 'UploadController@getDownload');

Route::post('downloadVideo', 'UploadController@downloadVideo');




/*Route::get('cursos', 'CursoController@index');
Route::get('cursos_create', 'CursoController@create');
Route::post('cursos_store', 'CursoController@store');*/

Route::post('tareas.formulario','TareaController@crearFormulario');
Route::post('tareas.crearTarea','TareaController@crearTarea');
Route::post('tareas.buscarTarea', 'TareaController@formularioAsignado');
Route::get('showCrearForm/{curso}/{tarea}', 'TareaController@showCrearForm');
Route::post('subirTarea/{id_tarea}/{id_curso}','RecursoController@uploadTask');
