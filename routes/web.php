<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\importar_pendiente_empaque;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CapaProductoController;
use App\Http\Controllers\clase_producto;
use App\Http\Controllers\importar_pendiente_lic;
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
use App\Http\Livewire\Pedido;
use App\Http\Livewire\PO;
use App\Http\Livewire\EditarDetalles;
use App\Http\Livewire\EntradasSalidas;
use App\Http\Livewire\InventarioMantenimiento;
use App\Http\Livewire\Materiales;
use App\Http\Livewire\MaterialesProductos;
use App\Http\Livewire\Pilones\ControlPilones;
use App\Http\Livewire\Pilones\EntradasPilones;
use App\Http\Livewire\Pilones\ProcesoPilones;
use App\Http\Livewire\Pilones\RegistroPilones;
use App\Http\Livewire\Pilones\RemisionPilon;
use App\Http\Livewire\Produccion\Produccion;
use App\Http\Livewire\Produccion\ProduccionCatalogo;
use App\Http\Livewire\Produccion\ProduccionDiarioMarcas;
use App\Http\Livewire\Produccion\ProduccionEmpleado;
use App\Http\Livewire\Produccion\ProduccionEmpleadoRendimiento;
use App\Http\Livewire\Produccion\ProduccionMateriales;
use App\Http\Livewire\Produccion\ProduccionMaterialesCatalogo;
use App\Http\Livewire\Produccion\ProduccionPendiente;
use App\Http\Livewire\Produccion\ProduccionPendienteSalida;
use App\Http\Livewire\ProductoPrecio;
use App\Http\Livewire\ProductosCatalogo;
use App\Http\Livewire\Terminado;
use App\Models\EntradasSalida;
use App\Models\MaterialesCatalogo;
use App\Http\Livewire\ReporteDiarios;
use App\Models\EntradaPilon;

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

Route::get('/holis', function () {
    return view('holis');
});
Route::get('/holisa', function () {
    return view('codigobarra');
});

