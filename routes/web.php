<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CapaProductoController;
use App\Http\Controllers\clase_producto;
use App\Http\Controllers\PendienteController;
use App\Http\Controllers\programacion;

use App\Http\Controllers\tabla_existencia;

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

 Route::get('/import_excel', [ImportExcelController::class, 'index'])->name('import_excel');


Route::post('/import', [VehicleController::class, 'import']);



Route::post('/importar_pedido', [PedidoController::class, 'import']);
Route::get('/importar_pedido', [PedidoController::class, 'import']);


Route::get('/productos', [PedidoController::class, 'productos_index'])->name('productos');
Route::post('/productos', [PedidoController::class, 'productos_index'])->name('productos');


Route::get('/insertar_productos', [clase_producto::class, 'insertar_clase'])->name('nuevo_producto');
Route::post('/insertar_productos', [clase_producto::class, 'insertar_clase'])->name('nuevo_producto');


Route::get('/insertar_detalle_productos', [clase_producto::class, 'insertar_detalle_clase'])->name('detalle');
Route::post('/insertar_detalle_productos', [clase_producto::class, 'insertar_detalle_clase'])->name('detalle');


Route::get('/mostrar_detalle_productos', [clase_producto::class, 'insertar_detalle_clase'])->name('detalle_producto');
Route::post('/mostrar_detalle_productos', [clase_producto::class, 'insertar_detalle_clase'])->name('detalle_producto');

Route::post('/importar_clase', [CapaProductoController::class, 'import']);
Route::get('/importar_clase', [CapaProductoController::class, 'import']);


Route::get('/pendiente', [PendienteController::class, 'pendiente_index'])->name('pendiente');
Route::post('/pendiente', [PendienteController::class, 'pendiente_indexi'])->name('pendiente');


Route::get('/pendiente_empaque', [PendienteController::class, 'index_pendiente_empaque'])->name('pendiente_empaque');
Route::post('/pendiente_empaque', [PendienteController::class, 'index_pendiente_empaque'])->name('pendiente_empaque');



Route::get('/pendiente_buscar', [PendienteController::class, 'buscar'])->name('buscar_pendiente');
Route::post('/pendiente_buscar', [PendienteController::class, 'buscar'])->name('buscar_pendiente');

Route::get('/programacion', [programacion::class, 'index'])->name('programacion');
Route::post('/programacion', [programacion::class, 'index'])->name('programacion');



Route::get('/producto', [tabla_existencia::class, 'import'])->name('codigo');
Route::post('/producto', [tabla_existencia::class, 'import'])->name('codigo');


Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/productos', [App\Http\Controllers\PedidoController::class, 'productos_index'])->name('productos');
Route::post('/productos', [App\Http\Controllers\PedidoController::class, 'productos_index'])->name('productos');;

//rutas melvin
Route::get('/', [App\Http\Controllers\TableditController::class, 'index'])->name('tabla');

Route::post('/', [App\Http\Controllers\TableditController::class, 'buscar'])->name('buscar');
Route::post('tabledit/action', [App\Http\Controllers\TableditController::class, 'action'])->name('tabledit.action');
Route::get('/principal', [App\Http\Controllers\Principal::class, 'index'])->name('principal');


//USERS
Route::post('/usuarios/d',[App\Http\Controllers\Users::class, 'update' ])->name('actualizar_usuario');
Route::post('/usuarios/a',[App\Http\Controllers\Users::class, 'destroy' ])->name('eliminar_usuario');
Route::post('usuarios/contra', [App\Http\Controllers\Users::class,'update_contrasenia'])->name('actualizar_usuario_contrasenia');
Route::get('/usuarios',[App\Http\Controllers\Users::class, 'index' ])->name('usuarios');


//cajas

Route::get('/index_importar_cajas', [App\Http\Controllers\CajasController::class, 'index_importar'])->name('index_importar_cajas');
Route::get('/index_bodega', [App\Http\Controllers\CajasController::class, 'index_bodega'])->name('index_bodega');
Route::get('/index_lista_cajas', [App\Http\Controllers\CajasController::class, 'index_lista'])->name('index_lista_cajas');
Route::post('/editaryeliminarlista', [App\Http\Controllers\CajasController::class, 'editaryeliminarlista'])->name('editaryeliminarlista');


Route::post('/buscar_lista_cajas', [App\Http\Controllers\CajasController::class, 'buscar_lista_cajas'])->name('buscar_lista_cajas');
Route::post('/agregar_lista_caja', [App\Http\Controllers\CajasController::class, 'agregar_lista_caja'])->name('agregar_lista_caja');

Route::post('/importar_cajas', [App\Http\Controllers\CajasController::class, 'import'])->name('importar_cajas');
Route::get('/importar_cajas', [App\Http\Controllers\CajasController::class, 'import'])->name('importar_cajas');

Route::post('/importar_inv_cajas', [App\Http\Controllers\CajasController::class, 'importinvcajas'])->name('importar_inv_cajas');
Route::get('/importar_inv_cajas', [App\Http\Controllers\CajasController::class, 'importinvcajas'])->name('importar_inv_cajas');