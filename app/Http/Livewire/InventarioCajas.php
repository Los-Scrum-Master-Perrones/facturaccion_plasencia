<?php

namespace App\Http\Livewire;
use DB;

use Illuminate\Http\Request;
use Livewire\Component;

class InventarioCajas extends Component
{

    public $listacajas;
    public $busqueda;

    public function render()
    {
        $this->listacajas = \DB::select('call buscar_listadecajas(:nombre)',[
            'nombre'=>$this->busqueda
        ]);       

        return view('livewire.inventario-cajas')->extends('principal')->section('content');
    }

    public function mount(){

        $this->listacajas = [];
        $this->busqueda = "";
        $this->listacajas = \DB::table('call mostrar_cajas');   
       
    }
}


