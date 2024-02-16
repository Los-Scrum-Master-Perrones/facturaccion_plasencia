<?php

use App\Http\Controllers\Pendiente\PendienteComprobarEmpaque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReporteDiarioController;
use App\Http\Livewire\Produccion\ProduccionEmpleado;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::get("/diarios","ReporteDiarioController@index")->name("diarios");
Route::get('diarios', [App\Http\Controllers\ReporteDiarioController::class, 'index']);
Route::get('diarios/sinprocesar', [App\Http\Controllers\ReporteDiarioController::class, 'sinProcesar']);
Route::get('diarios/detalle/{id}', [App\Http\Controllers\ReporteDiarioController::class, 'Scan']);
Route::post('diarios/guardardetalle', [App\Http\Controllers\ReporteDiarioController::class, 'store']);
Route::get('diarios/mostrardetalle/{fecha}', [App\Http\Controllers\ReporteDiarioController::class, 'MostrarDetalleDiarios']);
Route::get('diarios/mostrardetalle/total/{fecha}', [App\Http\Controllers\ReporteDiarioController::class, 'totaldiario']);
Route::get('diarios/mostrardetalle/act/{fecha}', [App\Http\Controllers\ReporteDiarioController::class, 'ActualizarProgramacionTerminado']);
Route::get('diarios/desaplicar/act/{fecha}', [App\Http\Controllers\ReporteDiarioController::class, 'DesaplicarProgramacionTerminado']);
Route::get('diarios/delete/{id}', [App\Http\Controllers\ReporteDiarioController::class, 'destroy']);
Route::post('diarios/existenciasempaque', [App\Http\Controllers\ReporteDiarioController::class, 'inventarioempaque']);
Route::get('diarios/existenciasempaque/total', [App\Http\Controllers\ReporteDiarioController::class, 'inventarioempaquetotal']);
Route::get('diarios/fechaaingresar', [App\Http\Controllers\ReporteDiarioController::class, 'consultarProceso']);
Route::get('diarios/editable/{fecha}', [App\Http\Controllers\ReporteDiarioController::class, 'editable']);
Route::post('diarios/guardaregistrodiario', [App\Http\Controllers\ReporteDiarioController::class, 'guardaregistrodiario']);


Route::get('pendiente/empaque/{id}', [PendienteComprobarEmpaque::class, 'mostra_detalles_pendiente_empaque'])->name('traer.noexistentes.pendiente_empaque');
Route::get('pendiente/empaque/agregar/{id}', [PendienteComprobarEmpaque::class, 'agregar_detalles_pendiente_empaque'])->name('agregar.noexistentes.pendiente_empaque');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    //return $request->user();
});


// ruta para produccion
Route::get('emplados/{activo}', [ProduccionEmpleado::class, 'empledos_activos']);
Route::post('empleado/crud/{id}', [ProduccionEmpleado::class, 'funciones_crud']);
