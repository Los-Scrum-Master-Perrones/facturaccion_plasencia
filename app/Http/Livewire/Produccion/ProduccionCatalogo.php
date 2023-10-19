<?php

namespace App\Http\Livewire\Produccion;

use App\Models\capa_producto;
use App\Models\marca_producto;
use App\Models\nombre_producto;
use App\Models\Produccion;
use App\Models\vitola_producto;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ProduccionCatalogo extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    //busqueda
    public $b_presentacion = '';
    public $b_codigo = '';
    public $b_marca = '';
    public $b_nombre = '';
    public $b_vitola = '';
    public $b_capa = '';
    public $b_color = '';

    //filtros tabla
    public $presentacion = [];
    public $codigos = [];
    public $marcas = [];
    public $nombres = [];
    public $vitolas = [];
    public $capas = [];
    public $colores = [];

    public $capas_select = [];
    public $marcas_select = [];
    public $nombres_select = [];
    public $vitolas_select = [];

    public $color_n = '';

    //nuevo
    public Produccion $produc;

    public $rules = [
        'produc.codigo' => 'string|required',
        'produc.presentacion' => 'string|required',
        'produc.id_marca' => 'integer|required',
        'produc.id_nombre' => 'integer|required',
        'produc.id_vitola' => 'integer|required',
        'produc.id_capa' => 'integer|required',
        'produc.precio_bonchero' => 'numeric|required',
        'produc.precio_rolero' => 'numeric|required',
        'produc.existencia' => 'integer',
    ];

    public $por_pagina = 50;
    public $total = 0;

    public function mount() {

        $this->produc = new Produccion([
            `codigo` =>  'P-',
            `presentacion` =>  'Puros Tripa Larga',
            `id_marca` =>  0,
            `id_nombre` =>  0,
            `id_vitola` =>  0,
            `id_capa` =>  0,
            `precio_bonchero` =>  0,
            `precio_rolero` =>  0,
            `existencia` =>  0,
        ]);

        $da = DB::select('CALL `buscar_produccion_catalogo_detalles`()');

        if (count($da) > 0) {
            $this->presentacion = [];
            $this->codigos = [];
            $this->marcas = [];
            $this->nombres = [];
            $this->vitolas = [];
            $this->capas = [];
            $this->colores = [];

            foreach ($da as $detalles) {
                array_push($this->presentacion, $detalles->presentacion);
                array_push($this->codigos, $detalles->codigo);
                array_push($this->marcas, $detalles->marca);
                array_push($this->nombres, $detalles->nombre);
                array_push($this->vitolas, $detalles->vitola);
                array_push($this->capas, $detalles->capa);
                array_push($this->colores, $detalles->color);
            }

            $this->presentacion = array_unique($this->presentacion);
            $this->codigos = array_unique($this->codigos);
            $this->marcas = array_unique($this->marcas);
            $this->nombres = array_unique($this->nombres);
            $this->vitolas = array_unique($this->vitolas);
            $this->capas = array_unique($this->capas);
            $this->colores = array_unique($this->colores);
        }


        $this->capas_select = capa_producto::all();
        $this->marcas_select = marca_producto::all();
        $this->nombres_select = nombre_producto::all();
        $this->vitolas_select = vitola_producto::all();
    }

    public function render()
    {
        $start = ($this->page - 1) * $this->por_pagina;

        $da = DB::select(
            'CALL `buscar_produccion_catalogo`(?,?,?,?,?,?,?,?,?)',
            [
                $this->b_presentacion,
                $this->b_codigo,
                $this->b_marca,
                $this->b_nombre,
                $this->b_vitola,
                $this->b_capa,
                $start,
                $this->por_pagina,
                $this->b_color,
            ]
        );

        $this->total = DB::select(
            'CALL `buscar_produccion_catalogo_conteo`(?,?,?,?,?,?,?)',
            [
                $this->b_presentacion,
                $this->b_codigo,
                $this->b_marca,
                $this->b_nombre,
                $this->b_vitola,
                $this->b_capa,
                $this->b_color,
            ]
        )[0]->total;

        return view('livewire.produccion.produccion-catalogo', [
            'productos' => new LengthAwarePaginator($da,  $this->total , $this->por_pagina)
        ])->extends('layouts.produccion.produccion-menu')->section('contenido');
    }

    public function eliminar_salida(Produccion $salida) {

        try {
            DB::beginTransaction();

            $salida->delete();

            $this->dispatchBrowserEvent('error_general',['errorr' => 'Registro eliminado con exito','icon' => 'success']);

            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general',['errorr' => $th->getMessage(),'icon' => 'error']);
            DB::rollBack();
        }

    }

    public function registra_producto() {

        try {
            DB::beginTransaction();



            $this->produc->save();

            $marca = marca_producto::find($this->produc->id_marca);
            $marca->color = $this->color_n;

            $marca->save();

            $this->produc = new Produccion([
                `codigo` =>  'P-',
                `presentacion` =>  'Puros Tripa Larga',
                `id_marca` =>  0,
                `id_nombre` =>  0,
                `id_vitola` =>  0,
                `id_capa` =>  0,
                `precio_bonchero` =>  0,
                `precio_rolero` =>  0,
                `existencia` =>  0,
            ]);

            $this->dispatchBrowserEvent('error_general',['errorr' => 'Registro creado con exito','icon' => 'success']);

            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general',['errorr' => $th->getMessage(),'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function editar_producto(Produccion $edit) {

        try {
            DB::beginTransaction();

            $this->color_n = marca_producto::find($edit->id_marca)->color;
            $this->produc = $edit;

            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general',['errorr' => $th->getMessage(),'icon' => 'error']);
            DB::rollBack();
        }
    }

}
