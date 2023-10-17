<?php

namespace App\Http\Livewire\Produccion;

use App\Models\ProduccionPendienteSalida as ModelsProduccionPendienteSalida;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ProduccionPendienteSalida extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $b_fecha = '';
    public $b_destino = '';
    public $b_orden = '';
    public $b_codigo = '';
    public $b_marca = '';
    public $b_nombre = '';
    public $b_vitola = '';
    public $b_capa = '';

    public $destino = [];
    public $fechas = [];
    public $ordenes = [];
    public $codigos = [];
    public $marcas = [];
    public $nombres = [];
    public $vitolas = [];
    public $capas = [];

    public $por_pagina = 50;
    public $total = 0;

    public function mount() {

        $da = DB::select('CALL `buscar_produccion_salida_detalles`()');

        if (count($da) > 0) {
            $this->fechas = [];
            $this->ordenes = [];
            $this->codigos = [];
            $this->marcas = [];
            $this->nombres = [];
            $this->vitolas = [];
            $this->capas = [];
            $this->destino = [];

            foreach ($da as $detalles) {
                array_push($this->destino, $detalles->destino);
                array_push($this->fechas, $detalles->fecha_salida);
                array_push($this->ordenes, $detalles->orden_sistema);
                array_push($this->codigos, $detalles->codigo);
                array_push($this->marcas, $detalles->marca);
                array_push($this->nombres, $detalles->nombre);
                array_push($this->vitolas, $detalles->vitola);
                array_push($this->capas, $detalles->capa);
            }

            $this->destino = array_unique($this->destino);
            $this->fechas = array_unique($this->fechas);
            $this->ordenes = array_unique($this->ordenes);
            $this->codigos = array_unique($this->codigos);
            $this->marcas = array_unique($this->marcas);
            $this->nombres = array_unique($this->nombres);
            $this->vitolas = array_unique($this->vitolas);
            $this->capas = array_unique($this->capas);
        }
    }
    public function render()
    {
        $start = ($this->page - 1) * $this->por_pagina;

        $da = DB::select(
            'CALL `buscar_produccion_salida`(?,?,?,?,?,?,?,?,?,?)',
            [
                $this->b_destino,
                $this->b_fecha,
                $this->b_orden,
                $this->b_marca,
                $this->b_nombre,
                $this->b_vitola,
                $this->b_capa,
                $this->b_codigo,
                $start,
                $this->por_pagina
            ]
        );

        $this->total = DB::select(
            'CALL `buscar_produccion_salida_conteo`(?,?,?,?,?,?,?,?)',
            [
                $this->b_destino,
                $this->b_fecha,
                $this->b_orden,
                $this->b_marca,
                $this->b_nombre,
                $this->b_vitola,
                $this->b_capa,
                $this->b_codigo,
            ]
        )[0]->total;

        return view('livewire.produccion.produccion-pendiente-salida',[
            'productos' => new LengthAwarePaginator($da,  $this->total , $this->por_pagina)
        ])->extends('layouts.produccion.produccion-menu')->section('contenido');
    }

    public function eliminar_salida(ModelsProduccionPendienteSalida $salida) {
        $salida->delete();

        $this->dispatchBrowserEvent('salida_eliminada');
    }

}
