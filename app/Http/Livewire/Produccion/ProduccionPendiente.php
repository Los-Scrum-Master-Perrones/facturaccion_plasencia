<?php

namespace App\Http\Livewire\Produccion;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class ProduccionPendiente extends Component
{
    use WithPagination;
    public $select_file;

    protected $paginationTheme = 'bootstrap';

    public $b_fechas = '';
    public $b_ordenes = '';
    public $b_presentacion = '';
    public $b_codigos = '';
    public $b_marcas = '';
    public $b_nombres = '';
    public $b_vitolas = '';
    public $b_capas = '';
    public $b_mes = '';
    public $tipo1 = "Puros Tripa Larga";
    public $tipo2 = "Puros Tripa Corta";
    public $tipo3 = "Puros Sandwich";
    public $tipo4 = "Puros Brocha";

    public $fechas = [];
    public $ordenes = [];
    public $presentacion = [];
    public $codigos = [];
    public $marcas = [];
    public $nombres = [];
    public $vitolas = [];
    public $capas = [];
    public $mes = [];

    public $por_pagina = 50;
    public $total = 0;

    public function mount() {

        $da = DB::select('CALL `buscar_produccion_pendiente_detalles`()');

        if (count($da) > 0) {

            $this->fechas = [];
            $this->mes = [];
            $this->ordenes = [];
            $this->presentacion = [];
            $this->codigos = [];
            $this->marcas = [];
            $this->nombres = [];
            $this->vitolas = [];
            $this->capas = [];

            foreach ($da as $detalles) {
                array_push($this->fechas, $detalles->fecha_recibido);
                array_push($this->mes, $detalles->mes);
                array_push($this->ordenes, $detalles->orden_sistema);
                array_push($this->presentacion, $detalles->presentacion);
                array_push($this->codigos, $detalles->codigo);
                array_push($this->marcas, $detalles->marca);
                array_push($this->nombres, $detalles->nombre);
                array_push($this->vitolas, $detalles->vitola);
                array_push($this->capas, $detalles->capa);
            }

            $this->fechas = array_unique($this->fechas);
            $this->mes = array_unique($this->mes);
            $this->ordenes = array_unique($this->ordenes);
            $this->presentacion = array_unique($this->presentacion);
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

        $var1 = $this->tipo1?$this->tipo1:'';
        $var2 = $this->tipo2?$this->tipo2:'';
        $var3 = $this->tipo3?$this->tipo3:'';
        $var4 = $this->tipo4?$this->tipo4:'';

        $da = DB::select(
            'CALL `buscar_produccion_pendiente`(?, ?, ?, ?, ?, ?, ?, ?, ?,?)',
            [
                $this->b_ordenes,
                $this->b_fechas,
                $this->b_codigos,
                $this->b_marcas,
                $this->b_nombres,
                $this->b_vitolas,
                $this->b_capas,
                $start,
                $this->por_pagina,
                $var1.$var2.$var3.$var4
            ]
        );

        // public $ = '';
        // public $ = '';
        // public $b_presentacion = '';
        // public $ = '';
        // public $ = '';
        // public $ = '';
        // public $ = '';
        // public $ = '';
        // public $b_mes = '';

        $this->total = DB::select(
            'CALL `buscar_produccion_pendiente_conteo`(?, ?, ?, ?, ?, ?, ?,?)',
            [
                $this->b_ordenes,
                $this->b_fechas,
                $this->b_codigos,
                $this->b_marcas,
                $this->b_nombres,
                $this->b_vitolas,
                $this->b_capas,
                $var1.$var2.$var3.$var4
            ]
        )[0]->total;



        return view('livewire.produccion.produccion-pendiente', [
            'pendiente' => new LengthAwarePaginator($da,  $this->total , $this->por_pagina)
        ])->extends('layouts.Main')->section('content');
    }
}
