<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PersonasController as Personas;
use App\Http\Controllers\EstudiantesController as Estudiantes;
use App\Http\Controllers\DocentesController as docentes;
use App\Http\Controllers\UsuariosController as usuarios;
use App\Http\Controllers\MateriasController as materias;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login', function () {
    return view('login');
});

Route::post('auth', [LoginController::class, 'authenticate'])->name('us.auth');
Route::get('logauth', [LoginController::class, 'logout'])->name('us.logout');



Route::get('/', [MainController::class, 'Index'])->name('admin.index');

Route::get('personas/listar', [Personas::class, 'Listar'])->name('personas.listar');

Route::get('estudiantes', [Estudiantes::class, 'Index'])->name('estudiantes');
Route::get('estudiantes/listar', [Estudiantes::class, 'Listar'])->name('estudiantes.listar');
Route::post('estudiantes/save', [Estudiantes::class, 'Save'])->name('estudiantes.save');
Route::get('estudiantes/obtener', [Estudiantes::class, 'Obtener'])->name('estudiantes.obtener');
Route::get('estudiantes/baja', [Estudiantes::class, 'Baja'])->name('estudiantes.baja');

Route::get('docentes', [docentes::class, 'Index'])->name('docentes');
Route::get('docentes/listar', [docentes::class, 'Listar'])->name('docentes.listar');
Route::post('docentes/save', [docentes::class, 'Save'])->name('docentes.save');
Route::get('docentes/obtener', [docentes::class, 'Obtener'])->name('docentes.obtener');
Route::get('docentes/baja', [docentes::class, 'Baja'])->name('docentes.baja');


Route::get('usuarios', [usuarios::class, 'Index'])->name('usuarios');
Route::get('usuarios/listar', [usuarios::class, 'Listar'])->name('usuarios.listar');
Route::post('usuarios/save', [usuarios::class, 'Save'])->name('usuarios.save');
Route::get('usuarios/obtener', [usuarios::class, 'Obtener'])->name('usuarios.obtener');
Route::get('usuarios/baja', [usuarios::class, 'Baja'])->name('usuarios.baja');


Route::get('materias', [materias::class, 'Index'])->name('materias');
Route::get('materias/listar', [materias::class, 'Listar'])->name('materias.listar');
Route::post('materias/save', [materias::class, 'Save'])->name('materias.save');
Route::get('materias/obtener', [materias::class, 'Obtener'])->name('materias.obtener');
Route::get('materias/baja', [materias::class, 'Baja'])->name('materias.baja');

