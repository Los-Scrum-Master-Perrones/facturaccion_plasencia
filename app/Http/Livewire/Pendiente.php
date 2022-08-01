<?php

namespace App\Http\Livewire;

use App\Exports\MaterialesProgramacionExportView;
use Livewire\Component;

use App\Exports\PendienteExport;
use App\Exports\PendienteMaterialesExport;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Pendiente extends Component
{
    public $datos_pendiente;
    public $tuplas_conteo;
    public $paginacion;

    public $codigo_item;

    // variables del wire  model para la busqueda
    public $r_uno = "1";
    public $r_dos = "2";
    public $r_tres = "3";
    public $r_cuatro = "4";
    public $r_cinco = "Puros Tripa Larga";
    public $r_seis = "Puros Tripa Corta";
    public $r_siete = "Puros Sandwich";
    public $r_mill = "Puros Brocha";


    /* procedimientos almacanedos cargar select de nuevo pendiente*/
    public $marcas;
    public $capas;
    public $nombres;
    public $vitolas;
    public $tipo_empaques;

    public $busqueda;
    public $borrar;


    /* procedimientos almacanedos busquedas pendiente*/
    public $marcas_p;
    public $nombre_p;
    public $vitolas_p;
    public $capas_p;
    public $empaques_p;
    public $mes_p;
    public $items_p;
    public $ordenes_p;
    public $hons_p;

    public $busqueda_marcas_p = '';
    public $busqueda_nombre_p = '';
    public $busqueda_vitolas_p = '';
    public $busqueda_capas_p = '';
    public $busqueda_empaques_p = '';
    public $busqueda_mes_p = '';
    public $busqueda_items_p = '';
    public $busqueda_ordenes_p = '';
    public $busqueda_hons_p = '';
    public $todos;


    public $capas_nuevo;
    public $marcas_nuevo;
    public $nombres_nuevo;
    public $vitolas_nuevo;
    public $tipo_empaques_nuevo;
    public $presentacion;
    public $codigo_precio_nuevo;
    public $precio_precio;

    public function render()
    {
        $item_sampler_mensaje = "item";

        $this->items_p = DB::select('call buscar_pendiente_item()');
        /*Procedimientos de busquedas de la tabla pendiente*/
        $this->marcas_p = DB::select(
            'call buscar_marca_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->nombre_p = DB::select(
            'call buscar_nombre_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->vitolas_p = DB::select(
            'call buscar_vitola_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->capas_p = DB::select(
            'call buscar_capa_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->empaques_p = DB::select(
            'call buscar_tipo_empaque_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );


        $this->mes_p = DB::select(
            'call buscar_fechas_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->items_p = DB::select(
            'call buscar_item_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->ordenes_p = DB::select(
            'call buscar_ordenes_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->hons_p = DB::select(
            'call buscar_hons_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );

        $this->capas = DB::select('call buscar_capa("")');
        $this->marcas = DB::select('call buscar_marca("")');
        $this->nombres = DB::select('call buscar_nombre("")');
        $this->vitolas = DB::select('call buscar_vitola("")');
        $this->tipo_empaques = DB::select('call buscar_tipo_empaque("")');

        $todos = DB::select(
            'call buscar_pendiente(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
        :pa_items,:pa_orden_sist,:pa_ordenes,
        :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
        :pa_empaques,:pa_meses,:r_mill)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro,
                'pres' =>  $this->r_cinco,
                'seis' =>  $this->r_seis,
                'siete' =>  $this->r_siete,
                'paginacion' =>  -1,
                'pa_marcas' =>  $this->busqueda_marcas_p,
                'pa_nombre' =>  $this->busqueda_nombre_p,
                'pa_vitolas' =>  $this->busqueda_vitolas_p,
                'pa_capas' =>  $this->busqueda_capas_p,
                'pa_empaques' =>  $this->busqueda_empaques_p,
                'pa_meses' =>  $this->busqueda_mes_p,
                'pa_items' =>  $this->busqueda_items_p,
                'pa_orden_sist' =>  $this->busqueda_ordenes_p,
                'pa_ordenes' =>  $this->busqueda_hons_p,
                'r_mill' =>  $this->r_mill,
            ]
        );


        $this->tuplas_conteo = count($todos);

        if ($this->todos == 1) {
            $this->datos_pendiente = $todos;
        } else {
            $this->datos_pendiente = DB::select(
                'call buscar_pendiente(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
                :pa_items,:pa_orden_sist,:pa_ordenes,
                :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
                :pa_empaques,:pa_meses,:r_mill)',
                [
                    'uno' =>  $this->r_uno,
                    'dos' =>  $this->r_dos,
                    'tres' =>  $this->r_tres,
                    'cuatro' =>  $this->r_cuatro,
                    'pres' =>  $this->r_cinco,
                    'seis' =>  $this->r_seis,
                    'siete' =>  $this->r_siete,
                    'paginacion' =>  $this->paginacion,
                    'pa_marcas' =>  $this->busqueda_marcas_p,
                    'pa_nombre' =>  $this->busqueda_nombre_p,
                    'pa_vitolas' =>  $this->busqueda_vitolas_p,
                    'pa_capas' =>  $this->busqueda_capas_p,
                    'pa_empaques' =>  $this->busqueda_empaques_p,
                    'pa_meses' =>  $this->busqueda_mes_p,
                    'pa_items' =>  $this->busqueda_items_p,
                    'pa_orden_sist' =>  $this->busqueda_ordenes_p,
                    'pa_ordenes' =>  $this->busqueda_hons_p,
                    'r_mill' =>  $this->r_mill,

                ]
            );
        }

        return view('livewire.pendiente')->extends('principal')->section('content');
    }



    public function mount()
    {

        $this->datos_pendiente = [];

        $this->paginacion = 0;
        $this->fecha = "";
        $this->borrar = [];
        $this->busqueda_marcas_p = "";
        $this->busqueda_nombre_p = "";
        $this->busqueda_vitolas_p = "";
        $this->busqueda_capas_p = "";
        $this->busqueda_empaques_p = "";
        $this->busqueda_mes_p = "";
        $this->busqueda_items_p = "";
        $this->busqueda_ordenes_p = "";
        $this->busqueda_hons_p = "";
    }

    public function paginacion_numerica($numero)
    {
        $this->paginacion = $numero;
    }

    public function mostrar_todo($todo)
    {
        $this->todos = $todo;
    }

    public function pendiente_indexi(Request $request)
    {

        $insertar_pendiente = DB::select(
            'call insertar_pendiente(:fecha,:sistema)',
            [
                'fecha' => (string)$request->fecha,
                'sistema' => $request->sistema
            ]
        );

        $insertar_pendiente_empaque =  DB::select(
            'call insertar_pendente_empaque(:fecha,:sistema)',
            [
                'fecha' => (string)$request->fecha,
                'sistema' => $request->sistema
            ]
        );

        return redirect()->route('pendiente')->with('insertar_pendiente', $insertar_pendiente);
    }

    public function pendiente_index(Request $request)
    {

        $this->datos_pendiente =  DB::select('call mostrar_pendiente');

        return redirect()->route('pendiente');
    }

    public function eliminar_pendiente($request)
    {
        DB::select('call borrar_pendientes(:eliminar)', ['eliminar' => $request['id_pendiente3']]);

        $this->dispatchBrowserEvent('notificacionConfirmacionDelete');
    }

    public function actualizar_pendiente($request)
    {
        $validator = Validator::make(
            [
                'orden_sistema2' => $request['orden_sistema2'],
                'orden2' => $request['orden2'],
                'pendiente2' => $request['pendiente2'],
                'saldo2' => $request['saldo2']
            ],
            [
                'orden_sistema2' => "required",
                'orden2' => "required",
                'pendiente2' => "required|integer",
                'saldo2' => "required|integer"
            ],
            [
                'orden_sistema2.required' => "La orden del sistema es necesaria.",
                'orden2.required' => "La orden es necesaria.",
                'pendiente2.required' => "El pendiente solicitado es necesaria.",
                'saldo2.required' => "El saldo solicitado es necesaria.",
                'pendiente2.integer' => "El pendiente solicitado debe ser un numero entero.",
                'saldo2.integer' => "El saldo solicitado debe ser un numero entero.",
            ]
        );

        if (!$validator->fails()) {

            DB::select(
                'call actualizar_pendientes(:id_pendientea2,:orden_sistema2,:orden2,:pendiente2,:saldo2,:observacion2)',
                [
                    'id_pendientea2' => $request['id_pendientea2'],
                    'orden_sistema2' => $request['orden_sistema2'],
                    'orden2' => $request['orden2'],
                    'pendiente2' => $request['pendiente2'],
                    'saldo2' => $request['saldo2'],
                    'observacion2' => $request['observacion2'],
                ]
            );
            $this->dispatchBrowserEvent('notificacionconfirmacionUpdate');
        } else {
            $this->dispatchBrowserEvent('notificacionErrorUpdate', ['mensaje' => $validator->errors()->all()]);
        }
    }

    function exportPendiente()
    {
        $pendiente_export = DB::select(
            'call buscar_pendiente_excel(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,
        :pa_items,:pa_orden_sist,:pa_ordenes,
        :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
        :pa_empaques,:pa_meses,:r_mill)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro,
                'pres' =>  $this->r_cinco,
                'seis' =>  $this->r_seis,
                'siete' =>  $this->r_siete,
                'pa_marcas' =>  $this->busqueda_marcas_p,
                'pa_nombre' =>  $this->busqueda_nombre_p,
                'pa_vitolas' =>  $this->busqueda_vitolas_p,
                'pa_capas' =>  $this->busqueda_capas_p,
                'pa_empaques' =>  $this->busqueda_empaques_p,
                'pa_meses' =>  $this->busqueda_mes_p,
                'pa_items' =>  $this->busqueda_items_p,
                'pa_orden_sist' =>  $this->busqueda_ordenes_p,
                'pa_ordenes' =>  $this->busqueda_hons_p,
                'r_mill' =>  $this->r_mill,

            ]
        );



        return Excel::download(new PendienteExport($pendiente_export), 'Pendiente.xlsx');
    }

    public function insertar_nuevo_pendiente($request)
    {

        $validator = Validator::make(
            [
                'categoria' => $request['categoria'],
                'item' => $request['itemn'],
                'orden' =>  $request['ordensis'],
                'mes' => $request['fechan'],
                'orden1' => $request['ordenn'],
                'pendiente' => $request['pendienten'],
                'saldo' => $request['saldon']
            ],
            [
                'categoria' => 'required',
                'item' => 'required',
                'orden' => 'required',
                'mes' => 'required|date',
                'orden1' => 'required',
                'pendiente' => 'required|integer',
                'saldo' => 'required|integer',
            ],
            [
                'categoria.required' => 'Debe seleccionar una categoria.',
                'item.required' => 'Debe ingresar el producto.',
                'orden.required' => 'Debe ingresar la Orden del Sistema.',
                'mes.required' => 'Debe ingresar la fecha del pedido.',
                'mes.date' => 'El valor de la fecha es incorrecta.',
                'orden1.required' => 'Debe ingresar la orden del cliente.',
                'pendiente.required' => 'Debe ingresar el pendiente.',
                'saldo.required' => 'Debe ingresar el saldo.',
                'pendiente.integer' => 'El pendiente debe ser un numero entero.',
                'saldo.integer' => 'El saldo debe ser un numero entero.',
            ]
        );

        if (!$validator->fails()) {
            DB::select(
                'call insertar_nuevo_pendiente(:categoria,:item,:orden,:observacion,:mes,:orden1,:pendiente,:saldo)',
                [
                    'categoria' => $request['categoria'],
                    'item' => $request['itemn'],
                    'orden' =>  $request['ordensis'],
                    'observacion' => $request['observacionn'],
                    'mes' => $request['fechan'],
                    'orden1' => $request['ordenn'],
                    'pendiente' => $request['pendienten'],
                    'saldo' => $request['saldon']
                ]
            );

            $this->dispatchBrowserEvent('notificacionconfirmacion');
        } else {
            $this->dispatchBrowserEvent('notificacionErrorInsert', ['mensaje' => $validator->errors()->all()]);
        }
    }

    public function agregar_productos()
    {
        $puro = DB::select('CALL `pendiente_producto_seleccion`(?)', [$this->codigo_item]);
        $this->capas_nuevo = $puro[0]->capa;
        $this->marcas_nuevo = $puro[0]->marca;
        $this->nombres_nuevo = $puro[0]->nombre;
        $this->vitolas_nuevo = $puro[0]->vitola;
        $this->tipo_empaques_nuevo = $puro[0]->tipo_empaque;
        $this->presentacion =  $puro[0]->presentacion;
        $this->codigo_precio_nuevo =  $puro[0]->codigo_precio;
        $this->precio_precio =  $puro[0]->precio;
    }

    public function actualizar_fichas(Request $request)
    {
        try {
            $datos = [];
            $cantidad_detalle_sampler = 0;
            $detalles = 0;
            $valores = [];

            $pendiente = DB::select(
                'call buscar_pendiente(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
            :pa_items,:pa_orden_sist,:pa_ordenes,
            :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
            :pa_empaques,:pa_meses,:r_mill)',
            [
                'uno' =>  is_null($request->r_uno)?'':$request->r_uno,
                'dos' =>  is_null($request->r_dos)?'':$request->r_dos,
                'tres' =>  is_null($request->r_tres)?'':$request->r_tres,
                'cuatro' =>  is_null($request->r_cuatro)?'':$request->r_cuatro,
                'pres' =>  is_null($request->r_cinco)?'':$request->r_cinco,
                'seis' =>  is_null($request->r_seis)?'':$request->r_seis,
                'siete' =>  is_null($request->r_siete)?'':$request->r_siete,
                'paginacion' =>  -1,
                'pa_marcas' =>  is_null($request->busqueda_marcas_p)?'':$request->busqueda_marcas_p,
                'pa_nombre' =>  is_null($request->busqueda_nombre_p)?'':$request->busqueda_nombre_p,
                'pa_vitolas' => is_null($request->busqueda_vitolas_p)?'':$request->busqueda_vitolas_p,
                'pa_capas' =>  is_null($request->busqueda_capas_p)?'':$request->busqueda_capas_p,
                'pa_empaques' =>  is_null($request->busqueda_empaques_p)?'':$request->busqueda_empaques_p,
                'pa_meses' =>  is_null($request->busqueda_mes_p)?'':$request->busqueda_mes_p,
                'pa_items' =>  is_null($request->busqueda_items_p)?'':$request->busqueda_items_p,
                'pa_orden_sist' =>  is_null($request->busqueda_ordenes_p)?'':$request->busqueda_ordenes_p,
                'pa_ordenes' =>  is_null($request->busqueda_hons_p)?'':$request->busqueda_hons_p,
                'r_mill' =>  is_null($request->r_mill)?'':$request->r_mill,

            ]
            );

            DB::delete('TRUNCATE TABLE detalles_pendiente_materiales;');

            for ($i = 0; $i < count($pendiente); $i++) {
                $item_sampler_mensaje = "" . $pendiente[$i]->item;



                $sampler = DB::select('SELECT clase_productos.sampler FROM clase_productos WHERE  clase_productos.item = ?;', [$pendiente[$i]->item]);

                if (isset($sampler[0])) {
                    if ($sampler[0]->sampler == "si") {

                        if ($cantidad_detalle_sampler == 0 && $detalles == 0) {
                            $datos = DB::select('call traer_numero_detalles_productos(?)', [$pendiente[$i]->item]);
                            $cantidad_detalle_sampler = $datos[0]->tuplas;
                        }

                        $valores = DB::select('call traer_detalles_productos_actualizar(?,?)', [$pendiente[$i]->item, $detalles]);

                        $variable = DB::select('call actualizar_pendiente_sampler(:marca,:nombre,:vitola,:capa,:tipo,:item,:codigo ,:precio,:pa_codigo_productos)', [
                            'marca' => $valores[0]->marca,
                            'nombre' => $valores[0]->nombre,
                            'vitola' => $valores[0]->vitola,
                            'capa' => $valores[0]->capa,
                            'tipo' => $valores[0]->tipo_empaque,
                            'item' =>  $pendiente[$i]->id_pendiente,
                            'codigo' => $valores[0]->otra_descripcion,
                            'precio' => $valores[0]->precio,
                            'pa_codigo_productos' => $valores[0]->codigo_producto,
                        ]);


                        $detalles++;

                        if ($detalles == $cantidad_detalle_sampler) {
                            $detalles = 0;
                            $cantidad_detalle_sampler = 0;
                        }

                        DB::insert('CALL insertar_pendiente_materiales(:pa_item,
                                                                        :cod_producto,
                                                                        :pa_id_pendiente)',

                                    ['pa_item' => $pendiente[$i]->item,
                                    'cod_producto' => $valores[0]->codigo_producto,
                                    'pa_id_pendiente' => $pendiente[$i]->id_pendiente]);



                    }else{
                        $s = DB::select('SELECT codigo_producto from clase_productos where item = ?', [$pendiente[$i]->item]);
                        DB::update('UPDATE pendiente set codigo_productos = ? where id_pendiente = ?', [$s[0]->codigo_producto,$pendiente[$i]->id_pendiente]);

                        DB::insert('CALL insertar_pendiente_materiales(:pa_item,
                                                        :cod_producto,
                                                        :pa_id_pendiente)',
                                            ['pa_item' => $pendiente[$i]->item,
                                             'cod_producto' => $s[0]->codigo_producto,
                                             'pa_id_pendiente' => $pendiente[$i]->id_pendiente]);
                    }
                }
            }

            return redirect()->route('pendiente');
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('notificacionErrorEjecucion', ['error' => $e->getMessage(), 'mensaje' => $item_sampler_mensaje]);
        }
    }


    public function actualizar_datos(Request $request)
    {
        $pendiente = DB::select(
            'call buscar_pendiente(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
                                    :pa_items,:pa_orden_sist,:pa_ordenes,
                                    :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
                                    :pa_empaques,:pa_meses,:r_mill)',
            [
                'uno' =>  is_null($request->r_uno)?'':$request->r_uno,
                'dos' =>  is_null($request->r_dos)?'':$request->r_dos,
                'tres' =>  is_null($request->r_tres)?'':$request->r_tres,
                'cuatro' =>  is_null($request->r_cuatro)?'':$request->r_cuatro,
                'pres' =>  is_null($request->r_cinco)?'':$request->r_cinco,
                'seis' =>  is_null($request->r_seis)?'':$request->r_seis,
                'siete' =>  is_null($request->r_siete)?'':$request->r_siete,
                'paginacion' =>  -1,
                'pa_marcas' =>  is_null($request->busqueda_marcas_p)?'':$request->busqueda_marcas_p,
                'pa_nombre' =>  is_null($request->busqueda_nombre_p)?'':$request->busqueda_nombre_p,
                'pa_vitolas' => is_null($request->busqueda_vitolas_p)?'':$request->busqueda_vitolas_p,
                'pa_capas' =>  is_null($request->busqueda_capas_p)?'':$request->busqueda_capas_p,
                'pa_empaques' =>  is_null($request->busqueda_empaques_p)?'':$request->busqueda_empaques_p,
                'pa_meses' =>  is_null($request->busqueda_mes_p)?'':$request->busqueda_mes_p,
                'pa_items' =>  is_null($request->busqueda_items_p)?'':$request->busqueda_items_p,
                'pa_orden_sist' =>  is_null($request->busqueda_ordenes_p)?'':$request->busqueda_ordenes_p,
                'pa_ordenes' =>  is_null($request->busqueda_hons_p)?'':$request->busqueda_hons_p,
                'r_mill' =>  is_null($request->r_mill)?'':$request->r_mill,

            ]
        );

        try {
            $total_materiales = 0;

            foreach ($pendiente as $key => $value) {

                $detalles_materiale = DB::select('call traer_materiales_pendiente(?)', [$value->id_pendiente]);

                foreach ($detalles_materiale as $materiale) {

                    $total_orden = 0;

                    if ($materiale->uxe == 'NO') {

                        $total_orden = $value->saldo;
                    } else if ($materiale->uxe == 'SI') {
                        if($value->por_caja>0){
                            $total_orden = (($value->saldo / $value->por_caja) * $materiale->cantidad);
                        }
                    }
                    DB::update('UPDATE detalles_pendiente_materiales
                                            SET cantidad = ?,
                                            co_material = ?
                                        WHERE id = ?', [$total_orden, $materiale->codigo_material, $materiale->id_de_detalles]);

                    $total_materiales += $total_orden;
                    $existencia_material_actual = $materiale->saldo - $total_orden;
                    $anteriores = DB::select(
                        'SELECT SUM(detalles_pendiente_materiales.cantidad) AS "anterioir"
                                                                            FROM detalles_pendiente_materiales
                                                                            WHERE detalles_pendiente_materiales.co_material = ?
                                                                                    AND id < ?',
                        [
                            $materiale->codigo_material,
                            $materiale->id_de_detalles
                        ]
                    );

                    $existencia_material_actual -= $anteriores[0]->anterioir;

                    $valor_exist_ma = $materiale->saldo - $anteriores[0]->anterioir;

                    DB::update('UPDATE detalles_pendiente_materiales
                                        SET restante = ?,
                                        existencia_material = ?
                                        WHERE id = ?', [
                        $existencia_material_actual,
                        $valor_exist_ma < 0 ? 0 : $valor_exist_ma,
                        $materiale->id_de_detalles
                    ]);
                }
            }

            return redirect()->route('pendiente');

        } catch (Exception $e) {
            $this->dispatchBrowserEvent('notificacionErrorEjecucion', ['error' => $e->getMessage(), 'mensaje' => 'errores']);
        }

    }


    public function exportPendienteMateriales(Request $request)
    {
        $pendiente = DB::select(
            'call buscar_pendiente(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
                                    :pa_items,:pa_orden_sist,:pa_ordenes,
                                    :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
                                    :pa_empaques,:pa_meses,:r_mill)',
            [
                'uno' =>  is_null($request->r_uno)?'':$request->r_uno,
                'dos' =>  is_null($request->r_dos)?'':$request->r_dos,
                'tres' =>  is_null($request->r_tres)?'':$request->r_tres,
                'cuatro' =>  is_null($request->r_cuatro)?'':$request->r_cuatro,
                'pres' =>  is_null($request->r_cinco)?'':$request->r_cinco,
                'seis' =>  is_null($request->r_seis)?'':$request->r_seis,
                'siete' =>  is_null($request->r_siete)?'':$request->r_siete,
                'paginacion' =>  -1,
                'pa_marcas' =>  is_null($request->busqueda_marcas_p)?'':$request->busqueda_marcas_p,
                'pa_nombre' =>  is_null($request->busqueda_nombre_p)?'':$request->busqueda_nombre_p,
                'pa_vitolas' => is_null($request->busqueda_vitolas_p)?'':$request->busqueda_vitolas_p,
                'pa_capas' =>  is_null($request->busqueda_capas_p)?'':$request->busqueda_capas_p,
                'pa_empaques' =>  is_null($request->busqueda_empaques_p)?'':$request->busqueda_empaques_p,
                'pa_meses' =>  is_null($request->busqueda_mes_p)?'':$request->busqueda_mes_p,
                'pa_items' =>  is_null($request->busqueda_items_p)?'':$request->busqueda_items_p,
                'pa_orden_sist' =>  is_null($request->busqueda_ordenes_p)?'':$request->busqueda_ordenes_p,
                'pa_ordenes' =>  is_null($request->busqueda_hons_p)?'':$request->busqueda_hons_p,
                'r_mill' =>  is_null($request->r_mill)?'':$request->r_mill,

            ]
        );


        return Excel::download(new PendienteMaterialesExport($pendiente), 'PendienteMateriales.xlsx');
    }


    public function imprimir_materiales(Request $request)
    {

        $mater_programacion = DB::select('call exportar_materiales_pendiente(:pa_item,
                                                                                        :pa_orden,
                                                                                        :pa_orden_del_sitema,
                                                                                        :pa_mes)',
                                                    [
                                                        'pa_item' => is_null($request->busqueda_items_p)?'':$request->busqueda_items_p,
                                                        'pa_orden' => is_null($request->busqueda_hons_p)?'':$request->busqueda_items_p,
                                                        'pa_orden_del_sitema' =>is_null($request->busqueda_ordenes_p)?'':$request->busqueda_items_p,
                                                        'pa_mes' => is_null($request->busqueda_mes_p)?'':$request->busqueda_items_p
                                                    ]);

        $vista =  view('Exports.materiales-pnedientes-export', [
            'materiales' => $mater_programacion
        ]);

        return Excel::download(new MaterialesProgramacionExportView($vista,'Materiales'), 'Materiales Pendiente ('.Carbon::now()->format('Y-m-d').').xlsx');

    }

}
