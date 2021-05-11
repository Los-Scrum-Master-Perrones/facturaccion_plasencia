<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class FacturaTerminado extends Component
{
    public $titulo_factura;
    public $mes;
    public $titulo_mes;
    public $titulo_cliente;
    public $num_factura_sistema;
    public $cliente;
    public $numero_factura;
    public $contenedor;
    public $total_cantidad_bultos;
    public $total_total_puros;
    public $total_peso_bruto;
    public $total_peso_neto;
    public $fecha_factura;
    public $detalles_venta;

    public function render(){
        setlocale(LC_TIME, "spanish");
        $Nueva_Fecha = date("d-m-Y", strtotime($this->fecha_factura));	


        $this->titulo_mes = strftime("%B", strtotime($Nueva_Fecha));
        $this->titulo_cliente = $this->cliente;
        return view('livewire.factura-terminado')->extends('principal')->section('content');;
    }

    public function mount(){
        // $Nueva_Fecha = date("d-m-Y", strtotime(Carbon::now()));				

        // $this->mes = strftime("%B", strtotime($Nueva_Fecha));
        setlocale(LC_TIME, "spanish");
        
        $this->titulo_mes = strftime("%B", $this->mes);
        $this->titulo_cliente = "";
       $this->titulo_factura = "Factura";
       $this->num_factura_sistema = "FA-00-00000000";
       $this->contenedor = "";
       $this->total_cantidad_bultos = "";
       $this->total_total_puros = "";
       $this->total_peso_bruto = "";
       $this->total_peso_neto = "";
       
       $this->fecha_factura = Carbon::now()->format("Y-m-d");
    }
}
