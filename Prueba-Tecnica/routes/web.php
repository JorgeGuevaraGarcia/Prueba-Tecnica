<?php

use App\Http\Controllers\FormularioController;
use App\Models\Formulario;
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
// Ruta para direccionamiento a la vista del formulario
Route::get('/',[FormularioController::class,'create'])->name('formulario.create');
// Ruta para enviar datos al servidor
Route::post('/formulario', [FormularioController::class,'store'])->name('formulario.store');
// Ruta para mostrar los pdf alamacenados
Route::get('/formulario',[FormularioController::class,'show'])->name('formulario.show');
// Ruta para eliminar el pdf
Route::delete('/borrar/{formulario}', [FormularioController::class,'destroy'])->name('formulario.destroy');
// Ruta para previsualizar el pdf
Route::get('/formulario/archivo/{nombre_archivo}', [FormularioController::class, 'urlArchivo'])->name('formulario.archivo');
