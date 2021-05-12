<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HistorialProgramacion extends Component
{
    public $programaciones;
    public $detalles_programaciones;
    public function render()
    {
        $this->programaciones= \DB::select('call mostrar_programacion()');
        $this->detalles_programaciones=\DB::select('call mostrar_detalles_programacion(:buscar)',['buscar'=>""]);

        return view('livewire.historial-programacion')->extends('principal')->section('content');
    }

    public function mount()
    {
         $this->programaciones= [];
         $this->detalles_programaciones=[];
       
    }
   
}