Route::group(['middleware' => ['auth', 'checkRole:0,1,2,3,4']], function () {

    Route::get('/import_excel', Pedido::class)->name('import_excel');

    Route::get('/poimport', PO::class)->name('poimport');
    Route::post('/poimport/import', [PO::class, 'importPO'])->name('poimportimport');

    Route::post('/importar_pendiente', [importar_pendiente_lic::class, 'import_pendiente'])->name('importar_pendiente');


    Route::post('/import', [VehicleController::class, 'import']);


    Route::post('/importar_pendiente_empaque', [importar_pendiente_empaque::class, 'import_pendiente'])->name('importar_pendiente_empaque');


    Route::post('/importar_pedido', [PedidoController::class, 'import']);
    Route::post('/importar_catalogo_product', [PedidoController::class, 'importCatlogoCompleto']);

    Route::get('/importar_ficha', [MaterialesProductos::class, 'import']);

    Route::post('/nuevo_pedido', [PedidoController::class, 'nuevo_pedido'])->name('nuevo_pedido');
    Route::get('/nuevo_pedido', [PedidoController::class, 'nuevo_pedido'])->name('nuevo_pedido');


    Route::get('/productos', Productos::class)->name('productos');
    Route::get('/catalogo_productos', ProductosCatalogo::class)->name('productos.catalogo');

    Route::post('/editarDetalles', EditarDetalles::class)->name('editarDetalles');
    Route::get('/editarDetalles', EditarDetalles::class)->name('editarDetalles');
    Route::get('/actualizar_detalle_producto', [EditarDetalles::class, 'actualizar_detalle_producto'])->name('actualizar_detalle_producto');
    Route::post('/actualizar_detalle_producto', [EditarDetalles::class, 'actualizar_detalle_producto'])->name('actualizar_detalle_producto');



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

    Route::post('/pendiente_insertar', [Pendiente::class, 'pendiente_indexi'])->name('pendiente_insertar');
    Route::post('/exportPendiente', [Pendiente::class, 'exportPendiente'])->name('exportPendiente');

    Route::post('/exportPendientecaja', [Pendiente::class, 'RemisionCajas'])->name('pendientecajapedido');

    Route::get('/borrarpendiente', [Pendiente::class, 'eliminar_pendiente'])->name('borrarpendiente');
    Route::post('/borrarpendiente', [Pendiente::class, 'eliminar_pendiente'])->name('borrarpendiente');

    Route::get('/borrarpendiente_empaque', [PendienteEmpaque::class, 'eliminar_pendiente'])->name('borrarpendienteEmpaque');
    Route::post('/borrarpendiente_empaque', [PendienteEmpaque::class, 'eliminar_pendiente'])->name('borrarpendienteEmpaque');

    Route::post('/insertar_detalle_provicional', [PendienteEmpaque::class, 'insertar_detalle_provicional'])->name('insertar_detalle_provicional');


    Route::get('/actualizar_pendiente', [Pendiente::class, 'actualizar_pendiente'])->name('actualizar_pendiente');
    Route::post('/actualizar_pendiente', [Pendiente::class, 'actualizar_pendiente'])->name('actualizar_pendiente');



    Route::get('/actualizar_pendiente_empaque', [PendienteEmpaque::class, 'actualizar_pendiente_empaque'])->name('actualizar_pendiente_empaque');
    Route::post('/actualizar_pendiente_empaque', [PendienteEmpaque::class, 'actualizar_pendiente_empaque'])->name('actualizar_pendiente_empaque');

    Route::post('/insertar_detalle_provicional_sin_existencia/{id}', [PendienteEmpaque::class, 'insertar_detalle_provicional_sin_existencia']);


    Route::get('/nuevo_pendiente', [Pendiente::class, 'insertar_nuevo_pendiente'])->name('nuevo_pendiente');
    Route::post('/nuevo_pendiente', [Pendiente::class, 'insertar_nuevo_pendiente'])->name('nuevo_pendiente');


    Route::get('/nuevo_pendiente_empaque', [PendienteEmpaque::class, 'insertar_nuevo_pendiente_empaque'])->name('nuevo_pendiente_empaque');
    Route::post('/nuevo_pendiente_empaque', [PendienteEmpaque::class, 'insertar_nuevo_pendiente_empaque'])->name('nuevo_pendiente_empaque');

    Route::get('/export_pendiente_empaque', [PendienteEmpaque::class, 'actualizar_datos'])->name('exportar_materia');


    Route::get('/inventario_cajas', InventarioCajas::class)->name('inventario_cajas');


    Route::get('/importar_c', ImportarProductoBodega::class)->name('importar_ca');
    Route::post('/importar_c', ImportarProductoBodega::class)->name('importar_ca');


    Route::get('/historial_programacion', HistorialProgramacion::class)->name('historial_programacion');
    Route::post('/historial_programacion', HistorialProgramacion::class)->name('historial_programacion');

    Route::get('/programacionterminado', Terminado::class)->name('programacionterminado');
    Route::post('/programacionterminado', Terminado::class)->name('programacionterminado');

    Route::post('/programacionterminado/remision', [Terminado::class, 'ExcelDiario'])->name('programacionterminadoremision');
    Route::post('/programacionterminado/remisionreporte', [ReporteDiarios::class, 'ExcelDiarioRemision'])->name('programacionterminadoreporteremision');

    Route::post('/programacionterminadoupdate', [Terminado::class, 'updatelistos'])->name('updatelistos');

    Route::get('/exportar_programacion/terminado', [Terminado::class, 'exportProgramacion'])->name('exportar_programacion_terminado');

    Route::get('/reportediarios', ReporteDiarios::class)->name('reportediarios');
    Route::post('/reportediarios', ReporteDiarios::class)->name('reportediarios');


    Route::get('/borrar_historial_programacion', [HistorialProgramacion::class, 'eliminar_detalles_pro'])->name('borrar_historial_programacion');
    Route::post('/borrar_historial_programacion', [HistorialProgramacion::class, 'eliminar_detalles_pro'])->name('borrar_historial_programacion');



    Route::get('/imprimir_detalles', [programacion::class, 'imprimir_programa'])->name('imprimir_detalles');
    Route::post('/imprimir_detalles', [programacion::class, 'imprimir_programa'])->name('imprimir_detalles');

    Route::get('/eliminar_programacion', [HistorialProgramacion::class, 'eliminar_programacion'])->name('eliminar_programacion');
    Route::post('/eliminar_programacion', [HistorialProgramacion::class, 'eliminar_programacion'])->name('eliminar_programacion');




    Route::get('/actualizar_programacion', [HistorialProgramacion::class, 'actualizar_programacion'])->name('actualizar_programacion');
    Route::post('/actualizar_programacion', [HistorialProgramacion::class, 'actualizar_programacion'])->name('actualizar_programacion');


    Route::get('/actualizar_historial_programacion', [HistorialProgramacion::class, 'actualizar_detalles_pro'])->name('actualizar_historial_programacion');
    Route::post('/actualizar_historial_programacion', [HistorialProgramacion::class, 'actualizar_detalles_pro'])->name('actualizar_historial_programacion');

    Route::get('/detalles_programacion', DetalleProgramacion::class)->name('detalles_programacion');
    Route::post('/detalles_programacion', DetalleProgramacion::class)->name('detalles_programacion');



    Route::get('/borrardetalles_programacion', [DetalleProgramacion::class, 'eliminar_detalles'])->name('borrardetalles_programacion');
    Route::post('/borrardetalles_programacion', [DetalleProgramacion::class, 'eliminar_detalles'])->name('borrardetalles_programacion');


    Route::get('/actualizar_rdetalles_programacion', [DetalleProgramacion::class, 'actualizar_saldo'])->name('actualizar_rdetalles_programacion');
    Route::post('/actualizar_rdetalles_programacion', [DetalleProgramacion::class, 'actualizar_saldo'])->name('actualizar_rdetalles_programacion');

    Route::get('/historial_programa', [DetalleProgramacion::class, 'insertarDetalle_y_actualizarPendiente'])->name('historial_programa');
    Route::post('/historial_programa', [DetalleProgramacion::class, 'insertarDetalle_y_actualizarPendiente'])->name('historial_programa');




    Route::get('/pedido_buscar', [PedidoController::class, 'buscar'])->name('buscar_pedido');
    Route::post('/pedido_buscar', [PedidoController::class, 'buscar'])->name('buscar_pedido');


    Route::get('/programacion', [programacion::class, 'index'])->name('programacion');
    Route::post('/programacion', [programacion::class, 'index'])->name('programacion');



    Route::get('/producto', [tabla_existencia::class, 'import'])->name('codigo');
    Route::post('/producto', [tabla_existencia::class, 'import'])->name('codigo');


    Route::post('/eliminar_detalles_productos', [Productos::class, 'eliminar_detalle']);


    Route::post('/datos_producto', DatosProductos::class)->name('datos_producto');
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

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //rutas melvin
    Route::get('/', [App\Http\Controllers\Principal::class, 'index'])->name('tabla');

    Route::post('/', [App\Http\Controllers\TableditController::class, 'buscar'])->name('buscar');
    Route::post('tabledit/action', [App\Http\Controllers\TableditController::class, 'action'])->name('tabledit.action');
    Route::get('/principal', [App\Http\Controllers\Principal::class, 'index'])->name('principal');


    //USERS
    Route::post('/usuarios/d', [App\Http\Controllers\Users::class, 'update'])->name('actualizar_usuario');
    Route::post('/usuarios/a', [App\Http\Controllers\Users::class, 'destroy'])->name('eliminar_usuario');
    Route::post('usuarios/contra', [App\Http\Controllers\Users::class, 'update_contrasenia'])->name('actualizar_usuario_contrasenia');
    Route::get('/usuarios', [App\Http\Controllers\Users::class, 'index'])->name('usuarios');


    //cajas

    Route::get('/index_importar_cajas', [App\Http\Controllers\CajasController::class, 'index_importar'])->name('index_importar_cajas');
    Route::get('/index_bodega', [App\Http\Controllers\CajasController::class, 'index_bodega'])->name('index_bodega');
    //Route::get('/index_lista_cajas', [App\Http\Controllers\CajasController::class, 'index_lista'])->name('index_lista_cajas');
    Route::post('/editaryeliminarlista', [App\Http\Controllers\CajasController::class, 'editaryeliminarlista'])->name('editaryeliminarlista');
    Route::get('/exportar_cajas', [App\Http\Controllers\CajasController::class, 'exportCajas'])->name('exportar_cajas');
    Route::get('/index_codigobarra', [App\Http\Controllers\CajasController::class, 'index_codigobarra'])->name('index_codigobarra');



    Route::post('/buscar_lista_cajas', [App\Http\Controllers\CajasController::class, 'buscar_lista_cajas'])->name('buscar_lista_cajas');
    Route::get('/buscar_lista_cajas', [App\Http\Controllers\CajasController::class, 'buscar_lista_cajas'])->name('buscar_lista_cajas');
    Route::post('/agregar_lista_caja', [App\Http\Controllers\CajasController::class, 'agregar_lista_caja'])->name('agregar_lista_caja');

    Route::post('/importar_cajas', [App\Http\Controllers\CajasController::class, 'import'])->name('importar_cajas');
    Route::get('/importar_cajas', [App\Http\Controllers\CajasController::class, 'import'])->name('importar_cajas');
    Route::post('/vaciar_import_tabla', [App\Http\Controllers\CajasController::class, 'vaciar_import_tabla'])->name('vaciar_import_tabla');

    Route::post('/anadir_inventario', [App\Http\Controllers\CajasController::class, 'anadir_inventario'])->name('anadir_inventario');

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


    // Materiales

    Route::get('materiales_index', Materiales::class)->name('materiales.index');
    Route::get('materiales_agregar', MaterialesProductos::class)->name('materiales.relacionar');
    Route::post('/importar_ficha', [MaterialesProductos::class, 'import']);
    Route::get('/entradas_salidas', EntradasSalidas::class)->name('entradas.salidas');

    Route::post('/MaterialesPendiente', [Pendiente::class, 'exportPendienteMateriales'])->name('materiales.exporPendiente');
    Route::post('/MaterialesPendiente2', [Pendiente::class, 'imprimir_materiales'])->name('materiales.exportMateriales');
    Route::post('/MaterialesActualizar', [Pendiente::class, 'actualizar_datos'])->name('materiales.actualizar_datos');
    Route::post('/MaterialesFichasPendiente', [Pendiente::class, 'actualizar_fichas'])->name('materiales.actualizar_fichas');

    Route::post('/MaterialesPendienteEmpaque', [PendienteEmpaque::class, 'exportPendienteMateriales_pendiente_empaque'])->name('materiales_empaque.exporPendiente');
    Route::post('/MaterialesPendienteEmpaque2', [PendienteEmpaque::class, 'imprimir_materiales_pendiente_empaque'])->name('materiales_empaque.exportMateriales');
    Route::post('/MaterialesPendienteEmpaqueActualizar', [PendienteEmpaque::class, 'actualizar_datos_pendiente_empaque'])->name('materiales_empaque.actualizar_datos');
    Route::post('/MaterialesFichasPendienteEmpaque', [PendienteEmpaque::class, 'actualizar_fichas_pendiente_empaque'])->name('materiales_empaque.actualizar_fichas');


    //Catalgo de precios

    Route::get('/precios', ProductoPrecio::class)->name('precio.catalogo');


    //Produccion de precios
    Route::get('/produccion', Produccion::class)->name('produccion.index');
    Route::get('/produccion/pendiente', ProduccionPendiente::class)->name('produccion.pendiente.index');
    Route::get('/produccion/pendiente/salida', ProduccionPendienteSalida::class)->name('produccion.pendiente.salida');
    Route::get('/imprimir/pendiente/producir', [ProduccionPendiente::class, 'imprimir_reporte_diario'])->name('produccion.reporte.diario');
    Route::get('/produccion/empleados', ProduccionEmpleado::class)->name('produccion.empleados');
    Route::get('/produccion/empleados/marcas', ProduccionDiarioMarcas::class)->name('produccion.producir.marca');
    Route::get('/produccion/empleados/vinetas', [ProduccionDiarioMarcas::class, 'generar_vinetas_pdf'])->name('produccion.producir.vinetas');

    Route::get('/produccion/empleados/rendimiento', ProduccionEmpleadoRendimiento::class)->name('produccion.empleados.rendimiento');
    Route::get('/produccion/catalogo', ProduccionCatalogo::class)->name('produccion.catalogo');
    Route::get('/produccion/materiales/catalogo', ProduccionMaterialesCatalogo::class)->name('produccion.catalogo.materiales');
    Route::get('/produccion/materiales', ProduccionMateriales::class)->name('produccion.materiales');


    Route::get('/inventario/materiales', InventarioMantenimiento::class)->name('inventario.materiales');
    Route::get('/pilones', RegistroPilones::class)->name('pilones');
    Route::get('/pilones/entradapiles', EntradasPilones::class)->name('pilones.entradas');
    Route::get('/pilones/controlpilones', ControlPilones::class)->name('pilones.control');
    Route::get('/pilones/remisionpilones', RemisionPilon::class)->name('pilones.remision');
    Route::get('/pilones/procesopilones', ProcesoPilones::class)->name('pilones.proceso');


});

Route::group(['middleware' => ['auth', 'checkRole:-2']], function () {
    Route::get('materiales_index2', Materiales::class)->name('materiales.index2');
    Route::get('/', [App\Http\Controllers\Principal::class, 'index'])->name('tabla');
});


Route::get('/unauthorized', [App\Http\Controllers\Principal::class, 'unauthorized'])->name('unauthorized');
