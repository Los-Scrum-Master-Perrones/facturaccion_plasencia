<?php

namespace App\Http\Livewire\Produccion;

use App\Imports\ProduccionMaterialesImport;
use App\Imports\ProducidoImport;
use App\Imports\ProducidoPendienteImport;
use App\Imports\ProducidoPreciosImport;
use App\Imports\ProducidoRehechosImport;
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
    public $b_presentacion = '';
    public $b_orden = '';
    public $b_codigo = '';
    public $b_marca = '';
    public $b_nombre = '';
    public $b_vitola = '';
    public $b_capa = '';
    public $b_color = '';

    public $fechas = [];
    public $presentacion = [];
    public $ordenes = [];
    public $codigos = [];
    public $marcas = [];
    public $nombres = [];
    public $vitolas = [];
    public $capas = [];
    public $colores = [];

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
            $this->colores = [];

            foreach ($da as $detalles) {
                array_push($this->fechas, $detalles->fecha);
                array_push($this->ordenes, $detalles->orden);
                array_push($this->codigos, $detalles->codigo);
                array_push($this->marcas, $detalles->marca);
                array_push($this->nombres, $detalles->nombre);
                array_push($this->vitolas, $detalles->vitola);
                array_push($this->capas, $detalles->capa);
                array_push($this->colores, $detalles->color);
            }

            $this->fechas = array_unique($this->fechas);
            $this->ordenes = array_unique($this->ordenes);
            $this->codigos = array_unique($this->codigos);
            $this->marcas = array_unique($this->marcas);
            $this->nombres = array_unique($this->nombres);
            $this->vitolas = array_unique($this->vitolas);
            $this->capas = array_unique($this->capas);
            $this->colores = array_unique($this->colores);
        }
    }

    public function render()
    {
        $start = ($this->page - 1) * $this->por_pagina;

        $da = DB::select(
            'CALL `buscar_inventario_produccion`(?,?,?,?,?,?,?,?,?,?,?,?)',
            [
                $this->b_fecha,
                $this->b_orden,
                $this->b_codigo,
                $this->b_marca,
                $this->b_nombre,
                $this->b_vitola,
                $this->b_capa,
                $start,
                $this->por_pagina,
                $this->b_fecha_inicial,
                $this->b_fecha_final,
                $this->b_color
            ]
        );

        $this->total = DB::select(
            'CALL `buscar_inventario_produccion_conteo`(?,?,?,?,?,?,?,?,?,?)',
            [
                $this->b_fecha,
                $this->b_orden,
                $this->b_codigo,
                $this->b_marca,
                $this->b_nombre,
                $this->b_vitola,
                $this->b_capa,
                $this->b_fecha_inicial,
                $this->b_fecha_final,
                $this->b_color
            ]
        )[0]->total;


        return view('livewire.produccion.produccion', [
            'productos' => new LengthAwarePaginator($da,  $this->total , $this->por_pagina)
        ])->extends('layouts.produccion.produccion-menu')->section('contenido');
    }

    public function import()
    {
        $this->validate([
            'select_file' => 'max:1024', // 1MB Max
        ]);
        (new ProducidoImport)->import($this->select_file);
    }

    public function import2()
    {
        $this->validate([
            'select_file' => 'max:1024', // 1MB Max
        ]);

        (new ProducidoPreciosImport)->import($this->select_file);
    }
    
    public function import3()
    {
        $this->validate([
            'select_file' => 'max:1024', // 1MB Max
        ]);

        (new ProducidoRehechosImport)->import($this->select_file);
    }


}
