<?php

namespace App\Http\Livewire;
use DB;
use Livewire\Component;

use Illuminate\Http\Request;

class DetalleProgramacion extends Component
{

    
    public $detalles_provicionales;
    public $busqueda;
    public $borrar;
    public function render()
    {
        $this->detalles_provicionales= \DB::select('call mostrar_detalles_provicional(:buscar)',['buscar'=>$this->busqueda]);

        return view('livewire.detalle-programacion')->extends('principal')->section('content');
    }

    public function mount(){

    $this->detalles_provicionales=[];
    $this->borrar=[];
    $this->busqueda = "";

    }

    public function eliminar_detalles(Request $request){

        $this->detalles_provicionales=[];
    
        $this->borrar=\DB::select('call eliminar_detalles(:buscar)',['buscar'=>$request->id_usuarioE]);
        ;


        return redirect()->route('detalles_programacion'); 
    
        }
}
