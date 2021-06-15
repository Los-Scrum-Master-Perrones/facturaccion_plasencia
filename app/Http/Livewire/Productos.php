<?php

namespace App\Http\Controllers;

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;


class Productos extends Component
{


    public $productos;
    public $busqueda;
    public $detalle_productos;
    public $marcas;
    public $capas;
    public $nombres;
    public $vitolas;
    public $tipo_empaques;

    public $mars;
    public $ites;
    public $caps;
    public $nombrs;
    public $tips;
    public $presentacions;
    public $cod_sistemas;
    public $cod_precios;
    public $cod_cajas;
    public $cellos;
    public $anillos;
    public $upc;
    public $vitols;


    public function render()
    {

        $this->capas = \DB::select('call buscar_capa("")');
        $this->marcas = \DB::select('call buscar_marca("")');
        $this->nombres = \DB::select('call buscar_nombre("")');
        $this->vitolas = \DB::select('call buscar_vitola("")');
        $this->tipo_empaques = \DB::select('call buscar_tipo_empaque("")');

        $this->productos = \DB::select('call buscar_producto(:todo)', ['todo' => $this->busqueda]);

        $this->detalle_productos = \DB::select('call mostrar_detalles_productos');


        return view('livewire.productos')->extends('principal')->section('content');
    }

    public function mount()
    {

        $this->productos = [];
        $this->marcas = [];
        $this->cajas = [];
        $this->nombres = [];
        $this->vitolas = [];
        $this->tipo_empaques = [];
        $this->detalle_productos = [];
        $this->busqueda = "";

        $this->mars = "";
        $this->ites = "";
        $this->caps = "";
        $this->nombrs = "";
        $this->tips = "";
        $this->presentacions = "";
        $this->cod_sistemas = "";
        $this->cod_precios = "";
        $this->cod_cajas = "";
        $this->cellos = "";
        $this->vitols = "";
        $this->cellos = "";
        $this->anillos = "";
        $this->upc = "";

        $this->capas = \DB::select('call buscar_capa("")');
        $this->marcas = \DB::select('call buscar_marca("")');
        $this->nombres = \DB::select('call buscar_nombre("")');
        $this->vitolas = \DB::select('call buscar_vitola("")');
        $this->tipo_empaques = \DB::select('call buscar_tipo_empaque("")');
    }


    use WithPagination;
    public function insertar_clase(Request $request)
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


        $clase_producto = \DB::select(
            'call insertar_clase_producto(:item,:cod_producto,:cod_caja,:cod_precio,:precio,:capa,:vitola,:nombre,:marca,:cello,:anillo,:upc,:tipo,:presentacion)',
            [
                'item' => $request->item,
                'cod_producto' => $request->cod_sistema,
                'cod_caja' => $request->cod_caja,
                'cod_precio' => $request->cod_precio,
                'precio' => $request->precio,
                'capa' =>  $request->capa,
                'vitola' => $request->vitola,
                'nombre' => $request->nombre,
                'marca' => $request->marca,
                'cello' => $cello,
                'anillo' => $anillo,
                'upc' => $upc,
                'tipo' => $request->tipo,
                'presentacion' => $request->presentacion
            ]
        );

        $this->capas = \DB::select('call buscar_capa("")');
        $this->marcas = \DB::select('call buscar_marca("")');
        $this->nombres = \DB::select('call buscar_nombre("")');
        $this->vitolas = \DB::select('call buscar_vitola("")');
        $this->tipo_empaques = \DB::select('call buscar_tipo_empaque("")');

