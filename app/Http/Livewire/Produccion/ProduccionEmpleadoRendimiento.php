<?php

namespace App\Http\Livewire\Produccion;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProduccionEmpleadoRendimiento extends Component
{
    public $fechas;
    public $b_presentacion1 = 'Tripa Larga';
    public $b_presentacion2 = 'Tripa Corta';
    public $b_presentacion3 = 'Brocha';
    public $b_presentacion4 = 'Sandwich';

    public function mount(){
        $startOfWeek = \Carbon\Carbon::now()->startOfYear()->addWeeks(1 - 1);
        $endOfWeek = \Carbon\Carbon::now()->startOfYear()->addWeeks(1)->subDay();

        $this->fechas = $startOfWeek->format('Y-m-d').' '.$endOfWeek->format('Y-m-d');
    }

    public function render()
    {

        $fechas_separadas = explode(" ",$this->fechas);
        $produccion = DB::select('CALL `mostrar_produccion_estadistica_empleado`(?,?,?)',
                            [
                                $fechas_separadas[0],
                                $fechas_separadas[1],
                                $this->b_presentacion1 . $this->b_presentacion2 . $this->b_presentacion3.$this->b_presentacion4,
                            ]);

        return view('livewire.produccion.produccion-empleado-rendimiento',
            [
                'produccion' => $produccion
            ]
        )->extends('layouts.produccion.produccion-menu')->section('contenido');
    }
}
