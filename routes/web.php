<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CapaProductoController;

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



Route::post('/importar_clase', [CapaProductoController::class, 'import']);
Route::get('/importar_clase', [CapaProductoController::class, 'import']);


Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//rutas melvin
Route::get('/', [App\Http\Controllers\TableditController::class, 'index'])->name('tabla');

Route::post('/', [App\Http\Controllers\TableditController::class, 'buscar'])->name('buscar');
Route::post('tabledit/action', [App\Http\Controllers\TableditController::class, 'action'])->name('tabledit.action');
Route::get('/principal', [App\Http\Controllers\Principal::class, 'index'])->name('principal');;