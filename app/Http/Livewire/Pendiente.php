<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Exports\PendienteExport;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Http\Static_Vars_Pendiente;
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

    public function render()
    {
        $this->items_p = DB::select('call buscar_pendiente_item()');
        /*Procedimientos de busquedas de la tabla pendiente*/
        $this->marcas_p = \DB::select(
            'call buscar_marca_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->nombre_p = \DB::select(
            'call buscar_nombre_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->vitolas_p = \DB::select(
            'call buscar_vitola_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->capas_p = \DB::select(
            'call buscar_capa_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->empaques_p = \DB::select(
            'call buscar_tipo_empaque_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );


        $this->mes_p = \DB::select(
            'call buscar_fechas_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->items_p = \DB::select(
            'call buscar_item_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->ordenes_p = \DB::select(
            'call buscar_ordenes_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->hons_p = \DB::select(
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



        $this->tuplas_conteo = count(DB::select(
            'call buscar_pendiente(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
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
            $this->datos_pendiente = DB::select(
                'call buscar_pendiente(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
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
            $this->datos_pendiente = DB::select(
                'call buscar_pendiente(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
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


        $datos = [];
        $cantidad_detalle_sampler = 0;
        $detalles = 0;
        $valores = [];



        try {
            $datos = [];
            $cantidad_detalle_sampler = 0;
            $detalles = 0;
            $valores = [];

            $pendiente = DB::select('call buscar_pendiente("","","","","","","",0)');

            for ($i = 0; $i < count($pendiente); $i++) {

                $sampler = DB::select('SELECT clase_productos.sampler FROM clase_productos WHERE  clase_productos.item = ?;', [$pendiente[$i]->item]);

                if (isset($sampler[0])) {
                    if ($sampler[0]->sampler == "si") {

                        if ($cantidad_detalle_sampler == 0 && $detalles == 0) {
                            $datos = DB::select('call traer_numero_detalles_productos(?)', [$pendiente[$i]->item]);
                            $cantidad_detalle_sampler = $datos[0]->tuplas;
                        }

                        $valores = DB::select('call traer_detalles_productos_actualizar(?,?)', [$pendiente[$i]->item, $detalles]);

                        $actualizar = DB::select('call actualizar_pendiente_sampler(:marca,:nombre,:vitola,:capa,:tipo,:item,:codigo ,:precio)', [
                            'marca' => $valores[0]->marca,
                            'nombre' => $valores[0]->nombre,
                            'vitola' => $valores[0]->vitola,
                            'capa' => $valores[0]->capa,
                            'tipo' => $valores[0]->tipo_empaque,
                            'item' =>  $pendiente[$i]->id_pendiente,
                            'codigo' => $valores[0]->otra_descripcion,
                            'precio' => $valores[0]->precio,
                        ]);

                        $detalles++;

                        if ($detalles == $cantidad_detalle_sampler) {
                            $detalles = 0;
                            $cantidad_detalle_sampler = 0;
                        }
                    }
                }
            }
        } catch (Exception $e) {
        }
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

        $insertar_pendiente_empaque =   \DB::select(
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

        $this->datos_pendiente =  \DB::select('call mostrar_pendiente');

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
        :pa_empaques,:pa_meses)',
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
                'pa_ordenes' =>  $this->busqueda_hons_p
            ]
        );



        return Excel::download(new PendienteExport($pendiente_export), 'Pendiente.xlsx');
    }

    public function insertar_nuevo_pendiente($request)
    {

      DB::select(
            'call insertar_nuevo_pendiente(:categoria,:item,:orden,:observacion,:presentacion,:mes,:orden1,:marca,
        :vitola,:nombre,:capa,:tipo_empaque,:cello,:anillo,:upc,:pendiente,:saldo,:paquetes,:unidades,:cprecio,:precio)',
            [
                'categoria' => $request->categoria,
                'item' => $request->itemn,
                'orden' => $request->ordensis,
                'observacion' => $request->observacionn,
                'presentacion' => $request->presentacionn,
                'mes' => $request->fechan,
                'orden1' => $request->ordenn,
                'marca' => $request->marca,
                'vitola' => $request->vitola,
                'nombre' => $request->nombre,
                'capa' => $request->capa,
                'tipo_empaque' => $request->tipo,
                'cello' =>"",
                'anillo' =>"",
                'upc' => "",
                'pendiente' => $request->pendienten,
                'saldo' => $request->saldon,
                'paquetes' => $request->paquetes,
                'unidades' => $request->unidades,
                'cprecio' => $request->c_precion,
                'precio' => $request->precion
            ]
        );

    }

    public function agregar_productos()
    {
        $puro = DB::select('CALL `pendiente_producto_seleccion`(?)',[$this->codigo_item]);
        $this->capas_nuevo = $puro[0]->capa;
        $this->marcas_nuevo = $puro[0]->marca;
        $this->nombres_nuevo = $puro[0]->nombre;
        $this->vitolas_nuevo = $puro[0]->vitola;
        $this->tipo_empaques_nuevo = $puro[0]->tipo_empaque;
        $this->presentacion =  $puro[0]->presentacion;
        $this->codigo_precio_nuevo =  $puro[0]->codigo_precio;
        $this->precio_precio =  $puro[0]->precio;

    }
}
