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

/* PAGINA PRINCIPAL */
Route::get('/', 'IndexController@index')->middleware('paginaactiva');
Route::get('/inactive', 'IndexController@index'); 

/* LOGIN PARA INICIAR SESION */
Route::get('/iniciarSesion', 'InicioSesionController@index');


/* RUTAS PARA LOGUEAR/REGISTRAR USUARIO */
Auth::routes();

#Route::get('/home', 'HomeController@index')->middleware('auth');
/* PAGINA PRINCIPAL DEL USUARIO LOGUEADO */
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth','paginaactiva','usuarioactivo');
Route::get('/paginaPrincipal','UsuariosController@index')->middleware('auth','paginaactiva','usuarioactivo');

/* MANEJO DE USUARIOS */
Route::get('/usuarios/create', 'UsuariosController@create')->middleware('auth','permiso:usuario_new','paginaactiva','usuarioactivo');
Route::post('/usuarios', 'UsuariosController@store')->middleware('auth','permiso:usuario_new','paginaactiva','usuarioactivo');
Route::put('/usuarios/{id}', 'UsuariosController@update')->middleware('auth','permiso:usuario_update','paginaactiva','usuarioactivo');
Route::get('/usuarios/{id}/edit', 'UsuariosController@edit')->middleware('auth','permiso:usuario_update','paginaactiva','usuarioactivo');
Route::get('/usuarios/index/{condition?}/{username?}','UsuariosController@index')->name('usuarios')->middleware('auth','permiso:usuario_index','paginaactiva','usuarioactivo');
Route::get('/usuarios/{id}', 'UsuariosController@show')->middleware('auth','permiso:usuario_show','paginaactiva','usuarioactivo');
Route::get('/usuarios/{id}/destroy', 'UsuariosController@destroy')->middleware('auth','permiso:usuario_destroy','paginaactiva','usuarioactivo');
Route::get('/usuarios/{id}/lockOrUnlock', 'UsuariosController@lockOrUnlock')->middleware('auth','permiso:usuario_update','paginaactiva','usuarioactivo');
Route::get('/usuarios/{id}/assignOrUnassignRol', 'UsuariosController@assignOrUnassignRol')->middleware('auth','permiso:roles_usuario_update','paginaactiva','usuarioactivo');
Route::get('/usuarios/{userId}/assignRol/{rolId}', 'UsuariosController@assignRol')->middleware('auth','permiso:usuario_update','paginaactiva','usuarioactivo');
Route::get('/usuarios/{userId}/unassignRol/{rolId}', 'UsuariosController@unassignRol')->middleware('auth','permiso:usuario_update','paginaactiva','usuarioactivo');
Route::post('/usuarios/filter', 'UsuariosController@filter')->middleware('auth','permiso:usuario_index','paginaactiva','usuarioactivo');
#Route::resource('/usuarios','UsuariosController');

/* MANEJO DE PACIENTEES */
Route::get('/pacientes','PacientesController@index')->middleware('auth','permiso:paciente_index','paginaactiva','usuarioactivo');

/* MANEJO DE LA CONFIGURACION DEL SITIO */
Route::get('/configuracion','ConfiguracionController@index')->middleware('auth','permiso:configuracion','usuarioactivo');

