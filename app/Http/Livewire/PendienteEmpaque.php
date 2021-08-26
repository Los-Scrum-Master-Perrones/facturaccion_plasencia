<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Http\Static_Vars_PendienteEmpaque;
use App\Exports\PendienteEmpaqueExport;
use Illuminate\Support\Facades\DB;

class PendienteEmpaque extends Component
{

    public $datos_pendiente_empaque;
    public $nombre;
    public $tuplas;
    public $datos_pendiente_empaque_nuevo;

    // procedimientos para cargar select
    public $marcas;
    public $nombres;
    public $vitolas;
    public $capas;
    public $tipo_empaques;

    // variables del wire model
    public $r_uno = "1";
    public $r_dos = "2";
    public $r_tres = "3";
    public $r_cuatro = "4";
    public $r_cinco = "Puros Tripa Larga";
    public $r_seis = "Puros Tripa Corta";
    public $r_siete = "Puros Sandwich";

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


    public function render()
    {
        /*Procedimientos de busquedas de la tabla pendiente Empaque*/
        $this->marcas_p = \DB::select(
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

        $this->datos_pendiente_empaque = DB::select(
            'call buscar_pendiente_empaque(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro,
                'pres' =>  $this->r_cinco,
                'seis' =>  $this->r_seis,
                'siete' =>  $this->r_siete,
            ]
        );

        $this->capas = \DB::select('call buscar_capa("")');
        $this->nombres = \DB::select('call buscar_nombre("")');
        $this->vitolas = \DB::select('call buscar_vitola("")');
        $this->marcas = \DB::select('call buscar_marca("")');
        $this->tipo_empaques = \DB::select('call buscar_tipo_empaque("")');

        return view('livewire.pendiente-empaque')->extends('principal')->section('content');
    }

