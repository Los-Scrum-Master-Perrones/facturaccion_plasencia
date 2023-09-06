<?php

namespace App\Http\Livewire;

use App\Exports\PendienteReporte;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BusquedaAvanzada extends Component
{
    public $productos;
    public $fecha_1;
    public $fecha_2;
    public $marca;
    public $nombre;
    public $capasss;
    public $vitolasss;
    public $num_fac;
    public $tipo_empaque;
    public $orden;
    public $orden_sistema;
    public $contenedor;

    public $marcas_p;
    public $nombre_p;
    public $capa_p;
    public $vitola_p;
    public $tipo_empaque_p;
    public $ordenes_p;
    public $ordenes_sis_p;

    public $r_cinco = "Puros Tripa Larga";
    public $r_seis = "Puros Tripa Corta";
    public $r_siete = "Puros Sandwich";
    public $r_mill = "Puros Brocha";

    public function render()
    {
        $this->marcas_p = DB::select('select marca from marca_productos');
        $this->nombre_p = DB::select('select nombre from nombre_productos');
        $this->capa_p = DB::select('select capa from capa_productos');
        $this->vitola_p = DB::select('select vitola from vitola_productos');
        $this->tipo_empaque_p = DB::select('select tipo_empaque from tipo_empaques');
        $this->ordenes_p = DB::select('select distinct orden from pendiente');
        $this->ordenes_sis_p = DB::select('select distinct orden_del_sitema from pendiente');

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

        if($this->orden_sistema == null){
            $this->orden_sistema="";
        }
        $this->dispatchBrowserEvent('activarCombo');


        $this->productos = DB::select("call reporte_facura_pendiente(:fecha,:fecha2,:marca,:nombre,:capa,:vitola,:factura,:tipo_empaque,:orden,:orden_sistema
        ,:pa_cinco,:pa_seis,:pa_siete,:pa_mill)",[
            "fecha" =>$this->fecha_1,
            "fecha2" =>$this->fecha_2,
            "marca" => $this->marca,
            "nombre" => $this->nombre,
            "capa" => $this->capasss,
            "vitola" => $this->vitolasss,
            "factura" => $this->num_fac,
            "tipo_empaque" => $this->tipo_empaque,
            "orden" => $this->orden,
            "orden_sistema" => $this->orden_sistema,
            "pa_cinco" => $this->r_cinco,
            "pa_seis" => $this->r_seis,
            "pa_siete" => $this->r_siete,
            "pa_mill" => $this->r_mill
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
        $this->orden_sistema = "";
        $this->fecha_1 = Carbon::now()->format("Y-m-d");
        $this->fecha_2 = Carbon::now()->format("Y-m-d");
    }

    public function exportar_reporte(){
        $this->productos = DB::select("call reporte_facura_pendiente(:fecha,:fecha2,:marca,:nombre,:capa,:vitola,:factura,:tipo_empaque,:orden,:orden_sistema
        ,:pa_cinco,:pa_seis,:pa_siete,:pa_mill)",[
            "fecha" =>$this->fecha_1,
            "fecha2" =>$this->fecha_2,
            "marca" => $this->marca,
            "nombre" => $this->nombre,
            "capa" => $this->capasss,
            "vitola" => $this->vitolasss,
            "factura" => $this->num_fac,
            "tipo_empaque" => $this->tipo_empaque,
            "orden" => $this->orden,
            "orden_sistema" => $this->orden_sistema,
            "pa_cinco" => $this->r_cinco,
            "pa_seis" => $this->r_seis,
            "pa_siete" => $this->r_siete,
            "pa_mill" => $this->r_mill
        ]);

        $vista =  view('Exports.pendiente_reporte', [
            'productos' =>  $this->productos
        ]);

        return Excel::download(new PendienteReporte($vista), 'ReportePendiente-'.Carbon::now()->format("Y-m-d").'.xlsx');
    }

}
