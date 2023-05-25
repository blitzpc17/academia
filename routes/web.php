<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PersonasController as Personas;
use App\Http\Controllers\EstudiantesController as Estudiantes;
use App\Http\Controllers\DocentesController as docentes;
use App\Http\Controllers\UsuariosController as usuarios;
use App\Http\Controllers\MateriasController as materias;
use App\Http\Controllers\TiposController as tipo;
use App\Http\Controllers\AsignacionController as asignacion;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ActividadesDocentesController as actividadesdoc;
use App\Http\Controllers\ActividadesEstudiantesController as actividadesest;
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
})->name('login');

Route::post('auth', [LoginController::class, 'authenticate'])->name('us.auth');
Route::get('logauth', [LoginController::class, 'logout'])->name('us.logout');


Route::get('/', [MainController::class, 'Index'])->name('admin.index')->middleware('auth');

Route::prefix('admin')->group(function(){

    Route::get('personas/listar', [Personas::class, 'Listar'])->name('personas.listar');

    Route::get('estudiantes', [Estudiantes::class, 'Index'])->name('estudiantes')->middleware('sistema');;
    Route::get('estudiantes/listar', [Estudiantes::class, 'Listar'])->name('estudiantes.listar');
    Route::post('estudiantes/save', [Estudiantes::class, 'Save'])->name('estudiantes.save');
    Route::get('estudiantes/obtener', [Estudiantes::class, 'Obtener'])->name('estudiantes.obtener');
    Route::get('estudiantes/baja', [Estudiantes::class, 'Baja'])->name('estudiantes.baja');

    Route::get('docentes', [docentes::class, 'Index'])->name('docentes')->middleware('sistema');
    Route::get('docentes/listar', [docentes::class, 'Listar'])->name('docentes.listar');
    Route::post('docentes/save', [docentes::class, 'Save'])->name('docentes.save');
    Route::get('docentes/obtener', [docentes::class, 'Obtener'])->name('docentes.obtener');
    Route::get('docentes/baja', [docentes::class, 'Baja'])->name('docentes.baja');


    Route::get('usuarios', [usuarios::class, 'Index'])->name('usuarios')->middleware('sistema');;
    Route::get('usuarios/listar', [usuarios::class, 'Listar'])->name('usuarios.listar');
    Route::post('usuarios/save', [usuarios::class, 'Save'])->name('usuarios.save');
    Route::get('usuarios/obtener', [usuarios::class, 'Obtener'])->name('usuarios.obtener');
    Route::get('usuarios/baja', [usuarios::class, 'Baja'])->name('usuarios.baja');


    Route::get('materias', [materias::class, 'Index'])->name('materias')->middleware('sistema');;
    Route::get('materias/listar', [materias::class, 'Listar'])->name('materias.listar');
    Route::post('materias/save', [materias::class, 'Save'])->name('materias.save');
    Route::get('materias/obtener', [materias::class, 'Obtener'])->name('materias.obtener');
    Route::get('materias/baja', [materias::class, 'Baja'])->name('materias.baja');



    Route::get('asignacion', [asignacion::class, 'Index'])->name('asignacion')->middleware('sistema');;
    Route::get('asignacion/listar', [asignacion::class, 'Listar'])->name('asignacion.listar');
    Route::post('asignacion/save', [asignacion::class, 'Save'])->name('asignacion.save');
    Route::get('asignacion/obtener', [asignacion::class, 'Obtener'])->name('asignacion.obtener');
    Route::get('asignacion/baja', [asignacion::class, 'Eliminar'])->name('asignacion.eliminar');
    Route::get('asignacion/docentes/listar', [asignacion::class, 'ListarMateriasDocentes'])->name('asignacion.docentes.listar');


    Route::get('tipo', [tipo::class, 'Index'])->name('tipo')->middleware('sistema');;
    Route::get('tipo/listar', [tipo::class, 'Listar'])->name('tipo.listar');
    Route::post('tipo/save', [tipo::class, 'Save'])->name('tipo.save');
    Route::get('tipo/obtener', [tipo::class, 'Obtener'])->name('tipo.obtener');
    Route::get('tipo/baja', [tipo::class, 'Baja'])->name('tipo.baja');

});


Route::prefix('docentes')->group(function(){   

    Route::get('actividadesdoc', [actividadesdoc::class, 'Index'])->name('actividadesdoc')->middleware('docente');;
    Route::get('actividadesdoc/listar', [actividadesdoc::class, 'Listar'])->name('actividadesdoc.listar');
    Route::post('actividadesdoc/save', [actividadesdoc::class, 'Save'])->name('actividadesdoc.save');
    Route::get('actividadesdoc/obtener', [actividadesdoc::class, 'Obtener'])->name('actividadesdoc.obtener');
});


Route::prefix('estudiantes')->group(function(){   

    Route::get('actividadesest', [actividadesest::class, 'Index'])->name('actividadesest')->middleware('estudiante');
    Route::get('actividadesest/listar', [actividadesest::class, 'Listar'])->name('actividadesest.listar');
    Route::post('actividadesest/save', [actividadesest::class, 'Save'])->name('actividadesest.save');
    Route::get('actividadesest/obtener', [actividadesest::class, 'Obtener'])->name('actividadesest.obtener');
    Route::get('actividadesest/examen', [actividadesest::class, 'Examenes'])->name('actividadesest.examen')->middleware('estudiante');
    Route::post('actividadesest/examen/save', [actividadesest::class, 'ExamenesSend'])->name('actividadesest.examen.save');
});