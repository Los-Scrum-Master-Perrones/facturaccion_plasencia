<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;
use App\Models\capa_producto;
use App\Models\marca_producto;
use App\Models\nombre_producto;
use App\Models\vitola_producto;
use App\Models\tipo_empaque;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class DatosProductos extends Component
{

    use WithPagination;
    public $hola;
    public $productos;
    public $capas;
    public $marcas;
    public $vitolas;
    public $nombres;
    public $tipos;
    public $busqueda;
    public $cc=1;


    public function render()
    {

        
        $this->capas= \DB::SELECT('call buscar_capa(:capa)',['capa'=>$this->busqueda]);
        $this->marcas= \DB::SELECT('call buscar_marca(:marca)',['marca'=>$this->busqueda]);
        $this->nombres= \DB::SELECT('call buscar_nombre(:nombre)',['nombre'=>$this->busqueda]);
        $this->vitolas= \DB::SELECT('call buscar_vitola(:vitola)',['vitola'=>$this->busqueda]);
        $this->tipos= \DB::SELECT('call buscar_tipo_empaque(:tipo)',['tipo'=>$this->busqueda]);
    
        
        return view('livewire.datos-productos', )->extends('principal')->section('content');
    }

    public function buscaras(){
        $this->cc++;
    }

    public function mount(){

        $this->productos = [];
        $this->marcas = [];
        $this->capas = [];
        $this->vitolas = [];
        $this->nombres = [];
        $this->tipos = [];
        $this->busqueda = ""; 

        $this->capas= capa_producto::all();
        $this->marcas= marca_producto::all();
        $this->nombres= nombre_producto::all();
        $this->vitolas= vitola_producto::all();
        $this->tipos= tipo_empaque::all();
    }


    public function insertar_marca(Request $request){

       $marcas_in=  \DB::SELECT('call insertar_marca(:marca)',['marca'=>$request->marcam]);
       
       $this->capas= \DB::SELECT('call buscar_capa(:capa)',['capa'=>$this->busqueda]);
       $this->marcas= \DB::SELECT('call buscar_marca(:marca)',['marca'=>$this->busqueda]);
       $this->nombres= \DB::SELECT('call buscar_nombre(:nombre)',['nombre'=>$this->busqueda]);
       $this->vitolas= \DB::SELECT('call buscar_vitola(:vitola)',['vitola'=>$this->busqueda]);
       $this->tipos= \DB::SELECT('call buscar_tipo_empaque(:tipo)',['tipo'=>$this->busqueda]);
   
       return redirect()->route('datos_producto');
    }
}
