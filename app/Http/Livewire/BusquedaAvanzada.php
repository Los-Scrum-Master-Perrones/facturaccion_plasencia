<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class BusquedaAvanzada extends Component
{
    public $productos;
    public $fecha;
    public $marca;
    public $nombre;
    public $capasss;
    public $num_fac;
    public $contenedor;

    public $marcas_p;
    public $nombre_p;
    public $capa_p;

    public function render()
    {
        $this->marcas_p = \DB::select("call reporte_marcas()");
        $this->nombre_p = \DB::select("call reporte_nombres()");
        $this->capa_p = \DB::select("call reporte_capas()");


        if($this->marca == null){
            $this->marca="";
        }
        if($this->nombre == null){
            $this->nombre="";
        }
        if($this->capasss == null){
            $this->capasss="";
        }



        $this->productos = \DB::select("call reporte_facura_pendiente(:fecha,:marca,:nombre,:capa,:factura)",[
            "fecha" => $this->fecha,
            "marca" => $this->marca,
            "nombre" => $this->nombre,
            "capa" => $this->capasss,
            "factura" => $this->num_fac
        ]);

        return view('livewire.busqueda-avanzada')->extends('principal')->section('content');
    }

    public function mount(){
        $this->productos = [];
        $this->marca = "";
        $this->nombre = "";
        $this->capa = "";
        $this->num_fac = "";
        $this->contenedor = "";
        $this->fecha = Carbon::now()->format("Y-m-d");
    }


}
