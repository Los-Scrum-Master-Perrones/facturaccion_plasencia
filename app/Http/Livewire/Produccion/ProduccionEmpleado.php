<?php

namespace App\Http\Livewire\Produccion;

use App\Exports\ProduccionEmpleadoExport;
use App\Exports\ProduccionEmpleadoPlanillaExport;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ProduccionEmpleado extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $b_orden = '';
    public $b_fecha_1 = '';
    public $b_fecha_2 = '';
    public $b_marca = '';
    public $b_nombre = '';
    public $b_vitola = '';
    public $b_capa = '';
    public $b_codigo_productos = '';
    public $b_codigo_empleado = '';
    public $b_nombre_empleado = '';
    public $b_rol = 'boncherorolero';
    public $b_presentacion1 = 'Tripa Larga';
    public $b_presentacion2 = 'Tripa Corta';
    public $b_presentacion3 = 'Brocha';

    public $ordenes = [];
    public $marcas = [];
    public $nombres = [];
    public $vitolas = [];
    public $capas = [];
    public $codigos_producto = [];
    public $codigos_empleado = [];
    public $nombres_empleado = [];
    public $presentacions = [];

    public $por_pagina = 50;
    public $total = 0;

    public function mount() {

        $this->b_fecha_1 = Carbon::now()->format('Y-m-d');
        $this->b_fecha_2 = Carbon::now()->format('Y-m-d');

        $da = DB::select('CALL `buscar_produccion_empleado_detalles`()');

        if (count($da) > 0) {
            $this->ordenes = [];
            $this->marcas = [];
            $this->nombres = [];
            $this->vitolas = [];
            $this->capas = [];
            $this->codigos_producto = [];
            $this->codigos_empleado = [];
            $this->nombres_empleado = [];
            $this->presentacions = [];

            foreach ($da as $detalles) {
                array_push($this->ordenes, $detalles->orden);
                array_push($this->marcas, $detalles->marca);
                array_push($this->nombres, $detalles->orden);
                array_push($this->vitolas, $detalles->nombre);
                array_push($this->capas, $detalles->capa);
                array_push($this->codigos_producto, $detalles->codigo_producto);
                array_push($this->codigos_empleado, $detalles->codigo_empleaado);
                array_push($this->nombres_empleado, $detalles->nombre_empleado);
                array_push($this->presentacions, $detalles->presentacion);
            }
            $this->ordenes = array_unique($this->ordenes);
            $this->marcas = array_unique($this->marcas);
            $this->nombres = array_unique($this->nombres);
            $this->vitolas = array_unique($this->vitolas);
            $this->capas = array_unique($this->capas);
            $this->codigos_producto = array_unique($this->codigos_producto);
            $this->codigos_empleado = array_unique($this->codigos_empleado);
            $this->nombres_empleado = array_unique($this->nombres_empleado);
            $this->presentacions = array_unique($this->presentacions);
        }
    }
    public function render()
    {
        $start = ($this->page - 1) * $this->por_pagina;

        $da = DB::select(
            'CALL `buscar_produccion_empleado`(?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
            [
                $this->b_fecha_1,
                $this->b_fecha_2,
                $this->b_orden,
                $this->b_marca,
                $this->b_nombre,
                $this->b_vitola,
                $this->b_capa,
                $this->b_codigo_productos,
                $this->b_codigo_empleado,
                $this->b_rol,
                $start,
                $this->por_pagina,
                $this->b_nombre_empleado,
                $this->b_presentacion1 . $this->b_presentacion2 . $this->b_presentacion3
            ]
        );

        $this->total = DB::select(
            'CALL `buscar_produccion_empleado_conteo`(?,?,?,?,?,?,?,?,?,?,?,?)',
            [
                $this->b_fecha_1,
                $this->b_fecha_2,
                $this->b_orden,
                $this->b_marca,
                $this->b_nombre,
                $this->b_vitola,
                $this->b_capa,
                $this->b_codigo_productos,
                $this->b_codigo_empleado,
                $this->b_rol,
                $this->b_nombre_empleado,
                $this->b_presentacion1 . $this->b_presentacion2 . $this->b_presentacion3
            ]
        )[0]->total;

        return view('livewire.produccion.produccion-empleado',[
            'productos' => new LengthAwarePaginator($da,  $this->total , $this->por_pagina)
        ])->extends('layouts.produccion.produccion-menu')->section('contenido');
    }

    public function imprimir_reporte(){
        $start = ($this->page - 1) * $this->por_pagina;
        $da = DB::select(
            'CALL `buscar_produccion_empleado`(?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
            [
                $this->b_fecha_1,
                $this->b_fecha_2,
                $this->b_orden,
                $this->b_marca,
                $this->b_nombre,
                $this->b_vitola,
                $this->b_capa,
                $this->b_codigo_productos,
                $this->b_codigo_empleado,
                $this->b_rol,
                $start,
                $this->por_pagina,
                $this->b_nombre_empleado,
                $this->b_presentacion1 . $this->b_presentacion2 . $this->b_presentacion3
            ]
        );

        return Excel::download(new ProduccionEmpleadoExport(collect($da)), 'Empleados.xlsx');

    }

    public function imprimir_reporte_planilla(){

        $dia_semana_lunes = date('N', strtotime($this->b_fecha_1));

        $dia_semana_domingo = date('N', strtotime($this->b_fecha_2));

        if ($dia_semana_lunes == 1 && ($dia_semana_domingo == 7 || $dia_semana_domingo == 6)) {

            $da = DB::select(
                'CALL `buscar_produccion_empleado_planilla`(?,?,?,?)',
                [
                    $this->b_fecha_1,
                    $this->b_fecha_2,
                    $this->b_presentacion1 . $this->b_presentacion2 . $this->b_presentacion3,
                    $this->b_rol
                ]
            );

            $rangoFecha = Carbon::parse($this->b_fecha_1)->format('d').' al '.$this->b_fecha_2;

            $rangoFecha2 = $this->b_fecha_1.' al '.$this->b_fecha_2;

            $titulo = '';

            if ($this->b_presentacion1) {
                $titulo .= "Tripa Larga";
            }
            if ($this->b_presentacion2 ) {
                if (!empty($titulo)) {
                    $titulo .= ", ";
                }
                $titulo .= "Tripa Corta";
            }
            if ($this->b_presentacion3) {
                if (!empty($titulo)) {
                    $titulo .= ", ";
                }
                $titulo .= "Brocha";
            }



            return Excel::download(new ProduccionEmpleadoPlanillaExport($da,$rangoFecha2, $titulo), 'Planilla de '.$titulo.' del '.$rangoFecha.'.xlsx');

        }else{
            $this->dispatchBrowserEvent('error_general',['errorr' => 'Rango de Fechas incorrectos','icon' => 'error']);
        }
    }
}
