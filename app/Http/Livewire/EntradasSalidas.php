<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
class EntradasSalidas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //busquedas
    public $items_factorys = [];
    public $items_codigo_materials = [];
    public $items_descripcions = [];
    public $items_tipos = [];
    public $items_fechas = [];
    public $items_notas = [];


    public $items_factory = "";
    public $items_codigo_material = "";
    public $items_descripcion = "";
    public $items_tipo = "";
    public $items_fecha = "";
    public $todas_nota = "";


    public $tuplas_conteo;
    public $todos;
    public $paginacion;
    public $cajas = 1;

    public $por_pagina = 50;
    public $total = 0;

    public function cambio_caja($var)
    {
        $this->cajas =$var;
    }

    public function render()
    {
        $start = ($this->page - 1) * $this->por_pagina;

        $da = DB::select(
            'CALL `mostrar_entradas_salidas`(?,?,?,?,?,?,?,?,?)',
            [
                $this->items_descripcion,
                $this->items_codigo_material,
                $this->items_tipo,
                $this->items_factory,
                $this->items_fecha,
                $this->cajas,
                $this->todas_nota,
                $start,
                $this->por_pagina
            ]
        );

        $this->total = DB::select(
            'CALL `mostrar_entradas_salidas_conteo`(?,?,?,?,?,?,?)',
            [
                $this->items_descripcion,
                $this->items_codigo_material,
                $this->items_tipo,
                $this->items_factory,
                $this->items_fecha,
                $this->cajas,
                $this->todas_nota
            ]
        )[0]->total;



        if (count($da) > 0) {
            $this->items_factorys = [];
            $this->items_codigo_materials = [];
            $this->items_descripcions = [];
            $this->items_tipos = [];
            $this->items_fechas = [];
            $this->items_notas = [];


            foreach ($da as $detalles) {
                array_push($this->items_factorys, $detalles->factory_item);
                array_push($this->items_codigo_materials, $detalles->codigo_material);
                array_push($this->items_descripcions, $detalles->item_description);
                array_push($this->items_tipos, $detalles->tipo);
                array_push($this->items_fechas, $detalles->fecha);
                array_push($this->items_notas, $detalles->descripcion);
            }

            $this->items_factorys = array_unique($this->items_factorys);
            $this->items_codigo_materials = array_unique($this->items_codigo_materials);
            $this->items_descripcions = array_unique($this->items_descripcions);
            $this->items_tipos = array_unique($this->items_tipos);
            $this->items_fechas = array_unique($this->items_fechas);
            $this->items_notas = array_unique($this->items_notas);
        }

        $this->dispatchBrowserEvent('tamanio_tabla');

        return view('livewire.EntradasSalidas.entradas-salidas', [
            'materiales' => new LengthAwarePaginator($da,  $this->total , $this->por_pagina)
        ])->extends('layouts.Main')->section('content');
    }
    public function paginacion_numerica($numero)
    {
        $this->paginacion = $numero;
        $this->tama();
    }

    public function tama()
    {
        $this->dispatchBrowserEvent('tamanio_tabla');
    }

    public function mostrar_todo($todo)
    {
        $this->tama();
        $this->todos = $todo;
    }

}
