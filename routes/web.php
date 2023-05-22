<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EstudiantesController as Estudiantes;
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

Route::get('/', function () {
    return view('Admin.main');
});


Route::get('estudiantes', [Estudiantes::class, 'Index'])->name('estudiantes');
Route::get('estudiantes/listar', [Estudiantes::class, 'Listar'])->name('estudiantes.listar');
Route::post('estudiantes/save', [Estudiantes::class, 'Save'])->name('estudiantes.save');
Route::get('estudiantes/obtener', [Estudiantes::class, 'Obtener'])->name('estudiantes.obtener');
Route::get('estudiantes/baja', [Estudiantes::class, 'Baja'])->name('estudiantes.baja');

