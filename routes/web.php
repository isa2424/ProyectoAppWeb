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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('auth.login');
});
//Route::resource('Admin/Aprendizaje/Dashboard','AdminController');
Route::resource('Admin/Aprendizaje/Categoria','CategoriaController');



Route::get('Admin/Aprendizaje/Dashboard', 'AdminController@index')->name('admin.index');
Route::put('Admin/Aprendizaje/Dashboard', 'AdminController@index1')->name('admin1.index');
Route::get('Admin/Aprendizaje/Persona', 'PersonaController@viewAllUser')->name('persona.index');
Route::post('/updateUser/{id}','ActualizacionRapidaController@ActualizacionRapidaPersona')->name('persona.quick');
Route::get('Admin/Aprendizaje/Persona/{id}','PersonaController@editar')->name('persona.edit');
Route::get('Admin/Aprendizaje/Instructor/{id}','InstructorController@editar')->name('instructor.edit');
Route::put('/edit1/{id}','InstructorController@ActualizarInstructor')->name('instructor.update');
Route::put('/edit/{id}','PersonaController@Actualizar')->name('persona.update');

Route::post('/updateCategoria/{id}','ActualizacionRapidaController@ActualizacionRapidaCategoria')->name('categoria.quick');
Route::post('/updateCurso/{id}','ActualizacionRapidaController@ActualizacionRapidaCurso')->name('curso.quick');

Route::get('Admin/Aprendizaje/Aprobados', 'PersonaController@PersonasAprovadas')->name('aprobados.index');
Route::get('Admin/Aprendizaje/Progreso', 'PersonaController@ProgresoPersonas')->name('progreso.index');




Route::get('Admin/Aprendizaje/Cursos/Curso','CursoController@viewAllCurso')->name('curso.index');
Route::get('Admin/Aprendizaje/Cursos/Curso/{id}','CursoController@showCourse')->name('curso.show');
Route::get('Admin/Aprendizaje/Cursos/Curso/Contenido/{id}','CursoController@showContenido')->name('contenido.show');
Route::put('/edit4/{id}','CursoController@ActualizarContenido')->name('curso.contenido.update');


Route::post('/guardarpreguntacurso','CursoController@GuardarPregunta')->name('curso.pregunta.guardar');
Route::get('Admin/Aprendizaje/Cursos/Curso/Pregunta/{id}','CursoController@showPregunta')->name('pregunta.show');
Route::delete('/eliminar/{id}','CursoController@EliminarPregunta')->name('curso.pregunta.delete');
Route::put('/ActualizarPregunta/{id}','CursoController@ActualizarPregunta')->name('curso.preguntas.update');


Route::post('/guardaropcionescurso','CursoController@GuardarOpciones')->name('curso.opciones.guardar');
Route::get('Admin/Aprendizaje/Cursos/Curso/Opcion/{id}/{idcurso}','CursoController@showOpcion')->name('opcion.show');
Route::delete('/eliminar1/{id}/{idcurso}','CursoController@EliminarOpcion')->name('curso.opcion.delete');
Route::put('/ActualizarOpcion/{id}','CursoController@ActualizarOpcion')->name('curso.opcion.update');


Route::put('/edit3/{id}','CursoController@Actualizar')->name('curso.update');



Route::get('Admin/Aprendizaje/Cursos/Categoria','CategoriaController@viewAllCategoria')->name('categoria.index');

Route::get('Admin/Aprendizaje/Cursos/Categoria/{id}','CategoriaController@ShowCategoria')->name('categoria.show');
Route::put('/edit2/{id}','CategoriaController@Actualizar')->name('categoria.update');
Route::post('/guardar','CategoriaController@Guardar')->name('categoria.guardar');

Route::post('/guardarcurso','CursoController@Guardar')->name('curso.guardar');
Route::post('/guardarcontenidocurso','CursoController@GuardarContenido')->name('curso.contenido.guardar');


Route::get('Admin/Aprendizaje/Instructor','InstructorController@viewAllInstructor')->name('instructor.index');
Route::get('Admin/Aprendizaje/Notificaciones_Push','OneSignalNotificationController@index')->name('onesignal.settings');

Route::post('Admin/Aprendizaje/Notificaciones_Push','OneSignalNotificationController@push')->name('admin.push.notif');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
