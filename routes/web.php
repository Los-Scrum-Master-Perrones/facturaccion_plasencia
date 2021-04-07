<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\PedidoController;

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

 Route::get('/import_excel', [ImportExcelController::class, 'index']);


Route::post('/import', [VehicleController::class, 'import']);



Route::post('/importar_pedido', [PedidoController::class, 'import']);


Route::get('/importar_pedido', [PedidoController::class, 'import']);


Route::get('/', function () {
    return view('welcome');
});