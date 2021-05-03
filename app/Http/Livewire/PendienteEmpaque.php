<?php

namespace App\Http\Livewire;

use Livewire\Component;



use Illuminate\Http\Request;
use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;
class PendienteEmpaque extends Component
{

    public $datos_pendiente_empaque;
    public $fechade;
    public $fechahasta;
    public $nombre;

    public function render()
    {
        

        $this->datos_pendiente_empaque = DB::select('call buscar_pendiente_empaque(:nombre,:fechade,:fechahasta)'
        ,['nombre'=>$this->nombre,
        'fechade'=>$this->fechade,
        'fechahasta'=>$this->fechahasta]);
    
        return view('livewire.pendiente-empaque')->extends('principal')->section('content');
    }

    public function mount(){

        $this->datos_pendiente_empaque = [];
        $this->fechade= "";
        $this->fechahasta= "";
        $this->nombre= "";
    }



}