    public function mount()
    {

        $this->borrar = [];
        $this->actualizar = [];


        $datos = [];
        $cantidad_detalle_sampler = 0;
        $detalles = 0;
        $valores = [];

        $datos_empaque = DB::select('call `buscar_pendiente_empaque`("", "", "", "", "", "", "")');


        for ($i = 0; $i < count( $datos_empaque ); $i++) {

            $sampler = DB::select('SELECT clase_productos.sampler FROM clase_productos WHERE  clase_productos.item = ?;', [ $datos_empaque [$i]->item]);

            if (isset($sampler[0])) {
                if ($sampler[0]->sampler == "si") {
                    if ($cantidad_detalle_sampler == 0 && $detalles == 0) {
                        $datos = DB::select('call traer_numero_detalles_productos(?)', [ $datos_empaque [$i]->item]);
                        $cantidad_detalle_sampler = $datos[0]->tuplas;
                    }
                    $valores = DB::select('call traer_detalles_productos_actualizar(?,?)', [ $datos_empaque [$i]->item, $detalles]);

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



    }


    public function insertar_detalle_provicional(Request $request)
    {

        $funcion = $request->funcion;

        if ($request->checkbox1E == null) {
            $checkbox1E = "";
        } else {
            $checkbox1E = $request->checkbox1E;
        }
        if ($request->checkbox2E == null) {
            $checkbox2E = "";
        } else {
            $checkbox2E = $request->checkbox2E;
        }
        if ($request->checkbox3E == null) {
            $checkbox3E = "";
        } else {
            $checkbox3E = $request->checkbox3E;
        }
        if ($request->checkbox4E == null) {
            $checkbox4E = "";
        } else {
            $checkbox4E = $request->checkbox4E;
        }
        if ($request->checkbox5 == null) {
            $checkbox5 = "";
        } else {
            $checkbox5 = $request->checkbox5;
        }
        if ($request->checkbox6 == null) {
            $checkbox6 = "";
        } else {
            $checkbox6 = $request->checkbox6;
        }
        if ($request->checkbox7 == null) {
            $checkbox7 = "";
        } else {
            $checkbox7 = $request->checkbox7;
        }
        if ($request->b_itemE == null) {
            $b_itemE = "";
        } else {
            $b_itemE = $request->b_itemE;
        }
        if ($request->b_ordenE == null) {
            $b_ordenE = "";
        } else {
            $b_ordenE = $request->b_ordenE;
        }
        if ($request->b_honE == null) {
            $b_honE = "";
        } else {
            $b_honE = $request->b_honE;
        }
        if ($request->b_marcaE == null) {
            $b_marcaE = "";
        } else {
            $b_marcaE = $request->b_marcaE;
        }
        if ($request->b_vitolaE == null) {
            $b_vitolaE = "";
        } else {
            $b_vitolaE = $request->b_vitolaE;
        }
        if ($request->b_nombreE == null) {
            $b_nombreE = "";
        } else {
            $b_nombreE = $request->b_nombreE;
        }
        if ($request->b_capaE == null) {
            $b_capaE = "";
        } else {
            $b_capaE = $request->b_capaE;
        }
        if ($request->b_empaqueE == null) {
            $b_empaqueE = "";
        } else {
            $b_empaqueE = $request->b_empaqueE;
        }
        if ($request->b_mesE == null) {
            $b_mesE = "";
        } else {
            $b_mesE = $request->b_mesE;
        }

        if ($funcion == 1) {
            $datos_pendiente_empaque = DB::select(
                'call buscar_pendiente_empaque_excel(:v1,  :v2,  :v3,  :v4,  :v45,  :v46,  :v47,  :v5,  :v6,  :v7,  :v8,  :v9,  :v10,  :v11,  :v12,  :v13)',
                [
                    'v1' =>  $checkbox1E,
                    'v2' =>  $checkbox2E,
                    'v3' =>  $checkbox3E,
                    'v4' =>  $checkbox4E,

                    'v45' =>  $checkbox5,
                    'v46' =>  $checkbox6,
                    'v47' =>  $checkbox7,


                    'v5' =>  $b_itemE,
                    'v6' =>  $b_ordenE,
                    'v7' =>  $b_honE,
                    'v8' =>  $b_marcaE,

                    'v9' =>  $b_vitolaE,
                    'v10' =>  $b_nombreE,
                    'v11' =>  $b_capaE,
                    'v12' =>  $b_empaqueE,
                    'v13' =>  $b_mesE
                ]
            );

            $tuplas = count($datos_pendiente_empaque);

            for ($i = 0; $tuplas > $i; $i++) {
                $detalles = DB::select(
                    'call insertar_detalle_temporal(:numero_orden,:orden,:cod_producto,:saldo,:id_pendiente,:cant)',
                    [
                        'numero_orden' => isset($datos_pendiente_empaque[$i]->orden_del_sitema) ? $datos_pendiente_empaque[$i]->orden_del_sitema : null,
                        'orden' => isset($datos_pendiente_empaque[$i]->orden) ? $datos_pendiente_empaque[$i]->orden : null,
                        'cod_producto' => isset($datos_pendiente_empaque[$i]->item) ? $datos_pendiente_empaque[$i]->item : null,
                        'saldo' => isset($datos_pendiente_empaque[$i]->saldo) ? $datos_pendiente_empaque[$i]->saldo : null,
                        'id_pendiente' => isset($datos_pendiente_empaque[$i]->id_pendiente) ? $datos_pendiente_empaque[$i]->id_pendiente : null,
                        'cant' => isset($datos_pendiente_empaque[$i]->cant_cajas) ? $datos_pendiente_empaque[$i]->cant_cajas : null
                    ]
                );
            }

            return redirect()->route('detalles_programacion');

        } else if ($funcion == 2) {

            return redirect()->route('detalles_programacion');

        } else if ($funcion == 4) {

            Static_Vars_PendienteEmpaque::Sete_cat1s($request->checkbox1E);
            Static_Vars_PendienteEmpaque::Sete_cat2s($request->checkbox2E);
            Static_Vars_PendienteEmpaque::Sete_cat3s($request->checkbox3E);
            Static_Vars_PendienteEmpaque::Sete_cat4s($request->checkbox4E);

            Static_Vars_PendienteEmpaque::Sete_cat5s($request->checkbox5);
            Static_Vars_PendienteEmpaque::Sete_cat6s($request->checkbox6);
            Static_Vars_PendienteEmpaque::Sete_cat7s($request->checkbox7);

            Static_Vars_PendienteEmpaque::Sete_items($request->b_itemE);
            Static_Vars_PendienteEmpaque::Sete_ordenes($request->b_ordenE);
            Static_Vars_PendienteEmpaque::Sete_hons($request->b_honE);
            Static_Vars_PendienteEmpaque::Sete_marcas($request->b_marcaE);

            Static_Vars_PendienteEmpaque::Sete_vitolas($request->b_vitolaE);
            Static_Vars_PendienteEmpaque::Sete_nombres($request->b_nombreE);
            Static_Vars_PendienteEmpaque::Sete_capas($request->b_capaE);
            Static_Vars_PendienteEmpaque::Sete_empaques($request->b_empaqueE);
            Static_Vars_PendienteEmpaque::Sete_meses($request->b_mesE);

            return  Excel::download(new PendienteEmpaqueExport(), 'Pendiente Empaque.xlsx');
        }
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


        return redirect()->route('detalles_programacion');
    }

    public function actualizar_pendiente_empaque(Request $request)
    {

        if ($request->observacion  == null) {
            $observacions = " ";
        } else {
            $observacions = $request->observacion;
        }

        $this->actualizar = \DB::select(
            'call actualizar_pendiente_empaque(:id,:observacions,:pendiente,:saldo)',
            [
                'id' => $request->id_pendientea,
                'observacions' => $observacions,
                'pendiente' => $request->pendiente,
                'saldo' => $request->saldo
            ]
        );

        return redirect()->route('pendiente_empaque');
    }


    public function eliminar_pendiente(Request $request)
    {

        $this->datos_pendiente = [];
        $this->borrar = \DB::select('call borrar_pendiente_empaque(:eliminar)', ['eliminar' => $request->id_pendiente]);

        return redirect()->route('pendiente_empaque');
    }


    function insertar_nuevo_pendiente_empaque(Request $request)
    {
        if (isset($request->cello)) {

            $cello = $request->cello;
        } else {
            $cello = "no";
        }

        if (isset($request->anillo)) {
            $anillo = $request->anillo;
        } else {
            $anillo = "no";
        }

        if (isset($request->upc)) {
            $upc = $request->upc;
        } else {
            $upc = "no";
        }

        $insertar_nuevo_pendiente = \DB::select(
            'call insertar_nuevo_pendiente_empaque(:categoria,:item,:orden,:observacion,:presentacion,:mes,:orden1,:marca,
        :vitola,:nombre,:capa,:tipo_empaque,:cello,:anillo,:upc,:pendiente,:saldo,:paquetes,:unidades)',

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
                'cello' => $cello,
                'anillo' => $anillo,
                'upc' => $upc,

                'pendiente' => $request->pendienten,
                'saldo' => $request->saldon,
                'paquetes' => $request->paquetes,
                'unidades' => $request->unidades,
            ]
        );

        return redirect()->route('pendiente_empaque');
    }
}
