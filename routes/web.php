<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\importar_pendiente_empaque;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CapaProductoController;
use App\Http\Controllers\clase_producto;
use App\Http\Controllers\importar_pendiente_lic;
use App\Http\Controllers\PendienteController;
use App\Http\Controllers\programacion;
use App\Http\Controllers\tabla_existencia;
use App\Http\Livewire\BusquedaAvanzada;
use App\Http\Livewire\DatosProductos;
use App\Http\Livewire\FacturaTerminado;
use App\Http\Livewire\Productos;
use App\Http\Livewire\PendienteEmpaque;
use App\Http\Livewire\Pendiente;
use App\Http\Livewire\ProductosTerminados;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\ImportarProductoBodega;
use App\Http\Livewire\InventarioCajas;
use App\Http\Livewire\HistorialProgramacion;
use App\Http\Livewire\DetalleProgramacion;
use App\Http\Livewire\HistorialVentas;
use App\Http\Livewire\ListaCajas;
use App\Http\Livewire\Pedido;

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


Auth::routes();


Route::group(['middleware' => 'auth'], function () {

 Route::get('/import_excel', Pedido::class)->name('import_excel');


 Route::post('/importar_pendiente', [importar_pendiente_lic::class, 'import_pendiente'])->name('importar_pendiente');


Route::post('/import', [VehicleController::class, 'import']);


Route::post('/importar_pendiente_empaque', [importar_pendiente_empaque::class, 'import_pendiente'])->name('importar_pendiente_empaque');



Route::post('/importar_pedido', [PedidoController::class, 'import']);
Route::get('/importar_pedido', [PedidoController::class, 'import']);



Route::post('/nuevo_pedido', [PedidoController::class, 'nuevo_pedido'])->name('nuevo_pedido');
Route::get('/nuevo_pedido', [PedidoController::class, 'nuevo_pedido'])->name('nuevo_pedido');


Route::get('/productos', Productos::class)->name('productos');
Route::post('/productos', Productos::class)->name('productos');



Route::get('/pendiente_empaque', PendienteEmpaque::class)->name('pendiente_empaque');
Route::post('/pendiente_empaque', PendienteEmpaque::class)->name('pendiente_empaque');


Route::get('/insertar_detalles', [PendienteEmpaque::class, 'insertar_detalle_provicional'])->name('insertar_detalles');
Route::post('/insertar_detalles', [PendienteEmpaque::class, 'insertar_detalle_provicional'])->name('insertar_detalles');


Route::get('/insertar_detalles_sin', [PendienteEmpaque::class, 'insertar_detalle_provicional_sin_existencia'])->name('insertar_detalles_sin');
Route::post('/insertar_detalles_sin', [PendienteEmpaque::class, 'insertar_detalle_provicional_sin_existencia'])->name('insertar_detalles_sin');



Route::get('/insertar_productos', [Productos::class, 'insertar_clase'])->name('nuevo_producto');
Route::post('/insertar_productos', [Productos::class, 'insertar_clase'])->name('nuevo_producto');



Route::get('/actualizar_productos', [Productos::class, 'actualizar_clase'])->name('actualizar_producto');
Route::post('/actualizar_productos', [Productos::class, 'actualizar_clase'])->name('actualizar_producto');


Route::get('/insertar_detalle_productos', [Productos::class, 'insertar_detalle_clase'])->name('detalle');
Route::post('/insertar_detalle_productos', [Productos::class, 'insertar_detalle_clase'])->name('detalle');


Route::get('/mostrar_detalle_productos', [clase_producto::class, 'insertar_detalle_clase'])->name('detalle_producto');
Route::post('/mostrar_detalle_productos', [clase_producto::class, 'insertar_detalle_clase'])->name('detalle_producto');

Route::post('/importar_clase', [CapaProductoController::class, 'import']);
Route::get('/importar_clase', [CapaProductoController::class, 'import']);


Route::get('/pendiente', Pendiente::class)->name('pendiente');
Route::post('/pendiente', Pendiente::class)->name('pendiente');

Route::post('/pendiente_insertar', [Pendiente::class,'pendiente_indexi'])->name('pendiente_insertar');


Route::get('/borrarpendiente',[ Pendiente::class,'eliminar_pendiente'])->name('borrarpendiente');
Route::post('/borrarpendiente',[ Pendiente::class,'eliminar_pendiente'])->name('borrarpendiente');


Route::get('/actualizar_pendiente',[ Pendiente::class,'actualizar_pendiente'])->name('actualizar_pendiente');
Route::post('/actualizar_pendiente',[ Pendiente::class,'actualizar_pendiente'])->name('actualizar_pendiente');


Route::get('/actualizar_pendiente_empaque',[ PendienteEmpaque::class,'actualizar_pendiente_empaque'])->name('actualizar_pendiente_empaque');
Route::post('/actualizar_pendiente_empaque',[ PendienteEmpaque::class,'actualizar_pendiente_empaque'])->name('actualizar_pendiente_empaque');


Route::get('/nuevo_pendiente',[ Pendiente::class,'insertar_nuevo_pendiente'])->name('nuevo_pendiente');
Route::post('/nuevo_pendiente',[ Pendiente::class,'insertar_nuevo_pendiente'])->name('nuevo_pendiente');



Route::get('/inventario_cajas', InventarioCajas::class)->name('inventario_cajas');
Route::post('/inventario_cajas', InventarioCajas::class)->name('inventario_cajas');


Route::get('/importar_c', ImportarProductoBodega::class)->name('importar_ca');
Route::post('/importar_c', ImportarProductoBodega::class)->name('importar_ca');


Route::get('/historial_programacion', HistorialProgramacion::class)->name('historial_programacion');
Route::post('/historial_programacion', HistorialProgramacion::class)->name('historial_programacion');


Route::get('/borrar_historial_programacion', [HistorialProgramacion::class,'eliminar_detalles_pro'])->name('borrar_historial_programacion');
Route::post('/borrar_historial_programacion', [HistorialProgramacion::class,'eliminar_detalles_pro'])->name('borrar_historial_programacion');



Route::get('/imprimir_detalles', [programacion::class,'imprimir_programa'])->name('imprimir_detalles');
Route::post('/imprimir_detalles', [programacion::class,'imprimir_programa'])->name('imprimir_detalles');

Route::get('/eliminar_programacion', [HistorialProgramacion::class,'eliminar_programacion'])->name('eliminar_programacion');
Route::post('/eliminar_programacion', [HistorialProgramacion::class,'eliminar_programacion'])->name('eliminar_programacion');




Route::get('/actualizar_programacion', [HistorialProgramacion::class,'actualizar_programacion'])->name('actualizar_programacion');
Route::post('/actualizar_programacion', [HistorialProgramacion::class,'actualizar_programacion'])->name('actualizar_programacion');


Route::get('/actualizar_historial_programacion', [HistorialProgramacion::class,'actualizar_detalles_pro'])->name('actualizar_historial_programacion');
Route::post('/actualizar_historial_programacion', [HistorialProgramacion::class,'actualizar_detalles_pro'])->name('actualizar_historial_programacion');

Route::get('/detalles_programacion', DetalleProgramacion::class)->name('detalles_programacion');
Route::post('/detalles_programacion', DetalleProgramacion::class)->name('detalles_programacion');



Route::get('/borrardetalles_programacion', [DetalleProgramacion::class,'eliminar_detalles'])->name('borrardetalles_programacion');
Route::post('/borrardetalles_programacion', [DetalleProgramacion::class,'eliminar_detalles'])->name('borrardetalles_programacion');


Route::get('/actualizar_rdetalles_programacion', [DetalleProgramacion::class,'actualizar_saldo'])->name('actualizar_rdetalles_programacion');
Route::post('/actualizar_rdetalles_programacion', [DetalleProgramacion::class,'actualizar_saldo'])->name('actualizar_rdetalles_programacion');

Route::get('/historial_programa', [DetalleProgramacion::class,'insertarDetalle_y_actualizarPendiente'])->name('historial_programa');
Route::post('/historial_programa', [DetalleProgramacion::class,'insertarDetalle_y_actualizarPendiente'])->name('historial_programa');




Route::get('/pedido_buscar', [PedidoController::class, 'buscar'])->name('buscar_pedido');
Route::post('/pedido_buscar', [PedidoController::class, 'buscar'])->name('buscar_pedido');


Route::get('/programacion', [programacion::class, 'index'])->name('programacion');
Route::post('/programacion', [programacion::class, 'index'])->name('programacion');



Route::get('/producto', [tabla_existencia::class, 'import'])->name('codigo');
Route::post('/producto', [tabla_existencia::class, 'import'])->name('codigo');


Route::get('/datos_producto', DatosProductos::class)->name('datos_producto');



// INSERTAR DATOS ADICIONALES DE LOS PRODUCTOS

Route::get('/insertar_marca', [DatosProductos::class, 'insertar_marca'])->name('insertar_marca');
Route::post('/insertar_marca', [DatosProductos::class, 'insertar_marca'])->name('insertar_marca');
Route::get('/editar_marca', [DatosProductos::class, 'editar_marca'])->name('editar_marca');
Route::post('/editar_marca', [DatosProductos::class, 'editar_marca'])->name('editar_marca');


Route::get('/insertar_nombre', [DatosProductos::class, 'insertar_nombre'])->name('insertar_nombre');
Route::post('/insertar_nombre', [DatosProductos::class, 'insertar_nombre'])->name('insertar_nombre');
Route::get('/editar_nombre', [DatosProductos::class, 'editar_nombre'])->name('editar_nombre');
Route::post('/editar_nombre', [DatosProductos::class, 'editar_nombre'])->name('editar_nombre');

Route::get('/insert_vitola', [DatosProductos::class, 'insertar_vitola'])->name('insertar_vitola');
Route::post('/insertar_vitola', [DatosProductos::class, 'insertar_vitola'])->name('insertar_vitola');
Route::get('/editar_vitola', [DatosProductos::class, 'editar_vitola'])->name('editar_vitola');
Route::post('/editar_vitola', [DatosProductos::class, 'editar_vitola'])->name('editar_vitola');

Route::get('/insertar_tipo', [DatosProductos::class, 'insertar_tipo'])->name('insertar_tipo');
Route::post('/insertar_tipo', [DatosProductos::class, 'insertar_tipo'])->name('insertar_tipo');
Route::get('/editar_tipo', [DatosProductos::class, 'editar_tipo'])->name('editar_tipo');
Route::post('/editar_tipo', [DatosProductos::class, 'editar_tipo'])->name('editar_tipo');

Route::get('/insertar_capa', [DatosProductos::class, 'insertar_capa'])->name('insertar_capa');
Route::post('/insertar_capa', [DatosProductos::class, 'insertar_capa'])->name('insertar_capa');
Route::get('/editar_capa', [DatosProductos::class, 'editar_capa'])->name('editar_capa');
Route::post('/editar_capa', [DatosProductos::class, 'editar_capa'])->name('editar_capa');

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//rutas melvin
Route::get('/', [App\Http\Controllers\Principal::class, 'index'])->name('tabla');

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
Route::get('/exportar_cajas', [App\Http\Controllers\CajasController::class, 'exportCajas'])->name('exportar_cajas');
Route::get('/index_codigobarra', [App\Http\Controllers\CajasController::class, 'index_codigobarra'])->name('index_codigobarra');
 


Route::post('/buscar_lista_cajas', [App\Http\Controllers\CajasController::class, 'buscar_lista_cajas'])->name('buscar_lista_cajas');
Route::get('/buscar_lista_cajas', [App\Http\Controllers\CajasController::class, 'buscar_lista_cajas'])->name('buscar_lista_cajas');
Route::post('/agregar_lista_caja', [App\Http\Controllers\CajasController::class, 'agregar_lista_caja'])->name('agregar_lista_caja');

Route::post('/importar_cajas', [App\Http\Controllers\CajasController::class, 'import'])->name('importar_cajas');
Route::get('/importar_cajas', [App\Http\Controllers\CajasController::class, 'import'])->name('importar_cajas');
Route::post('/vaciar_import_tabla', [App\Http\Controllers\CajasController::class, 'vaciar_import_tabla'])->name('vaciar_import_tabla');

Route::get('/anadir_inventario', [App\Http\Controllers\CajasController::class, 'anadir_inventario'])->name('anadir_inventario');

Route::post('/importar_inv_cajas', [App\Http\Controllers\CajasController::class, 'importinvcajas'])->name('importar_inv_cajas');
Route::get('/importar_inv_cajas', [App\Http\Controllers\CajasController::class, 'importinvcajas'])->name('importar_inv_cajas');
Route::get('/index_importar_remision', [App\Http\Controllers\CajasController::class, 'index_importar_remision'])->name('index_importar_remision');
Route::post('/editar_existencia', [App\Http\Controllers\CajasController::class, 'editar_existencia'])->name('editar_existencia');



Route::get('/exportar_pendiente', [Pendiente::class, 'exportPendiente'])->name('exportar_pendiente');

Route::get('/exportar_programacion', [HistorialProgramacion::class, 'exportProgramacion'])->name('exportar_programacion');


Route::get('/exportar_detallesprogramacion', [DetalleProgramacion::class, 'exportProgramacion'])->name('exportar_detallesprogramacion');


//Produtco terminado y Facturacion
Route::get('/productos_terminado', ProductosTerminados::class)->name('p_terminado');

Route::get('/factura_terminados', FacturaTerminado::class)->name('f_terminado');

Route::post('/insertar_detalle_factura', [FacturaTerminado::class, 'insertar_detalle_factura'])->name('insertar_detalle_factura');
Route::post('/actualizar_detalle_factura', [FacturaTerminado::class, 'actualizar_detalle_factura'])->name('actualizar_detalle_factura');

Route::get('/historial_ventas', HistorialVentas::class)->name('historial_factura');
Route::get('/pendiente_salida', BusquedaAvanzada::class)->name('salida');

Route::post('/actualizar_factura', [HistorialVentas::class, 'update_factura'])->name('editar_venta_factura');


Route::get('/importar_productos_terminado', [ImportExcelController::class, 'importar_productos_terminado'])->name('importar_productos_terminado');
Route::post('/importar_archivoproductos_terminados', [App\Http\Controllers\ImportExcelController::class, 'importar_archivoproductos_terminados'])->name('importar_archivoproductos_terminados');
Route::get('/importar_archivoproductos_terminados', [App\Http\Controllers\ImportExcelController::class, 'importar_archivoproductos_terminados'])->name('importar_archivoproductos_terminados');
Route::post('/reemplazar_productos_terminado', [App\Http\Controllers\ImportExcelController::class, 'reemplazar_productos_terminado'])->name('reemplazar_productos_terminado');
Route::get('/reemplazar_productos_terminado', [App\Http\Controllers\ImportExcelController::class, 'reemplazar_productos_terminado'])->name('reemplazar_productos_terminado');
Route::get('/index_lista_productos', [App\Http\Controllers\ImportExcelController::class, 'index_lista_productos'])->name('index_lista_productos');
Route::post('/editar_existencia_producto', [App\Http\Controllers\ImportExcelController::class, 'editar_existencia_producto'])->name('editar_existencia_producto');
Route::get('/editar_existencia_producto', [App\Http\Controllers\ImportExcelController::class, 'editar_existencia_producto'])->name('editar_existencia_producto');

Route::post('/insertar_pro', [App\Http\Controllers\ImportExcelController::class, 'nuevo_pro_terminado'])->name('insertar_pro');
Route::get('/insertar_pro', [App\Http\Controllers\ImportExcelController::class, 'nuevo_pro_terminado'])->name('insertar_pro');

});