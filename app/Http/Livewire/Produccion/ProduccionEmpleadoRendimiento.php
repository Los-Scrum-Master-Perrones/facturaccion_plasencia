<?php

namespace App\Http\Livewire\Produccion;

use App\Models\ProduccionDiarioProducirGuardados;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProduccionEmpleadoRendimiento extends Component
{
    public $fechas;
    public $tarea_promedio;
    public $b_presentacion1 = 'Tripa Larga';
    public $b_presentacion2 = 'Tripa Corta';
    public $b_presentacion3 = '';
    public $b_presentacion4 = 'Sandwich';

    public function mount(){
        $date = CarbonImmutable::now()->locale('es_HN');

        $startOfWeek = $date->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $date->endOfWeek(Carbon::SUNDAY);
        $this->fechas = $startOfWeek->format('Y-m-d').' '.$endOfWeek->format('Y-m-d');

        if(Cache::get('tareaGlobal')){
            $this->tarea_promedio = Cache::get('tareaGlobal');
        }else{
            Cache::put('tareaGlobal',400);
            $this->tarea_promedio = 400;
        }


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
        $planificado_semana = DB::select('CALL `buscar_produccion_reporte_semanal`(?,?)',
                            [
                                $fechas_separadas[0],
                                $fechas_separadas[1],
                            ]);

        return view('livewire.produccion.produccion-empleado-rendimiento',
            [
                'produccion' => $produccion,
                'planificado_semana' => $planificado_semana
            ]
        )->extends('layouts.produccion.produccion-menu')->section('contenido');
    }


    public function cambiar_tareas(){
        Cache::put('tareaGlobal',$this->tarea_promedio);
    }

    public function elimnar_guardado(){
        $fechas_separadas = explode(" ",$this->fechas);

        ProduccionDiarioProducirGuardados::where('inicio_semana',$fechas_separadas[0])->where('fin_semana',$fechas_separadas[1])->delete();
    }
}
