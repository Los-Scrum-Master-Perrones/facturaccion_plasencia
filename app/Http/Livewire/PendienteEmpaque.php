<?php

namespace App\Http\Livewire;

use Livewire\Component;



use Illuminate\Http\Request;
use Livewire\WithPagination;

use DB;
class PendienteEmpaque extends Component
{

    public $datos_pendiente_empaque;
    public $fechade;
    public $fechahasta;
    public $nombre;
    public $tuplas;

    public function render()
    {
        
        $this->datos_pendiente_empaque = DB::select('call buscar_pendiente_empaque(:nombre,:fechade,:fechahasta)'
        ,['nombre'=>$this->nombre,
        'fechade'=>$this->fechade,
        'fechahasta'=>$this->fechahasta]);
    

        $this->tuplas=count($this->datos_pendiente_empaque);
       
        return view('livewire.pendiente-empaque')->extends('principal')->section('content');
    }

    public function mount(){

        $this->datos_pendiente_empaque = DB::select('call buscar_pendiente_empaque(:nombre,:fechade,:fechahasta)'
        ,['nombre'=>$this->nombre,
        'fechade'=>$this->fechade,
        'fechahasta'=>$this->fechahasta]);
        
        $this->tuplas=count($this->datos_pendiente_empaque);

 
        $this->fechade= "";
        $this->fechahasta= "";
        $this->nombre= "";
    }

    public function insertar_detalle_provicional(){

        $this->datos_pendiente_empaque = DB::select('call buscar_pendiente_empaque(:nombre,:fechade,:fechahasta)'
        ,['nombre'=>$this->nombre,
        'fechade'=>$this->fechade,
        'fechahasta'=>$this->fechahasta]);
        
        $this->tuplas=count($this->datos_pendiente_empaque);

        for($i = 0 ; $this->tuplas > $i ; $i++){
            $detalles = DB::select('call insertar_detalle_temporal(:numero_orden,:orden,:cod_producto,:saldo,:id_pendiente)'
            ,['numero_orden'=>isset($this->datos_pendiente_empaque[$i]->orden_del_sitema)?$this->datos_pendiente_empaque[$i]->orden_del_sitema:null,
            'orden'=>isset($this->datos_pendiente_empaque[$i]->orden)?$this->datos_pendiente_empaque[$i]->orden:null,
            'cod_producto'=>isset($this->datos_pendiente_empaque[$i]->item)?$this->datos_pendiente_empaque[$i]->item:null,
            'saldo'=>isset($this->datos_pendiente_empaque[$i]->saldo)?$this->datos_pendiente_empaque[$i]->saldo:null,
            'id_pendiente'=>isset($this->datos_pendiente_empaque[$i]->id_pendiente)?$this->datos_pendiente_empaque[$i]->id_pendiente:null]);
        }

        return redirect()->route('detalles_programacion'); 
       
    }




}
