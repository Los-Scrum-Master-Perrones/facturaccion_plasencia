<?php

namespace App\Http\Livewire\Produccion;

use App\Imports\ProducidoImport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithFileUploads;

class Produccion extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $select_file;

    protected $paginationTheme = 'bootstrap';

    public $b_fecha = '';
    public $b_orden = '';
    public $b_codigo = '';
    public $b_marca = '';
    public $b_nombre = '';
    public $b_vitola = '';
    public $b_capa = '';
    public $b_fecha_inicial = '';
    public $b_fecha_final = '';

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
        $this->b_fecha_inicial = Carbon::now()->format('Y-m-d');
        $this->b_fecha_final = Carbon::now()->format('Y-m-d');

        $da = DB::select('CALL `buscar_inventario_produccion_detalles`()');

        if (count($da) > 0) {
            $this->fechas = [];
            $this->ordenes = [];
            $this->codigos = [];
            $this->marcas = [];
            $this->nombres = [];
            $this->vitolas = [];
            $this->capas = [];

            foreach ($da as $detalles) {
                array_push($this->fechas, $detalles->fecha);
                array_push($this->ordenes, $detalles->orden);
                array_push($this->codigos, $detalles->codigo);
                array_push($this->marcas, $detalles->marca);
                array_push($this->nombres, $detalles->nombre);
                array_push($this->vitolas, $detalles->vitola);
                array_push($this->capas, $detalles->capa);
            }

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
            'CALL `buscar_inventario_produccion`(?,?,?,?,?,?,?,?,?)',
            [
                $this->b_codigo,
                $this->b_marca,
                $this->b_nombre,
                $this->b_vitola,
                $this->b_capa,
                $start,
                $this->por_pagina,
                $this->b_fecha_inicial,
                $this->b_fecha_final
            ]
        );

        $this->total = DB::select(
            'CALL `buscar_inventario_produccion_conteo`(?,?,?,?,?,?,?)',
            [
                $this->b_codigo,
                $this->b_marca,
                $this->b_nombre,
                $this->b_vitola,
                $this->b_capa,
                $this->b_fecha_inicial,
                $this->b_fecha_final
            ]
        )[0]->total;


        return view('livewire.produccion.produccion', [
            'productos' => new LengthAwarePaginator($da,  $this->total , $this->por_pagina)
        ])->extends('layouts.Main')->section('content');
    }

    public  function import()
    {
        $this->validate([
            'select_file' => 'max:1024', // 1MB Max
        ]);
        (new ProducidoImport)->import($this->select_file);
    }

}
