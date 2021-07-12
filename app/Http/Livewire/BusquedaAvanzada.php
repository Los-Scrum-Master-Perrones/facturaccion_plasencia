<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BusquedaAvanzada extends Component
{
    public $productos;
    public $fecha;
    public $marca;
    public $nombre;
    public $capasss;
    public $vitolasss;
    public $num_fac;
    public $tipo_empaque;
    public $orden;
    public $contenedor;

    public $marcas_p;
    public $nombre_p;
    public $capa_p;
    public $vitola_p;
    public $tipo_empaque_p;
    public $ordenes_p;

    public function render()
    {
        $this->marcas_p = DB::select('select marca from marca_productos');
        $this->nombre_p = DB::select('select nombre from nombre_productos');
        $this->capa_p = DB::select('select capa from capa_productos');
        $this->vitola_p = DB::select('select vitola from vitola_productos');
        $this->tipo_empaque_p = DB::select('select tipo_empaque from tipo_empaques');
        $this->ordenes_p = DB::select('select distinct orden from pendiente');

        if($this->marca == null){
            $this->marca="";
        }
        if($this->nombre == null){
            $this->nombre="";
        }
        if($this->capasss == null){
            $this->capasss="";
        }
        if($this->vitolasss == null){
            $this->vitolasss="";
        }
        if($this->tipo_empaque == null){
            $this->tipo_empaque="";
        }
        if($this->orden == null){
            $this->orden="";
        }
        $this->dispatchBrowserEvent('activarCombo');


        $this->productos = DB::select("call reporte_facura_pendiente(:fecha,:marca,:nombre,:capa,:vitola,:factura,:tipo_empaque,:orden)",[
            "fecha" => $this->fecha,
            "marca" => $this->marca,
            "nombre" => $this->nombre,
            "capa" => $this->capasss,
            "vitola" => $this->vitolasss,
            "factura" => $this->num_fac,
            "tipo_empaque" => $this->tipo_empaque,
            "orden" => $this->orden
        ]);

        return view('livewire.busqueda-avanzada')->extends('principal')->section('content');
    }

    public function mount(){

        $this->productos = [];
        $this->num_fac = "";
        $this->contenedor = "";
        $this->vitolasss = "";
        $this->marca = "";
        $this->nombre = "";
        $this->capasss = "";
        $this->tipo_empaque = "";
        $this->orden = "";
        $this->fecha = Carbon::now()->format("Y-m-d");
    }




}
