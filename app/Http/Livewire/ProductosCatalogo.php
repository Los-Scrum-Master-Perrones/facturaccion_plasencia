<?php

namespace App\Http\Controllers;

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class ProductosCatalogo extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $busqueda;
    public $detalle_productos;

    public $items = [];
    public $descripciones = [];

    public $item = "";
    public $descripcione = "";

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

    public $por_pagina = 25;
    public $total = 0;

    public function render()
    {
        $start = ($this->page - 1) * $this->por_pagina;

        $produ = DB::select('CALL `buscar_catalogo_productos`(?, ?, ?, ?, @salida)', [$this->item, $this->descripcione, $start, $this->por_pagina]);

        $this->total = DB::select('SELECT @salida AS longitud')[0]->longitud;

        $usos =  DB::select('call buscar_catalogo_productos_descripcion');
        $usosArray = [];
        foreach ($usos as $uso) {
            $usosArray[$uso->id_catalogo_producto][] = $uso;
        }
        foreach ($produ as $key => $value) {
            $value->usos = isset($usosArray[$value->id]) ? $usosArray[$value->id] : ['0'];
        }


        return view('livewire.productos-catalogo', [
            'productos' => new LengthAwarePaginator($produ, $this->total, $this->por_pagina)
        ])->extends('principal')->section('content');
    }

    public function cargar_select_busqueda($datos)
    {
        if (count($datos) > 0) {

            $this->items = [];
            $this->descripciones = [];

            foreach ($datos as $detalles) {
                array_push($this->items, $detalles->item);
                array_push($this->descripciones, $detalles->descripcion);
            }
            array_push($this->descripciones);


            $this->items = array_unique($this->items);
            $this->descripciones = array_unique($this->descripciones);
        }
    }

    public function mount()
    {
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

        $prodcutosPrecio =  DB::select('call buscar_catalogo_productos_detalles()');
        $this->cargar_select_busqueda($prodcutosPrecio);
    }


    /*public function insertar_clase(Request $request)
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



        $clase_producto = DB::select(
            'call insertar_clase_producto(:item,:cod_producto,:cod_caja,:cod_precio,:precio,:capa,:vitola,:nombre,:marca,:cello,:anillo,:upc,:tipo,:presentacion,:cantxbult)',
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
                'presentacion' => $request->presentacion,
                'cantxbult' => $request->cantxbult,
            ]
        );

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


        $clase_producto = DB::select(
            'call actualizar_productos(:id,:item,:cod_producto,:cod_caja,:cod_precio,:precio,
                :capa,:vitola,:nombre,:marca,:cello,:anillo,:upc,:tipo,:presentacion,:sampler,:des, :cantxbult)',
            [
                'id' => $request->id_producto,
                'item' => $request->item_ac,
                'cod_producto' => $request->cod_sistema_ac,
                'cod_caja' => $request->cod_caja_ac,
                'cod_precio' => $request->cod_precio_ac,
                'precio' => $request->precio,
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
                'cantxbult' => $request->cantxbult,
            ]
        );

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


        $detalle_clase_producto = DB::select(
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

        return redirect()->route('productos');
    }


    public function editar_productosssssss($numero_id)
    {

        $datos_editar = DB::select(
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

    public function mostrar_ocultar_columnas(){
        Cache::put('codigos_tabla_clase_productos',!$this->ocultos);
        $this->ocultos = Cache::get('codigos_tabla_clase_productos');
    }

    public function eliminar_item($id){
        DB::delete('delete from clase_productos where id_producto = ?', [$id]);
        $this->dispatchBrowserEvent('item_eliminar');
    }

    public function eliminar_detalle(Request $request){
        DB::delete('delete from detalle_clase_productos where id_producto = ?', [$request->id]);
        return redirect()->route('productos');
    }*/
}
