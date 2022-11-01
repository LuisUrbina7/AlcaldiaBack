<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/publicacion', [PublicacionController::class, 'index'])->name('publicaciones');
Route::get('/publicacion/formulario', [PublicacionController::class, 'insertarVista'])->name('publicaciones.formulario');
Route::post('/publicacion/formulario/insertar', [PublicacionController::class, 'insertar'])->name('publicaciones.insertar');
Route::get('/publicacion/actualizar/{id}', [PublicacionController::class, 'actualizarVista'])->name('publicaciones.actualizar.vista');
Route::post('/publicacion/modificacion/{id}', [PublicacionController::class, 'actualizar'])->name('publicaciones.actualizar.insertar');
Route::get('/publicacion/borrar/{id}', [PublicacionController::class, 'borrar'])->name('publicar.borrar');

Route::get('/categoria', [CategoriasController::class, 'index'])->name('categorias');
Route::post('/categoria/formulario', [CategoriasController::class, 'insertar'])->name('categoria.insertar');
Route::get('/categoria/formulario/{id}', [CategoriasController::class, 'actualizarFormulario'])->name('categoria.actualizar.formulario');
Route::post('/categoria/modificacion/{id}', [CategoriasController::class, 'actualizar'])->name('categoria.actualizar.insertar');
Route::get('/categoria/borrar/{id}', [CategoriasController::class, 'borrar'])->name('categoria.borrar');

Route::get('/perfil', [UsuariosController::class, 'index'])->name('perfil');
Route::post('/perfil/actualizar/{id}', [UsuariosController::class, 'actualizarPerfil'])->name('perfil.actualizar');
Route::get('/usuarios', [UsuariosController::class, 'usuarios'])->name('usuarios');
Route::get('/usuarios/vista/{id}', [UsuariosController::class, 'usuarios_vista'])->name('usuarios.actualizar.formulario');
Route::post('/usuarios/actualizar/{id}', [UsuariosController::class, 'actualizar_usuario'])->name('usuarios.actualizar');
Route::get('/usuarios/borrar/{id}', [UsuariosController::class, 'borrar_usuario'])->name('usuarios.borrar');

/* Route::get('/categoria/formulario/{id}', [CategoriasController::class, 'actualizarFormulario'])->name('categoria.actualizar.formulario');
Route::post('/categoria/modificacion/{id}', [CategoriasController::class, 'actualizar'])->name('categoria.actualizar.insertar');
Route::get('/categoria/borrar/{id}', [CategoriasController::class, 'borrar'])->name('categoria.borrar');

 */