        return redirect()->route('productos');
    }



    public function actualizar_clase(Request $request)
    {



        if (isset($request->cello_ac)) {

            $cello = $request->cello_ac;
        } else {
            $cello = "no";
        }

        if (isset($request->anillo_ac)) {
            $anillo = $request->anillo_ac;
        } else {
            $anillo = "no";
        }

        if (isset($request->upc_ac)) {
            $upc = $request->upc_ac;
        } else {
            $upc = "no";
        }

        if (isset($request->sampler)) {
            $sam = $request->sampler;
        } else {
            $sam = "no";
        }


        $clase_producto = \DB::select(
            'call actualizar_productos(:id,:item,:cod_producto,:cod_caja,:cod_precio,:precio,
                :capa,:vitola,:nombre,:marca,:cello,:anillo,:upc,:tipo,:presentacion,:sampler,:des)',
            [
                'id' => $request->id_producto,
                'item' => $request->item_ac,
                'cod_producto' => $request->cod_sistema_ac,
                'cod_caja' => $request->cod_caja_ac,
                'cod_precio' => $request->cod_precio_ac,
                'precio' => $request->precio_ac,
                'capa' =>  $request->capa_ac,
                'vitola' => $request->vitola_ac,
                'nombre' => $request->nombre_ac,
                'marca' => $request->marca_ac,
                'cello' => $cello,
                'anillo' => $anillo,
                'upc' => $upc,
                'tipo' => $request->tipo_ac,
                'presentacion' => $request->presentacion_ac,
                'sampler' => $sam,
                'des' => $request->des,
            ]
        );
        $this->capas = \DB::select('call buscar_capa("")');
        $this->marcas = \DB::select('call buscar_marca("")');
        $this->nombres = \DB::select('call buscar_nombre("")');
        $this->vitolas = \DB::select('call buscar_vitola("")');
        $this->tipo_empaques = \DB::select('call buscar_tipo_empaque("")');
        $productos = \DB::select('call mostrar_productos');

        return redirect()->route('productos');
    }

    public function insertar_detalle_clase(Request $request)
    {



        if (isset($request->cello_de)) {

            $cello = $request->cello_de;
        } else {
            $cello = "no";
        }

        if (isset($request->anillo_de)) {
            $anillo = $request->anillo_de;
        } else {
            $anillo = "no";
        }

        if (isset($request->upc_de)) {
            $upc = $request->upc_de;
        } else {
            $upc = "no";
        }


        $detalle_clase_producto = \DB::select(
            'call insertar_detalle_clase_producto(:item,:capa,:vitola,:nombre,:marca,:cello,:anillo,:upc,:tipo,:precio)',
            [
                'item' => $request->item_de,
                'capa' =>  $request->capa_de,
                'vitola' => $request->vitola_de,
                'nombre' => $request->nombre_de,
                'marca' => $request->marca_de,
                'cello' => $cello,
                'anillo' => $anillo,
                'upc' => $upc,
                'tipo' => $request->tipo_de,
                'precio' => $request->precio_de
            ]
        );

        $this->capas = \DB::select('call buscar_capa("")');
        $this->marcas = \DB::select('call buscar_marca("")');
        $this->nombres = \DB::select('call buscar_nombre("")');
        $this->vitolas = \DB::select('call buscar_vitola("")');
        $this->tipo_empaques = \DB::select('call buscar_tipo_empaque("")');


        $productos = \DB::select('call mostrar_productos');
        $detalle_productos = \DB::select('call mostrar_detalles_productos');


        return redirect()->route('productos');
    }


    public function editar_productosssssss($numero_id)
    {

        $datos_editar = \DB::select(
            'call mostrar_datos_para_editar(:item)',
            ['item' => $numero_id]
        );

        $this->mars = $datos_editar[0]->marca;
        $this->ites = $datos_editar[0]->item;
        $this->caps = $datos_editar[0]->capa;
        $this->nombrs = $datos_editar[0]->nombre;
        $this->tips = $datos_editar[0]->tipo_empaque;
        $this->presentacions = $datos_editar[0]->presentacion;
        $this->cod_sistemas = $datos_editar[0]->codigo_producto;
        $this->cod_precios = $datos_editar[0]->codigo_precio;
        $this->cod_cajas = $datos_editar[0]->codigo_caja;
        $this->cellos = $datos_editar[0]->cello;
        $this->vitols = $datos_editar[0]->vitola;
        $this->anillos = $datos_editar[0]->anillo;
        $this->upc = $datos_editar[0]->upc;
    }


    public function detalle_productos_index(Request $request)
    {

        $producto_unico =  DB::select(
            'call mostrar_clase_paradetalle(:item)',
            ['item' => $request->item_detalle]
        );

        $productos = DB::select('call mostrar_productos');

        $detalle_productos = DB::select('call mostrar_detalles_productos');
        $this->capas = DB::select('call buscar_capa("")');
        $this->marcas = DB::select('call buscar_marca("")');
        $this->nombres = DB::select('call buscar_nombre("")');
        $this->vitolas = DB::select('call buscar_vitola("")');
        $this->tipo_empaques = DB::select('call buscar_tipo_empaque("")');

        return view('livewire.productos')->extends('principal')->section('content')->with('detalle_productos', $detalle_productos)->with('producto_unico', $producto_unico)->with('productos', $productos);
    }

    public function eliminar_detalle(Request $request){
        DB::delete('delete from detalle_clase_productos where id_producto = ?', [$request->id]);
        return redirect()->route('productos');
    }
}
