<?php

namespace App\Http\Livewire;

use App\Exports\detallesExport;
use Livewire\Component;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendienteEmpaqueExport;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PendienteEmpaque extends Component
{

    public $datos_pendiente_empaque;
    public $nombre;
    public $tuplas;
    public $datos_pendiente_empaque_nuevo;


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

    public function cambio($num)
    {
        $this->ventanas = $num;
    }

    public function render()
    {
        //pendient empaque*****************************************************************
        $this->cargaPendiente();
        $this->cargaDetalleProgramacion();
        return view('livewire.pendiente-empaque')->extends('principal')->section('content');
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
            :pa_empaques,:pa_meses)',
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
                'pa_ordenes' =>  $this->busqueda_hons_p
            ]
        );


        $datos = [];
        $cantidad_detalle_sampler = 0;
        $detalles = 0;
        $valores = [];

        $tuplas = count($datos_pendiente_empaque);

        for ($i = 0; $i <  $tuplas; $i++) {

            $sampler = DB::select('SELECT clase_productos.sampler FROM clase_productos WHERE  clase_productos.item = ?;', [$datos_pendiente_empaque[$i]->item]);

            if (isset($sampler[0])) {
                if ($sampler[0]->sampler == "si") {
                    if ($cantidad_detalle_sampler == 0 && $detalles == 0) {
                        $datos = DB::select('call traer_numero_detalles_productos(?)', [$datos_pendiente_empaque[$i]->item]);
                        $cantidad_detalle_sampler = $datos[0]->tuplas;
                    }
                    $valores = DB::select('call traer_detalles_productos_actualizar(?,?)', [$datos_pendiente_empaque[$i]->item, $detalles]);

                    $datos_pendiente_empaque[$i]->cod_producto = isset($valores[0]->codigo_producto) ? $valores[0]->codigo_producto : "";

                    $detalles++;

                    if ($detalles == $cantidad_detalle_sampler) {
                        $detalles = 0;
                        $cantidad_detalle_sampler = 0;
                    }
                }
            } else {
                $valores = DB::select('SELECT codigo_producto FROM clase_productos WHERE item = ?', [$datos_pendiente_empaque[$i]->item]);

                $datos_pendiente_empaque[$i]->cod_producto = isset($valores[0]->codigo_producto) ? $valores[0]->codigo_producto : "";
            }
        }


        for ($i = 0; $tuplas > $i; $i++) {
            $detalles = DB::select(
                'call insertar_detalle_temporal(:numero_orden,:orden,:cod_producto,:saldo,:id_pendiente,:cant)',
                [
                    'numero_orden' => isset($datos_pendiente_empaque[$i]->orden_del_sitema) ?  $datos_pendiente_empaque[$i]->orden_del_sitema : null,
                    'orden' => isset($datos_pendiente_empaque[$i]->orden) ?  $datos_pendiente_empaque[$i]->orden : null,
                    'cod_producto' => isset($datos_pendiente_empaque[$i]->cod_producto) ?  $datos_pendiente_empaque[$i]->cod_producto : null,
                    'saldo' => isset($datos_pendiente_empaque[$i]->saldo) ?  $datos_pendiente_empaque[$i]->saldo : null,
                    'id_pendiente' => isset($datos_pendiente_empaque[$i]->id_pendiente) ?  $datos_pendiente_empaque[$i]->id_pendiente : null,
                    'cant' => isset($datos_pendiente_empaque[$i]->cant_cajas) ?  $datos_pendiente_empaque[$i]->cant_cajas : null
                ]
            );
        }

        $this->cambio(2);
    }

    public function insertar_detalle_provicional_sin_existencia($id)
    {

        $datos_pendiente = DB::select(
            'call datos_pendiente_programar(:id)',
            ['id' => $id]
        );

        $detalles = DB::select(
            'call insertar_detallePro_temporalSinExistencia(:numero_orden,:orden,:cod_producto,:saldo,:id_pendiente,:cant)',
            [
                'numero_orden' => isset($datos_pendiente[0]->orden_del_sitema) ? $datos_pendiente[0]->orden_del_sitema : null,
                'orden' => isset($datos_pendiente[0]->orden) ? $datos_pendiente[0]->orden : null,
                'cod_producto' => isset($datos_pendiente[0]->item) ? $datos_pendiente[0]->item : null,
                'saldo' => isset($datos_pendiente[0]->saldo) ? $datos_pendiente[0]->saldo : null,
                'id_pendiente' => isset($datos_pendiente[0]->id_pendiente) ? $datos_pendiente[0]->id_pendiente : null,
                'cant' => isset($datos_pendiente[0]->cant_cajas) ? $datos_pendiente[0]->cant_cajas : null
            ]
        );


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

        $pendiente_export = DB::select(
            'call buscar_pendiente_empaque_excel(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,
        :pa_items,:pa_orden_sist,:pa_ordenes,
        :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
        :pa_empaques,:pa_meses)',
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
                'pa_ordenes' =>  $this->busqueda_hons_p
            ]
        );

        return Excel::download(new PendienteEmpaqueExport($pendiente_export), 'Pendiente.xlsx');
    }

    public function cargaPendiente()
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
                :pa_empaques,:pa_meses)',
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
                    'pa_ordenes' =>  $this->busqueda_hons_p
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
        /*Procedimientos de busquedas de la tabla pendiente Empaque*/
        $this->marcas_p = DB::select(
            'call buscar_marca_empaque(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->nombre_p = \DB::select(
            'call buscar_nombre_empaque(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->vitolas_p = \DB::select(
            'call buscar_vitola_empaque(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->capas_p = \DB::select(
            'call buscar_capa_empaque(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->empaques_p = \DB::select(
            'call buscar_tipo_empaque_empaque(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );

        $this->mes_p = \DB::select(
            'call buscar_fecha_empaque(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->items_p = \DB::select(
            'call buscar_item_empaque(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->ordenes_p = \DB::select(
            'call buscar_ordenes_empaque(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->hons_p = \DB::select(
            'call buscar_hons_empaque(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->capas = DB::select('call buscar_capa("")');
        $this->nombres = DB::select('call buscar_nombre("")');
        $this->vitolas = DB::select('call buscar_vitola("")');
        $this->marcas = DB::select('call buscar_marca("")');
        $this->tipo_empaques = DB::select('call buscar_tipo_empaque("")');



        $this->tuplas_conteo = count(DB::select(
            'call buscar_pendiente_empaque(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
            :pa_items,:pa_orden_sist,:pa_ordenes,
            :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
            :pa_empaques,:pa_meses)',
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
                'pa_ordenes' =>  $this->busqueda_hons_p
            ]
        ));

        if ($this->todos == 1) {
            $this->datos_pendiente_empaque = DB::select(
                'call buscar_pendiente_empaque(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
                :pa_items,:pa_orden_sist,:pa_ordenes,
                :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
                :pa_empaques,:pa_meses)',
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
                    'pa_ordenes' =>  $this->busqueda_hons_p
                ]
            );
        } else {
            $this->datos_pendiente_empaque = DB::select(
                'call buscar_pendiente_empaque(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
                :pa_items,:pa_orden_sist,:pa_ordenes,
                :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
                :pa_empaques,:pa_meses)',
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
                    'pa_ordenes' =>  $this->busqueda_hons_p
                ]

            );
        }
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
        $this->id_detalle = 0;
    }




    public function cargaDetalleProgramacion()
    {
        $this->total_saldo = 0;
        $this->detalles_provicionales = DB::select('call mostrar_detalles_provicional(:buscar)', [
            'buscar' => $this->busqueda_programacion
        ]);

        for ($i = 0; $i < count($this->detalles_provicionales); $i++) {
            $this->total_saldo += $this->detalles_provicionales[$i]->saldo;
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
        $detalles_provicionales = DB::select('SELECT *
                                    FROM detalle_programacion_temporal,
                                        pendiente_empaque,
                                        clase_productos,
                                        lista_cajas
                                    WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente
                                            AND  lista_cajas.codigo = clase_productos.codigo_caja
                                            AND clase_productos.item = pendiente_empaque.item
                                            AND  id_detalle_programacion = :id', [
            'id' => $id
        ]);



        if (!is_null($detalles_provicionales[0]->codigo_caja)) {

            DB::update('UPDATE lista_cajas SET existencia = (existencia + ?)
                        WHERE id = ?', [$detalles_provicionales[0]->cant_cajas,
                                        $detalles_provicionales[0]->id]);

            $can_cajas_nueva = $saldo/(intval($detalles_provicionales[0]->saldo)/intval($detalles_provicionales[0]->cant_cajas));

        } else {

            $can_cajas_nueva = 0;
        }


        $this->actualizar = DB::select(
            'call actualizar_saldo_programacion(:id, :saldo,:cant,:id_pendiente,:codigo_caja)',
            [
                'id' => $id,
                'saldo' => $saldo,
                'cant' => $can_cajas_nueva,
                'id_pendiente' => $detalles_provicionales[0]->id_pendiente,
                'codigo_caja' => $detalles_provicionales[0]->codigo_caja
            ]
        );
    }

    public function insertarDetalle_y_actualizarPendiente()
    {

        $this->detalles_provicionales = DB::select('call mostrar_detalles_provicional("")');


        $this->insertar_programacion = DB::select(
            'call insertar_programacion(:fecha,:contenedor)',
            [
                'fecha' => $this->fecha,
                'contenedor' => $this->contenedor
            ]
        );

        $this->tuplas = count($this->detalles_provicionales);

        for ($i = 0; $this->tuplas > $i; $i++) {

            $cajas_totales_en_progrmacion = DB::select('CALL `01_programacion_provisional_cajas`(?)', [$this->detalles_provicionales[$i]->codigo_caja]);
            $existencia_cajas = DB::select('SELECT codigo,existencia FROM lista_cajas WHERE lista_cajas.codigo = ?', [$this->detalles_provicionales[$i]->codigo_caja]);

            $cajas_sobrantes = "";
            if (isset($cajas_totales_en_progrmacion[0]->total_cajas)) {
                if (isset($existencia_cajas[0]->existencia)) {

                    if ($existencia_cajas[0]->existencia > 0) {

                        $cajas_sobrantes =  'Sobran ' . ($existencia_cajas[0]->existencia - $cajas_totales_en_progrmacion[0]->total_cajas) . ' cajas';
                    } else {

                        $cajas_sobrantes =  'Faltan ' . ($existencia_cajas[0]->existencia - $cajas_totales_en_progrmacion[0]->total_cajas) . ' cajas</td>';
                    }
                } else {
                    $cajas_sobrantes =  'No existe';
                }
            } else {
                $cajas_sobrantes = 'N/A';
            }


            $this->actualizar_insertar = DB::select(
                'call insertar_detalle_programacion(:numero_orden, :orden,:cod_producto,:saldo,:id_pendiente,:caja,:cant)',
                [
                    'numero_orden' => isset($this->detalles_provicionales[$i]->numero_orden) ? $this->detalles_provicionales[$i]->numero_orden : null,
                    'orden' => isset($this->detalles_provicionales[$i]->orden) ? $this->detalles_provicionales[$i]->orden : null,
                    'cod_producto' => isset($this->detalles_provicionales[$i]->cod_producto) ? $this->detalles_provicionales[$i]->cod_producto : null,
                    'saldo' => isset($this->detalles_provicionales[$i]->saldo) ? $this->detalles_provicionales[$i]->saldo : null,
                    'id_pendiente' => isset($this->detalles_provicionales[$i]->id_pendiente) ? $this->detalles_provicionales[$i]->id_pendiente : null,
                    'caja' => isset($cajas_sobrantes) ? $cajas_sobrantes : null,
                    'cant' => isset($this->detalles_provicionales[$i]->cant_cajas) ? $this->detalles_provicionales[$i]->cant_cajas : null
                ]
            );
        }


        for ($i = 0; $this->tuplas > $i; $i++) {
            DB::update('update lista_cajas set existencia = existencia - ? where codigo = ?', [$this->detalles_provicionales[$i]->cant_cajas_necesarias, $this->detalles_provicionales[$i]->codigo_caja]);
        }


        DB::delete('delete from detalle_programacion_temporal');


        return redirect()->route('historial_programacion');
    }


    function exportProgramacion(Request $request)
    {
        return Excel::download(new detallesExport(), 'ProgramaciónPro.xlsx');
    }
}
