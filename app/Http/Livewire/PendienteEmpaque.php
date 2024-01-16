<?php

namespace App\Http\Livewire;

use App\Exports\detallesExport;
use App\Exports\MaterialesProgramacionExportView;
use App\Exports\PendienteEmpaqueCuadradoExport;
use Livewire\Component;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendienteEmpaqueExport;
use App\Exports\PendienteEmpaqueMaterialesExport;
use App\Exports\SheetMaterialesProgramacionExport;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PendienteEmpaque extends Component
{

    public $datos_pendiente_empaque;
    public $nombre;
    public $tuplas;
    public $datos_pendiente_empaque_nuevo;
    public $json_datos_pendiente_empaque;


    public $id_detalle = 0;

    public $datos_pendiente;
    public $tuplas_conteo;
    public $paginacion;

    public $codigo_item;

    // variables del wire model
    public $r_uno = "1";
    public $r_dos = "2";
    public $r_tres = "3";
    public $r_cuatro = "4";
    public $r_cinco = "Puros Tripa Larga";
    public $r_seis = "Puros Tripa Corta";
    public $r_siete = "Puros Sandwich";
    public $r_mill = "Puros Brocha";


    public $materiales = false;


    /* procedimientos almacanedos cargar select de nuevo pendiente*/
    public $marcas;
    public $capas;
    public $nombres;
    public $vitolas;
    public $tipo_empaques;
    public $items_agregar = [];

    public $busqueda = '';
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

    public $busqueda_marcas_p;
    public $busqueda_nombre_p;
    public $busqueda_vitolas_p;
    public $busqueda_capas_p;
    public $busqueda_empaques_p;
    public $busqueda_mes_p;
    public $busqueda_items_p;
    public $busqueda_ordenes_p;
    public $busqueda_hons_p;
    public $todos;


    public $capas_nuevo;
    public $marcas_nuevo;
    public $nombres_nuevo;
    public $vitolas_nuevo;
    public $tipo_empaques_nuevo;
    public $presentacion;
    public $codigo_precio_nuevo;
    public $precio_precio;


    //detalle programacion*****************************************************************
    public $detalles_provicionales;
    public $busqueda_programacion;
    public $borrar_programacion;
    public $actualizar;
    public $actualizar_insertar;
    public $fecha;
    public $contenedor;
    public $insertar_programacion;
    public $fecha_actual;
    public $total_saldo;

    public $ventanas = 1;
    public $programacion_actual = 1;

    public function cambio($num)
    {
        $this->ventanas = $num;
    }

    public function render()
    {
        //pendient empaque*****************************************************************

        if ($this->ventanas == 1) {
            $this->cargaPendiente();
        }
        if ($this->ventanas != 1) {
            $this->cargaDetalleProgramacion();
        }

        $this->dispatchBrowserEvent('tamanio_tabla');

        $puros = DB::select('CALL `pendiente_empaque_puros`()');
        $cajas =  DB::select('CALL `pendiente_empaque_cajas`()');

        $purosArray = [];
        $cajasArray2 = [];
        foreach ($puros as $key => $uso) {
            $purosArray[$uso->codigo_producto] =  $uso->total;
        }
        foreach ($cajas as $key => $value) {
            $cajasArray2[$value->codigo] =  $value->existencia;
        }

        return view('livewire.pendiente-empaque', [
            'puros' => $purosArray,
            'cajas' => $cajasArray2
        ])->extends('principal')->section('content');
    }

    public function mount()
    {
        $this->datos_pendiente_empaque = [];

        $this->busqueda_programacion = "";

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

    public function insertar_detalle_provicional()
    {
        $datos_pendiente_empaque = DB::select(
            'call buscar_pendiente_empaque(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
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



        $datos = [];
        $cantidad_detalle_sampler = 0;
        $detalles = 0;
        $valores = [];

        foreach ($datos_pendiente_empaque as $key => $value) {

            if ($value->sampler == "si") {
                if ($cantidad_detalle_sampler == 0 && $detalles == 0) {
                    $datos = DB::select('call traer_numero_detalles_productos(?)', [$value->item]);
                    $cantidad_detalle_sampler = $datos[0]->tuplas;
                }
                $valores = DB::select('call traer_detalles_productos_actualizar(?,?)', [$value->item, $detalles]);

                $value->cod_producto = isset($valores[0]->codigo_producto) ? $valores[0]->codigo_producto : "";
                DB::update(
                    'UPDATE pendiente_empaque SET codigo_poducto= ? WHERE  id_pendiente= ?;',
                    [isset($valores[0]->codigo_producto) ? $valores[0]->codigo_producto : "", $value->id_pendiente]
                );
                $detalles++;

                if ($detalles == $cantidad_detalle_sampler) {
                    $detalles = 0;
                    $cantidad_detalle_sampler = 0;
                }
            } else {
                $valores = DB::select('SELECT codigo_producto FROM clase_productos WHERE item = ?', [$value->item]);

                $value->cod_producto = isset($valores[0]->codigo_producto) ? $valores[0]->codigo_producto : "";
            }
        }



        foreach ($datos_pendiente_empaque as $key => $value2) {
            $detalles = DB::select(
                'call insertar_detallePro_temporalSinExistencia(:numero_orden,:orden,:cod_producto,:saldo,:id_pendiente,:cant,:num)',
                [
                    'numero_orden' => isset($value2->orden_del_sitema) ? $value2->orden_del_sitema : null,
                    'orden' => isset($value2->orden) ? $value2->orden : null,
                    'cod_producto' => isset($value2->cod_producto) ? $value2->cod_producto : null,
                    'saldo' => isset($value2->saldo) ? $value2->saldo : null,
                    'id_pendiente' => isset($value2->id_pendiente) ? $value2->id_pendiente : null,
                    'cant' => isset($value2->cant_cajas) ? $value2->cant_cajas : null,
                    'num' => $this->programacion_actual
                ]
            );

            $detalles_p = DB::select('CALL mostrar_ultimo_detalles_provicional()');

            $existencia_actual = 0;
            $pendiente_restante = 0;
            $total_materiales = 0;

            foreach ($detalles_p as $key => $value) {


                if ($value->cod_producto == null) {
                    $existe_puros = [];
                } else {
                    $existe_puros = DB::select('SELECT * FROM importar_existencias WHERE codigo_producto = ?', [$value->cod_producto]);
                }



                if (count($existe_puros) > 0) {
                    $exi = $existe_puros[0]->total;
                    $pendiente_restante =  $exi - intval($value->saldo);
                    $anteriores_puros = DB::select(
                        'SELECT SUM(detalle_programacion_temporal.saldo) AS "anterioir"
                                                FROM detalle_programacion_temporal
                                                WHERE detalle_programacion_temporal.cod_producto = ?
                                                        AND id_detalle_programacion < ?',
                        [
                            $value->cod_producto,
                            $value->id
                        ]
                    );

                    $pendiente_restante -= $anteriores_puros[0]->anterioir;

                    $valor_exist = $exi - $anteriores_puros[0]->anterioir;

                    DB::update(
                        'UPDATE detalle_programacion_temporal
                    SET detalle_programacion_temporal.cantidad_sobrante_puros = ?,
                        detalle_programacion_temporal.existencia_puros = ?
                    WHERE detalle_programacion_temporal.id_detalle_programacion =  ?',

                        [
                            $pendiente_restante,
                            $valor_exist < 0 ? 0 : $valor_exist,
                            $value->id
                        ]
                    );
                }

                if ($value->codigo_caja == null) {
                    $existe_caja = [];
                } else {
                    $existe_caja = DB::select('SELECT * FROM lista_cajas WHERE codigo = ?', [$value->codigo_caja]);
                }


                if (count($existe_caja) > 0) {



                    $existencia_actual = $existe_caja[0]->existencia - $value->cant_cajas_necesarias;
                    $anteriores = DB::select(
                        'SELECT SUM(detalle_programacion_temporal.cant_cajas) AS "anterioir"
                                                FROM detalle_programacion_temporal
                                                WHERE detalle_programacion_temporal.codigo_caja = ?
                                                        AND id_detalle_programacion < ?',
                        [
                            $value->codigo_caja,
                            $value->id
                        ]
                    );

                    $existencia_actual -= $anteriores[0]->anterioir;

                    $valor_exist_c = $existe_caja[0]->existencia - $anteriores[0]->anterioir;

                    DB::update(
                        'UPDATE detalle_programacion_temporal
                    SET detalle_programacion_temporal.cantida_sobrante = ?,
                        detalle_programacion_temporal.existencia_cajas = ?
                    WHERE detalle_programacion_temporal.id_detalle_programacion =  ?',
                        [
                            $existencia_actual,
                            $valor_exist_c < 0 ? 0 : $valor_exist_c,
                            $value->id
                        ]
                    );
                }



                $detalles_materiale = DB::select('call traer_materiales_temporal(?)', [$value->id]);

                foreach ($detalles_materiale as $materiale) {

                    $total_orden = 0;

                    if ($materiale->uxe == 'NO') {

                        $total_orden = $value->saldo;
                    } else if ($materiale->uxe == 'SI') {

                        if (($value->por_caja % 3) == 0) {
                            $total_orden = $value->saldo / (120 / $materiale->cantidad);
                        } else {
                            $total_orden = $value->saldo / (100 / $materiale->cantidad);
                        }
                    }
                    DB::update('UPDATE detalles_temporal_materiales
                                        SET cantidad = ?,
                                        co_material = ?
                                    WHERE id = ?', [$total_orden, $materiale->codigo_material, $materiale->id_de_detalles]);

                    $total_materiales += $total_orden;
                    $existencia_material_actual = $materiale->saldo - $total_orden;
                    $anteriores = DB::select(
                        'SELECT SUM(detalles_temporal_materiales.cantidad) AS "anterioir"
                                                                        FROM detalles_temporal_materiales
                                                                        WHERE detalles_temporal_materiales.co_material = ?
                                                                                AND id < ?',
                        [
                            $materiale->codigo_material,
                            $materiale->id_de_detalles
                        ]
                    );

                    $existencia_material_actual -= $anteriores[0]->anterioir;

                    $valor_exist_ma = $materiale->saldo - $anteriores[0]->anterioir;

                    DB::update('UPDATE detalles_temporal_materiales
                                    SET restante = ?,
                                    existencia_material = ?
                                    WHERE id = ?', [
                        $existencia_material_actual,
                        $valor_exist_ma < 0 ? 0 : $valor_exist_ma,
                        $materiale->id_de_detalles
                    ]);
                }
            }
        }



        $this->cambio(2);
    }

    public function insertar_detalle_provicional_sin_existencia($id)
    {

        $datos_pendiente = DB::select(
            'call datos_pendiente_programar(:id)',
            ['id' => $id]
        );

        DB::select(
            'call insertar_detallePro_temporalSinExistencia(:numero_orden,:orden,:cod_producto,:saldo,:id_pendiente,:cant,:num)',
            [
                'numero_orden' => isset($datos_pendiente[0]->orden_del_sitema) ? $datos_pendiente[0]->orden_del_sitema : null,
                'orden' => isset($datos_pendiente[0]->orden) ? $datos_pendiente[0]->orden : null,
                'cod_producto' => isset($datos_pendiente[0]->codigo_producto) ? $datos_pendiente[0]->codigo_producto : null,
                'saldo' => isset($datos_pendiente[0]->saldo) ? $datos_pendiente[0]->saldo : null,
                'id_pendiente' => isset($datos_pendiente[0]->id_pendiente) ? $datos_pendiente[0]->id_pendiente : null,
                'cant' => isset($datos_pendiente[0]->cant_cajas) ? $datos_pendiente[0]->cant_cajas : null,
                'num' => $this->programacion_actual
            ]
        );

        $detalles_p = DB::select('CALL mostrar_ultimo_detalles_provicional()');

        $existencia_actual = 0;
        $pendiente_restante = 0;
        $total_materiales = 0;

        foreach ($detalles_p as $key => $value) {


            if ($value->cod_producto == null) {
                $existe_puros = [];
            } else {
                $existe_puros = DB::select('SELECT * FROM importar_existencias WHERE codigo_producto = ?', [$value->cod_producto]);
            }



            if (count($existe_puros) > 0) {
                $exi = $existe_puros[0]->total;
                $pendiente_restante =  $exi - intval($value->saldo);
                $anteriores_puros = DB::select(
                    'SELECT SUM(detalle_programacion_temporal.saldo) AS "anterioir"
                                                FROM detalle_programacion_temporal
                                                WHERE detalle_programacion_temporal.cod_producto = ?
                                                        AND id_detalle_programacion < ?',
                    [
                        $value->cod_producto,
                        $value->id
                    ]
                );

                $pendiente_restante -= $anteriores_puros[0]->anterioir;

                $valor_exist = $exi - $anteriores_puros[0]->anterioir;

                DB::update(
                    'UPDATE detalle_programacion_temporal
                    SET detalle_programacion_temporal.cantidad_sobrante_puros = ?,
                        detalle_programacion_temporal.existencia_puros = ?
                    WHERE detalle_programacion_temporal.id_detalle_programacion =  ?',

                    [
                        $pendiente_restante,
                        $valor_exist < 0 ? 0 : $valor_exist,
                        $value->id
                    ]
                );
            }

            if ($value->codigo_caja == null) {
                $existe_caja = [];
            } else {
                $existe_caja = DB::select('SELECT * FROM lista_cajas WHERE codigo = ?', [$value->codigo_caja]);
            }


            if (count($existe_caja) > 0) {



                $existencia_actual = $existe_caja[0]->existencia - $value->cant_cajas_necesarias;
                $anteriores = DB::select(
                    'SELECT SUM(detalle_programacion_temporal.cant_cajas) AS "anterioir"
                                                FROM detalle_programacion_temporal
                                                WHERE detalle_programacion_temporal.codigo_caja = ?
                                                        AND id_detalle_programacion < ?',
                    [
                        $value->codigo_caja,
                        $value->id
                    ]
                );

                $existencia_actual -= $anteriores[0]->anterioir;

                $valor_exist_c = $existe_caja[0]->existencia - $anteriores[0]->anterioir;

                DB::update(
                    'UPDATE detalle_programacion_temporal
                    SET detalle_programacion_temporal.cantida_sobrante = ?,
                        detalle_programacion_temporal.existencia_cajas = ?
                    WHERE detalle_programacion_temporal.id_detalle_programacion =  ?',
                    [
                        $existencia_actual,
                        $valor_exist_c < 0 ? 0 : $valor_exist_c,
                        $value->id
                    ]
                );
            }



            $detalles_materiale = DB::select('call traer_materiales_temporal(?)', [$value->id]);

            foreach ($detalles_materiale as $materiale) {

                $total_orden = 0;

                if ($materiale->uxe == 'NO') {

                    $total_orden = $value->saldo;
                } else if ($materiale->uxe == 'SI') {

                    if (($value->por_caja % 3) == 0) {
                        $total_orden = $value->saldo / (120 / $materiale->cantidad);
                    } else {
                        $total_orden = $value->saldo / (100 / $materiale->cantidad);
                    }
                }
                DB::update('UPDATE detalles_temporal_materiales
                                        SET cantidad = ?,
                                        co_material = ?
                                    WHERE id = ?', [$total_orden, $materiale->codigo_material, $materiale->id_de_detalles]);

                $total_materiales += $total_orden;
                $existencia_material_actual = $materiale->saldo - $total_orden;
                $anteriores = DB::select(
                    'SELECT SUM(detalles_temporal_materiales.cantidad) AS "anterioir"
                                                                        FROM detalles_temporal_materiales
                                                                        WHERE detalles_temporal_materiales.co_material = ?
                                                                                AND id < ?',
                    [
                        $materiale->codigo_material,
                        $materiale->id_de_detalles
                    ]
                );

                $existencia_material_actual -= $anteriores[0]->anterioir;

                $valor_exist_ma = $materiale->saldo - $anteriores[0]->anterioir;

                DB::update('UPDATE detalles_temporal_materiales
                                    SET restante = ?,
                                    existencia_material = ?
                                    WHERE id = ?', [
                    $existencia_material_actual,
                    $valor_exist_ma < 0 ? 0 : $valor_exist_ma,
                    $materiale->id_de_detalles
                ]);
            }
        }



        $this->cambio(2);
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
                'call actualizar_pendiente_empaque(:id_pendientea2,:observacion2,:pendiente2,:saldo2,:orden_sistema2,:orden2)',
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

    public function eliminar_pendiente($request)
    {
        DB::select('call borrar_pendiente_empaque(:eliminar)', ['eliminar' => $request['id_pendiente3']]);

        try {
            $datos = [];
            $cantidad_detalle_sampler = 0;
            $detalles = 0;
            $valores = [];

            $datos_empaque =  DB::select(
                'call buscar_pendiente_empaque(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
                :pa_items,:pa_orden_sist,:pa_ordenes,
                :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
                :pa_empaques,:pa_meses,:r_mill )',
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
                    'r_mill' =>  $this->r_mill
                ]
            );


            for ($i = 0; $i < count($datos_empaque); $i++) {

                $sampler = DB::select('SELECT clase_productos.sampler FROM clase_productos WHERE  clase_productos.item = ?;', [$datos_empaque[$i]->item]);

                if (isset($sampler[0])) {
                    if ($sampler[0]->sampler == "si") {
                        if ($cantidad_detalle_sampler == 0 && $detalles == 0) {
                            $datos = DB::select('call traer_numero_detalles_productos(?)', [$datos_empaque[$i]->item]);
                            $cantidad_detalle_sampler = $datos[0]->tuplas;
                        }
                        $valores = DB::select('call traer_detalles_productos_actualizar(?,?)', [$datos_empaque[$i]->item, $detalles]);

                        //echo  $this->datos_pendiente_empaque[$i]->id_pendiente." ".$this->datos_pendiente_empaque[$i]->item." "."(". $cantidad_detalle_sampler.")"."<br>";
                        DB::select('call actualizar_pendiente_empaque_sampler(:marca,:nombre,:vitola,:capa,:tipo,:item)', [
                            'marca' => $valores[0]->marca,
                            'nombre' => $valores[0]->nombre,
                            'vitola' => $valores[0]->vitola,
                            'capa' => $valores[0]->capa,
                            'tipo' => $valores[0]->tipo_empaque,
                            'item' =>  $datos_empaque[$i]->id_pendiente
                        ]);

                        $detalles++;

                        if ($detalles == $cantidad_detalle_sampler) {
                            $detalles = 0;
                            $cantidad_detalle_sampler = 0;
                        }
                    }
                }
            }
        } catch (Exception $t) {
        }
        $this->dispatchBrowserEvent('notificacionConfirmacionDelete');
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
                'call insertar_nuevo_pendiente_empaque(:categoria,:item,:orden,:observacion,:mes,:orden1,:pendiente,:saldo)',
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

    public function exportPendiente()
    {
        try {
            $datos = [];
            $cantidad_detalle_sampler = 0;
            $detalles = 0;
            $valores = [];

            $datos_empaque =  DB::select(
                'call buscar_pendiente_empaque(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
                :pa_items,:pa_orden_sist,:pa_ordenes,
                :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
                :pa_empaques,:pa_meses,:r_mill )',
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
                    'r_mill' =>  $this->r_mill
                ]
            );


            for ($i = 0; $i < count($datos_empaque); $i++) {

                $sampler = DB::select('SELECT clase_productos.sampler FROM clase_productos WHERE  clase_productos.item = ?;', [$datos_empaque[$i]->item]);

                if (isset($sampler[0])) {
                    if ($sampler[0]->sampler == "si") {
                        if ($cantidad_detalle_sampler == 0 && $detalles == 0) {
                            $datos = DB::select('call traer_numero_detalles_productos(?)', [$datos_empaque[$i]->item]);
                            $cantidad_detalle_sampler = $datos[0]->tuplas;
                        }
                        $valores = DB::select('call traer_detalles_productos_actualizar(?,?)', [$datos_empaque[$i]->item, $detalles]);

                        //echo  $this->datos_pendiente_empaque[$i]->id_pendiente." ".$this->datos_pendiente_empaque[$i]->item." "."(". $cantidad_detalle_sampler.")"."<br>";
                        DB::select('call actualizar_pendiente_empaque_sampler(:marca,:nombre,:vitola,:capa,:tipo,:item)', [
                            'marca' => $valores[0]->marca,
                            'nombre' => $valores[0]->nombre,
                            'vitola' => $valores[0]->vitola,
                            'capa' => $valores[0]->capa,
                            'tipo' => $valores[0]->tipo_empaque,
                            'item' =>  $datos_empaque[$i]->id_pendiente
                        ]);

                        $detalles++;

                        if ($detalles == $cantidad_detalle_sampler) {
                            $detalles = 0;
                            $cantidad_detalle_sampler = 0;
                        }
                    }
                }
            }
        } catch (Exception $t) {
        }
        $pendiente_export = DB::select(
            'call buscar_pendiente_empaque_excel(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,
        :pa_items,:pa_orden_sist,:pa_ordenes,
        :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
        :pa_empaques,:pa_meses,:r_mill)',
            [
                'uno' => $this->r_uno,
                'dos' => $this->r_dos,
                'tres' => $this->r_tres,
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

        return Excel::download(new PendienteEmpaqueExport($pendiente_export), 'Pendiente.xlsx');
    }

    public function cargaPendiente()
    {
        $this->detalles_provicionales = [];
        $this->capas = DB::select('call buscar_capa("")');
        $this->nombres = DB::select('call buscar_nombre("")');
        $this->vitolas = DB::select('call buscar_vitola("")');
        $this->marcas = DB::select('call buscar_marca("")');
        $this->items_agregar = DB::select('select item from clase_productos');
        $this->tipo_empaques = DB::select('call buscar_tipo_empaque("")');

        $todos = DB::select(
            'call buscar_pendiente_empaque(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
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

            $this->datos_pendiente_empaque = $todos;
        } else {
            $this->datos_pendiente_empaque = DB::select(
                'call buscar_pendiente_empaque(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
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


        if (count($todos) > 0) {

            $this->marcas_p = [];
            $this->nombre_p = [];
            $this->vitolas_p = [];
            $this->capas_p = [];
            $this->empaques_p = [];
            $this->mes_p = [];
            $this->items_p = [];
            $this->ordenes_p = [];
            $this->hons_p = [];

            foreach ($todos as $detalles) {
                array_push($this->marcas_p, $detalles->marca);
                array_push($this->nombre_p, $detalles->nombre);
                array_push($this->vitolas_p, $detalles->vitola);
                array_push($this->capas_p, $detalles->capa);
                array_push($this->empaques_p, $detalles->tipo_empaque);

                array_push($this->mes_p, $detalles->mes);
                array_push($this->items_p, $detalles->item);
                array_push($this->ordenes_p, $detalles->orden_del_sitema);
                array_push($this->hons_p, $detalles->orden);
            }

            $this->marcas_p = array_unique($this->marcas_p);
            $this->nombre_p = array_unique($this->nombre_p);
            $this->vitolas_p = array_unique($this->vitolas_p);
            $this->capas_p = array_unique($this->capas_p);
            $this->empaques_p = array_unique($this->empaques_p);
            $this->mes_p = array_unique($this->mes_p);
            $this->items_p = array_unique($this->items_p);
            $this->ordenes_p = array_unique($this->ordenes_p);
            $this->hons_p = array_unique($this->hons_p);
        }


        Cache::put('json_datos_pendiente_empaque', $todos);
    }

    /***************** TODO funciones de detalle programacion*********************/

    public function eliminar_Detalles($id)
    {
        DB::select(
            'call eliminar_detalles(:buscar)',
            [
                'buscar' => $id
            ]
        );
    }

    public function cargaDetalleProgramacion()
    {
        $this->capas = [];
        $this->nombres = [];
        $this->vitolas = [];
        $this->marcas = [];
        $this->items_agregar = [];
        $this->tipo_empaques = [];
        $this->marcas_p = [];
        $this->nombre_p = [];
        $this->vitolas_p = [];
        $this->capas_p = [];
        $this->empaques_p = [];
        $this->mes_p = [];
        $this->items_p = [];
        $this->ordenes_p = [];
        $this->hons_p = [];
        $this->datos_pendiente_empaque = [];

        $this->total_saldo = 0;
        $this->detalles_provicionales =  DB::select('call mostrar_detalles_provicional(:buscar,:num)', [
            'buscar' => '',
            'num' => $this->programacion_actual
        ]);

        foreach ($this->detalles_provicionales as $key => $value) {

            $this->total_saldo += $value->saldo;

            if ($value->sampler == 'si') {
                $value->marca = $value->descripcion_sampler . ' ' . $value->marca;
            }
        }
    }

    public function modal_limpiar()
    {
        $this->dispatchBrowserEvent('abrir_modal_eliminar');
    }

    public function eliminar_datos()
    {
        DB::table('detalle_programacion_temporal')->delete();
        DB::update("ALTER TABLE detalle_programacion_temporal AUTO_INCREMENT = 1");
        $this->dispatchBrowserEvent('cerrar_modal_eliminar');
    }

    public function actualizar_saldo($id, $saldo)
    {
        $this->actualizar = DB::select(
            'call actualizar_saldo_programacion(:id, :saldo)',
            [
                'id' => $id,
                'saldo' => $saldo
            ]
        );
    }

    public function insertarDetalle_y_actualizarPendiente($resquest)
    {
        try {

            $provicionales = DB::select('SELECT * FROM detalle_programacion_temporal');

            $this->insertar_programacion = DB::select(
                'call insertar_programacion(:fecha,:contenedor)',
                [
                    'fecha' => $resquest['fecha'],
                    'contenedor' => $resquest['contenedor']
                ]
            );

            foreach ($provicionales as $key => $value) {


                DB::insert(
                    'call insertar_detalle_programacion(:pa_id_detalle_temporal,
                                                    :pa_numero_orden,
                                                    :pa_orden,
                                                    :pa_cod_producto,
                                                    :pa_saldo,
                                                    :pa_id_pendiente,
                                                    :pa_caja_sobrantes,
                                                    :pa_cant_cajas,
                                                    :pa_codigo_caja,
                                                    :pa_cantidad_sobrante_puros,
                                                    :pa_des_contenedor)',
                    [
                        'pa_id_detalle_temporal' => $value->id_detalle_programacion,
                        'pa_numero_orden' => $value->numero_orden,
                        'pa_orden' => $value->orden,
                        'pa_cod_producto' => $value->cod_producto,
                        'pa_saldo' => $value->saldo,
                        'pa_id_pendiente' => $value->id_pendiente,
                        'pa_caja_sobrantes' => $value->cantida_sobrante,
                        'pa_cant_cajas' => $value->cant_cajas,
                        'pa_codigo_caja' => $value->codigo_caja,
                        'pa_cantidad_sobrante_puros' => $value->cantidad_sobrante_puros,
                        'pa_des_contenedor' => $resquest['contenedor']
                    ]
                );
            }

            DB::delete('TRUNCATE TABLE detalle_programacion_temporal');
            DB::delete('TRUNCATE TABLE detalles_temporal_materiales');

            $this->dispatchBrowserEvent('error_general', ['errorr' => 'Programacion creada con exito', 'icon' => 'success']);
        } catch (Exception $t) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $t->getMessage(), 'icon' => 'error']);
        }

        //return redirect()->route('historial_programacion');
    }



    public function exportProgramacion()
    {
        return Excel::download(new detallesExport($this->materiales, $this->programacion_actual), 'ProgramaciónPro.xlsx');
    }

    public function imprimir_materiales()
    {

        $this->materiales_programacion = DB::select('call exportar_materiales_temporal()');

        $vista =  view('Exports.materiales-programacion-export', [
            'materiales' => $this->materiales_programacion
        ]);

        $this->cajasProgramacion = DB::select('call exportar_cajas_temporal()');

        $vista2 =  view('Exports.cajas-programacion-export', [
            'materiales' => $this->cajasProgramacion
        ]);


        return Excel::download(new SheetMaterialesProgramacionExport($vista, $vista2), 'Materiales (' . Carbon::now()->format('Y-m-d') . ').xlsx');
    }

    public function actualizar_datos()
    {
        $detalles_p = DB::select('call mostrar_detalles_provicional(:buscar,:num)', [
            'buscar' => '',
            'num' => $this->programacion_actual
        ]);


        $detalles_p_materiales = DB::select('CALL `traer_materiales_temporal_todo`()');

        foreach ($detalles_p as $i => $value) {

            foreach ($detalles_p_materiales as $key => $value2) {
                if ($value->id == $value2->id_detalle_temporal) {
                    $value->materiales[] = $value2;
                }
            }

            if ($value->saldo == 0 && count(isset($value->materiales) ? $value->materiales : []) == 0) {
                $value->materiales[] = [

                    "id_de_detalles" => 96011,
                    "id_detalle_temporal" => 403,
                    "id_material" => 5788,
                    "id" => 5788,
                    "item" => "10499062",
                    "codigo_producto" => "P-03201",
                    "tipo_empaque" => 11,
                    "codigo_material" => "ME-06506",
                    "des_material" => "MATERIAL DE EMPAQUE ROCKY PATEL P.C. HEALTH WARNING TRANSPARENTE NEGRO",
                    "cantidad" => 1,
                    "uxe" => "SI",
                    "saldo" => "835190.00",
                    "cantidad_m" => "600.00",
                    "existencia_material" => "804168.40",
                    "restante" => "803568.40",
                    "co_material" => "ME-06506"

                ];
            } else if ($value->saldo == 0) {
                unset($value->materiales);
                $value->materiales[] = [

                    "id_de_detalles" => 96011,
                    "id_detalle_temporal" => 403,
                    "id_material" => 5788,
                    "id" => 5788,
                    "item" => "10499062",
                    "codigo_producto" => "P-03201",
                    "tipo_empaque" => 11,
                    "codigo_material" => "ME-06506",
                    "des_material" => "MATERIAL DE EMPAQUE ROCKY PATEL P.C. HEALTH WARNING TRANSPARENTE NEGRO",
                    "cantidad" => 1,
                    "uxe" => "SI",
                    "saldo" => "835190.00",
                    "cantidad_m" => "600.00",
                    "existencia_material" => "804168.40",
                    "restante" => "803568.40",
                    "co_material" => "ME-06506"

                ];
            } else if (count(isset($value->materiales) ? $value->materiales : []) == 0) {
                $mate = DB::select('SELECT * FROM materiales_productos WHERE materiales_productos.item = ? AND materiales_productos.codigo_producto = ?', [$value->item, $value->cod_producto]);


                foreach ($mate as $key => $un_detalle) {
                    $value->materiales[] = [

                        "id_de_detalles" => 96011,
                        "id_detalle_temporal" => $value->id,
                        "id_material" => $un_detalle->id,
                        "id" => $un_detalle->id,
                        "item" => $value->item,
                        "codigo_producto" => $value->cod_producto,
                        "tipo_empaque" => $un_detalle->tipo_empaque,
                        "codigo_material" =>  $un_detalle->codigo_material,
                        "des_material" => $un_detalle->des_material,
                        "cantidad" => $un_detalle->cantidad,
                        "uxe" => $un_detalle->uxe,
                        "saldo" => "835190.00",
                        "cantidad_m" => "600.00",
                        "existencia_material" => "804168.40",
                        "restante" => "803568.40",
                        "co_material" => $un_detalle->codigo_material

                    ];
                }
            }
        }



        DB::delete('TRUNCATE TABLE detalles_temporal_materiales;');


        $existencia_actual = 0;
        $pendiente_restante = 0;
        $total_materiales = 0;


        foreach ($detalles_p as $key => $value) {


            if ($value->cod_producto == null) {
                $existe_puros = [];
            } else {
                $existe_puros = DB::select('SELECT sum(total) as total FROM importar_existencias WHERE codigo_producto = ?', [$value->cod_producto]);

                if (count($existe_puros) == 0) {
                    $existe_puros = DB::select('SELECT 0 as total');
                }
            }



            if (count($existe_puros) > 0) {
                $exi = $existe_puros[0]->total;
                $pendiente_restante =  $exi - intval($value->saldo);
                $anteriores_puros = DB::select(
                    'SELECT SUM(detalle_programacion_temporal.saldo) AS "anterioir"
                                                FROM detalle_programacion_temporal
                                                WHERE detalle_programacion_temporal.cod_producto = ?
                                                        AND id_detalle_programacion < ?',
                    [
                        $value->cod_producto,
                        $value->id
                    ]
                );

                $pendiente_restante -= $anteriores_puros[0]->anterioir;

                $valor_exist = $exi - $anteriores_puros[0]->anterioir;

                DB::update(
                    'UPDATE detalle_programacion_temporal
                    SET detalle_programacion_temporal.cantidad_sobrante_puros = ?,
                        detalle_programacion_temporal.existencia_puros = ?
                    WHERE detalle_programacion_temporal.id_detalle_programacion =  ?',

                    [
                        ($value->cod_producto == null) ? 0 : ((intval($value->saldo) == 0) ? 0 : $pendiente_restante),
                        $valor_exist < 0 ? 0 : $valor_exist,
                        $value->id
                    ]
                );
            }

            if ($value->codigo_caja == null) {
                $existe_caja = [];
            } else {
                $existe_caja = DB::select('SELECT * FROM lista_cajas WHERE codigo = ?', [$value->codigo_caja]);
            }


            if (count($existe_caja) > 0) {



                $existencia_actual = $existe_caja[0]->existencia - $value->cant_cajas_necesarias;
                $anteriores = DB::select(
                    'SELECT SUM(detalle_programacion_temporal.cant_cajas) AS "anterioir"
                                                FROM detalle_programacion_temporal
                                                WHERE detalle_programacion_temporal.codigo_caja = ?
                                                        AND id_detalle_programacion < ?',
                    [
                        $value->codigo_caja,
                        $value->id
                    ]
                );

                $existencia_actual -= $anteriores[0]->anterioir;

                $valor_exist_c = $existe_caja[0]->existencia - $anteriores[0]->anterioir;

                DB::update(
                    'UPDATE detalle_programacion_temporal
                    SET detalle_programacion_temporal.cantida_sobrante = ?,
                        detalle_programacion_temporal.existencia_cajas = ?
                    WHERE detalle_programacion_temporal.id_detalle_programacion =  ?',
                    [
                        $existencia_actual,
                        $valor_exist_c < 0 ? 0 : $valor_exist_c,
                        $value->id
                    ]
                );
            }

            $saaldoviejo = 8;
            if ($value->saldo == 0) {

                $datso =  DB::select(
                    'SELECT detalle_programacion_temporal.*,tipo_empaques.por_caja
                                       FROM detalle_programacion_temporal
                                            INNER JOIN pendiente_empaque on pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente
                                            INNER JOIN tipo_empaques ON tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque
                                       WHERE pendiente_empaque.orden = ?
                                            and numero_orden = ?
                                            and pendiente_empaque.item = ?
                                            and pendiente_empaque.paquetes = ?
                                            and detalle_programacion_temporal.saldo>0

                                        limit 0,1',
                    [
                        $detalles_p[$key]->orden_hon,
                        $detalles_p[$key]->numero_orden,
                        $detalles_p[$key]->item,
                        $detalles_p[$key]->paquetes_sampler
                    ]
                );
                $saaldoviejo = $value->saldo;
                $value->saldo =  doubleval($datso[0]->saldo);
                $value->cant_cajas =  doubleval($datso[0]->cant_cajas);
                $value->cant_cajas_necesarias = doubleval($value->saldo / $datso[0]->por_caja);
            }




            if ($value->saldo > 0 && isset($value->materiales)) {

                foreach ($value->materiales as $materiale) {

                    $total_orden = 0;

                    if (!isset($materiale->uxe)) {

                        if ($materiale['uxe'] == 'NO') {

                            $total_orden = $value->saldo;
                        } else if ($materiale['uxe']  == 'SI') {

                            $total_orden = doubleval($value->cant_cajas_necesarias) * doubleval($materiale['cantidad']);
                        }
                        DB::insert(
                            'INSERT INTO detalles_temporal_materiales(`id_detalle_temporal`,
                                                                                 `id_material`,
                                                                                 `co_material`,
                                                                                 `cantidad`,
                                                                                 `existencia_material`,
                                                                                 `restante`)
                                             VALUES (?, ?, ?, ?, ?,?);',
                            [
                                $value->id,
                                $materiale['id_material'],
                                $materiale['codigo_material'],
                                $total_orden,
                                $materiale['saldo'],
                                $materiale['saldo'] - $total_orden
                            ]
                        );

                        $ultimo = DB::select('SELECT MAX(id) as "ultimoId" FROM detalles_temporal_materiales');


                        $total_materiales += $total_orden;
                        $existencia_material_actual = $materiale['saldo'] - $total_orden;
                        $anteriores = DB::select(
                            'SELECT SUM(detalles_temporal_materiales.cantidad) AS "anterioir"
                                                                            FROM detalles_temporal_materiales
                                                                            WHERE detalles_temporal_materiales.co_material = ?
                                                                                    AND id < ?',
                            [
                                $materiale['codigo_material'],
                                $ultimo[0]->ultimoId
                            ]
                        );

                        $existencia_material_actual -= $anteriores[0]->anterioir;

                        $valor_exist_ma = $materiale['saldo'] - $anteriores[0]->anterioir;

                        DB::update('UPDATE detalles_temporal_materiales
                                        SET restante = ?,
                                        existencia_material = ?
                                        WHERE id = ?', [
                            $existencia_material_actual,
                            $valor_exist_ma < 0 ? 0 : $valor_exist_ma,
                            $ultimo[0]->ultimoId
                        ]);
                    } else {

                        if ($materiale->uxe == 'NO') {

                            $total_orden = $value->saldo;
                        } else if ($materiale->uxe  == 'SI') {

                            $total_orden = doubleval($value->cant_cajas_necesarias) * doubleval($materiale->cantidad);
                        }
                        DB::insert(
                            'INSERT INTO detalles_temporal_materiales(`id_detalle_temporal`,
                                                                             `id_material`,
                                                                             `co_material`,
                                                                             `cantidad`,
                                                                             `existencia_material`,
                                                                             `restante`)
                                         VALUES (?, ?, ?, ?, ?,?);',
                            [
                                $materiale->id_detalle_temporal,
                                $materiale->id_material,
                                $materiale->codigo_material,
                                $total_orden,
                                $materiale->saldo,
                                $materiale->saldo - $total_orden
                            ]
                        );

                        $ultimo = DB::select('SELECT MAX(id) as "ultimoId" FROM detalles_temporal_materiales');


                        $total_materiales += $total_orden;
                        $existencia_material_actual = $materiale->saldo - $total_orden;
                        $anteriores = DB::select(
                            'SELECT SUM(detalles_temporal_materiales.cantidad) AS "anterioir"
                                                                        FROM detalles_temporal_materiales
                                                                        WHERE detalles_temporal_materiales.co_material = ?
                                                                                AND id < ?',
                            [
                                $materiale->codigo_material,
                                $ultimo[0]->ultimoId
                            ]
                        );

                        $existencia_material_actual -= $anteriores[0]->anterioir;

                        $valor_exist_ma = $materiale->saldo - $anteriores[0]->anterioir;

                        DB::update('UPDATE detalles_temporal_materiales
                                    SET restante = ?,
                                    existencia_material = ?
                                    WHERE id = ?', [
                            $existencia_material_actual,
                            $valor_exist_ma < 0 ? 0 : $valor_exist_ma,
                            $ultimo[0]->ultimoId
                        ]);
                    }
                }
            }
        }

        return redirect()->route('pendiente_empaque');
    }



    ##Datos de Fichas Materiales Pendiende Empaque


    public function actualizar_fichas_pendiente_empaque()
    {
        $item_sampler_mensaje = "";

        try {
            $datos_pendiente_empaque = Cache::get('json_datos_pendiente_empaque');
            DB::delete('TRUNCATE TABLE detalles_pendiente_empaque_materiales;');

            $datos = [];
            $cantidad_detalle_sampler = 0;
            $detalles = 0;
            $valores = [];

            foreach ($datos_pendiente_empaque as $detalle) {
                $item_sampler_mensaje = $detalle->id_pendiente;
                if ($detalle->sampler == "si") {
                    if ($cantidad_detalle_sampler == 0 && $detalles == 0) {
                        $cantidad_detalle_sampler = $detalle->tuplas;
                        $detalles = 0;
                    }
                    $valores = DB::select('call traer_detalles_productos_actualizar(?,?)', [$detalle->item, $detalles]);

                    $variable = DB::select('call actualizar_pendiente_empaque_sampler(:marca,:nombre,:vitola,:capa,:tipo,:item,:pa_codigo_poducto)', [
                        'marca' => $valores[0]->marca,
                        'nombre' => $valores[0]->nombre,
                        'vitola' => $valores[0]->vitola,
                        'capa' => $valores[0]->capa,
                        'tipo' => $valores[0]->tipo_empaque,
                        'item' =>  $detalle->id_pendiente,
                        'pa_codigo_poducto' => $valores[0]->codigo_producto,
                    ]);

                    $detalle->cod_producto = isset($valores[0]->codigo_producto) ? $valores[0]->codigo_producto : "";
                    DB::update(
                        'UPDATE pendiente_empaque SET codigo_poducto= ? WHERE  id_pendiente= ?;',
                        [isset($valores[0]->codigo_producto) ? $valores[0]->codigo_producto : "", $detalle->id_pendiente]
                    );


                    $detalles++;

                    if ($detalles == $cantidad_detalle_sampler) {
                        $detalles = 0;
                        $cantidad_detalle_sampler = 0;
                    }

                    DB::insert(
                        'CALL insertar_pendiente_empaque_materiales(:pa_item,
                        :cod_producto,
                        :pa_id_pendiente)',

                        [
                            'pa_item' => $detalle->item,
                            'cod_producto' => $valores[0]->codigo_producto,
                            'pa_id_pendiente' => $detalle->id_pendiente
                        ]
                    );
                } else {

                    $cantidad_detalle_sampler = 0;
                    $detalles = 0;
                    $valores = DB::select('SELECT codigo_producto FROM clase_productos WHERE item = ?', [$detalle->item]);

                    $detalle->cod_producto = isset($valores[0]->codigo_producto) ? $valores[0]->codigo_producto : "";


                    DB::update('UPDATE pendiente_empaque set codigo_poducto = ? where id_pendiente = ?', [$valores[0]->codigo_producto, $detalle->id_pendiente]);

                    DB::insert(
                        'CALL insertar_pendiente_empaque_materiales(:pa_item,
                                                        :cod_producto,
                                                        :pa_id_pendiente)',
                        [
                            'pa_item' => $detalle->item,
                            'cod_producto' => $valores[0]->codigo_producto,
                            'pa_id_pendiente' => $detalle->id_pendiente
                        ]
                    );
                }
            }

            return redirect()->route('pendiente_empaque');
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('error_vista_pendiente_empaque', ['newName' => $e->getMessage()]);
            $this->dispatchBrowserEvent('error_vista_pendiente_empaque', ['newName' => json_encode($detalle->tuplas)]);
            $this->dispatchBrowserEvent('error_vista_pendiente_empaque', ['newName' => json_encode($detalle)]);
            $this->dispatchBrowserEvent('error_vista_pendiente_empaque', ['newName' => json_encode($detalles)]);
            $this->dispatchBrowserEvent('error_vista_pendiente_empaque', ['newName' => json_encode($cantidad_detalle_sampler)]);
            $this->dispatchBrowserEvent('error_vista_pendiente_empaque', ['newName' => json_encode($item_sampler_mensaje)]);
        }
    }


    public function actualizar_datos_pendiente_empaque(Request $request)
    {
        $datos_pendiente_empaque = Cache::get('json_datos_pendiente_empaque');

        try {
            $total_materiales = 0;

            foreach ($datos_pendiente_empaque as $key => $value) {

                $detalles_materiale = DB::select('call traer_materiales_pendiente_empaque(?)', [$value->id_pendiente]);

                if ($value->saldo == 0) {
                    $promed = DB::select('call traer_promedio_saldo_sampler_pendiente_empaque(?)', [$value->id_pendiente]);
                    $value->saldo = $promed[0]->promedio;
                }


                foreach ($detalles_materiale as $materiale) {

                    $total_orden = 0;

                    if ($materiale->uxe == 'NO') {
                        $total_orden = $value->saldo;
                    } else if ($materiale->uxe == 'SI') {
                        if ($value->por_caja > 0) {
                            $total_orden = (($value->saldo / $value->por_caja) * $materiale->cantidad);
                        }
                    }

                    DB::update('UPDATE detalles_pendiente_empaque_materiales
                                            SET cantidad = ?,
                                            co_material = ?
                                        WHERE id = ?', [$total_orden, $materiale->codigo_material, $materiale->id_de_detalles]);

                    $total_materiales += $total_orden;
                    $existencia_material_actual = $materiale->saldo - $total_orden;
                    $anteriores = DB::select(
                        'SELECT SUM(detalles_pendiente_empaque_materiales.cantidad) AS "anterioir"
                                                                            FROM detalles_pendiente_empaque_materiales
                                                                            WHERE detalles_pendiente_empaque_materiales.co_material = ?
                                                                                    AND id < ?',
                        [
                            $materiale->codigo_material,
                            $materiale->id_de_detalles
                        ]
                    );

                    $existencia_material_actual -= $anteriores[0]->anterioir;

                    $valor_exist_ma = $materiale->saldo - $anteriores[0]->anterioir;

                    DB::update('UPDATE detalles_pendiente_empaque_materiales
                                        SET restante = ?,
                                        existencia_material = ?
                                        WHERE id = ?', [
                        $existencia_material_actual,
                        $valor_exist_ma < 0 ? 0 : $valor_exist_ma,
                        $materiale->id_de_detalles
                    ]);
                }
            }

            return redirect()->route('pendiente_empaque');
        } catch (Exception $e) {
            return  $e->getMessage();
        }
    }


    public function exportPendienteMateriales_pendiente_empaque(Request $request)
    {
        $pendiente = DB::select(
            'call buscar_pendiente_empaque(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
            :pa_items,:pa_orden_sist,:pa_ordenes,
            :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
            :pa_empaques,:pa_meses,:r_mill)',
            [
                'uno' =>  is_null($request->r_uno) ? '' : $request->r_uno,
                'dos' =>  is_null($request->r_dos) ? '' : $request->r_dos,
                'tres' =>  is_null($request->r_tres) ? '' : $request->r_tres,
                'cuatro' =>  is_null($request->r_cuatro) ? '' : $request->r_cuatro,
                'pres' =>  is_null($request->r_cinco) ? '' : $request->r_cinco,
                'seis' =>  is_null($request->r_seis) ? '' : $request->r_seis,
                'siete' =>  is_null($request->r_siete) ? '' : $request->r_siete,
                'paginacion' =>  -1,
                'pa_marcas' =>  is_null($request->busqueda_marcas_p) ? '' : $request->busqueda_marcas_p,
                'pa_nombre' =>  is_null($request->busqueda_nombre_p) ? '' : $request->busqueda_nombre_p,
                'pa_vitolas' => is_null($request->busqueda_vitolas_p) ? '' : $request->busqueda_vitolas_p,
                'pa_capas' =>  is_null($request->busqueda_capas_p) ? '' : $request->busqueda_capas_p,
                'pa_empaques' =>  is_null($request->busqueda_empaques_p) ? '' : $request->busqueda_empaques_p,
                'pa_meses' =>  is_null($request->busqueda_mes_p) ? '' : $request->busqueda_mes_p,
                'pa_items' =>  is_null($request->busqueda_items_p) ? '' : $request->busqueda_items_p,
                'pa_orden_sist' =>  is_null($request->busqueda_ordenes_p) ? '' : $request->busqueda_ordenes_p,
                'pa_ordenes' =>  is_null($request->busqueda_hons_p) ? '' : $request->busqueda_hons_p,
                'r_mill' =>  is_null($request->r_mill) ? '' : $request->r_mill,
            ]
        );


        return Excel::download(new PendienteEmpaqueMaterialesExport($pendiente), 'PendienteMateriales.xlsx');
    }


    public function imprimir_materiales_pendiente_empaque(Request $request)
    {

        $mater_programacion = DB::select(
            'call exportar_materiales_pendiente_empaque(:pa_item,
                                                                                        :pa_orden,
                                                                                        :pa_orden_del_sitema,
                                                                                        :pa_mes)',
            [
                'pa_item' => is_null($request->busqueda_items_p) ? '' : $request->busqueda_items_p,
                'pa_orden' => is_null($request->busqueda_hons_p) ? '' : $request->busqueda_items_p,
                'pa_orden_del_sitema' => is_null($request->busqueda_ordenes_p) ? '' : $request->busqueda_items_p,
                'pa_mes' => is_null($request->busqueda_mes_p) ? '' : $request->busqueda_items_p
            ]
        );

        $vista =  view('Exports.materiales-pnedientes-export', [
            'materiales' => $mater_programacion
        ]);

        return Excel::download(new MaterialesProgramacionExportView($vista, 'Materiales'), 'Materiales Pendiente (' . Carbon::now()->format('Y-m-d') . ').xlsx');
    }

    public function imprimir_materiales_pendiente_empaque_productos_cajas()
    {

        $datos_pendiente_empaque = DB::select(
            'call buscar_pendiente_empaque(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
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


        $puros = DB::select('CALL `pendiente_empaque_puros`()');
        $cajas =  DB::select('CALL `pendiente_empaque_cajas`()');

        $purosArray = [];
        $cajasArray2 = [];
        foreach ($puros as $key => $uso) {
            $purosArray[$uso->codigo_producto] =  $uso->total;
        }
        foreach ($cajas as $key => $value) {
            $cajasArray2[$value->codigo] =  $value->existencia;
        }

        $vista =  view('Exports.pendiente-empaque-export', [
            'datos_pendiente_empaque' => $datos_pendiente_empaque,
            'puros' => $purosArray,
            'cajas' => $cajasArray2
        ]);


        return Excel::download(new PendienteEmpaqueCuadradoExport($vista), 'Pendiente Empaque (' . Carbon::now()->format('Y-m-d') . ').xlsx');
    }
}
