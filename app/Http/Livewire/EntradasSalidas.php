<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EntradasSalidas extends Component
{
    public $materiales = [];
    //busquedas
    public $items_factorys = [];
    public $items_codigo_materials = [];
    public $items_descripcions = [];
    public $items_tipos = [];
    public $items_fechas = [];

    public $items_factory = "";
    public $items_codigo_material = "";
    public $items_descripcion = "";
    public $items_tipo = "";
    public $items_fecha = "";

    public $tuplas_conteo;
    public $todos;
    public $paginacion;
    public $cajas = 1;

    public function cambio_caja($var)
    {
        $this->cajas =$var;
    }

    public function render()
    {

        $da = DB::select(
            'CALL `mostrar_entradas_salidas`(?, ?, ?, ?, ?,-1,?)',
            [
                $this->items_descripcion,
                $this->items_codigo_material,
                $this->items_tipo,
                $this->items_factory,
                $this->items_fecha,
                $this->cajas
            ]
        );

        $this->tuplas_conteo = count($da);


        if ($this->todos == 1) {
            $this->materiales = DB::select(
                'CALL `mostrar_entradas_salidas`(?, ?, ?, ?, ?,-1, ?)',
            [
                $this->items_descripcion,
                $this->items_codigo_material,
                $this->items_tipo,
                $this->items_factory,
                $this->items_fecha,
                $this->cajas
            ]
            );
        } else {
            $this->materiales = DB::select(
                'CALL `mostrar_entradas_salidas`(?, ?, ?, ?, ?, ?, ?)',
                [
                    $this->items_descripcion,
                    $this->items_codigo_material,
                    $this->items_tipo,
                    $this->items_factory,
                    $this->items_fecha,
                    $this->paginacion,
                    $this->cajas
                ]
            );
        }

        if (count($da) > 0) {
            $this->items_factorys = [];
            $this->items_codigo_materials = [];
            $this->items_descripcions = [];
            $this->items_tipos = [];
            $this->items_fechas = [];

            foreach ($da as $detalles) {
                array_push($this->items_factorys, $detalles->factory_item);
                array_push($this->items_codigo_materials, $detalles->codigo_material);
                array_push($this->items_descripcions, $detalles->item_description);
                array_push($this->items_tipos, $detalles->tipo);
                array_push($this->items_fechas, $detalles->fecha);
            }

            $this->items_factorys = array_unique($this->items_factorys);
            $this->items_codigo_materials = array_unique($this->items_codigo_materials);
            $this->items_descripcions = array_unique($this->items_descripcions);
            $this->items_tipos = array_unique($this->items_tipos);
            $this->items_fechas = array_unique($this->items_fechas);
        }

        $this->dispatchBrowserEvent('tamanio_tabla');

        return view('livewire.EntradasSalidas.entradas-salidas')->extends('principal')->section('content');
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
