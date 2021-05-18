<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
    public $datos_pendiente;
    public $nom;
    public $cantidad_bultos;
    public $unidades_bultos;
    public $unidades_cajon;
    public $peso_bruto;
    public $peso_neto;

    public function render(){

        $id_factura = DB::select('call trae_factura_venta_actual()');
        $this->detalles_venta = DB::select('call mostrar_detalle_factura()');
        
        setlocale(LC_TIME, "spanish");
        $Nueva_Fecha = date("d-m-Y", strtotime($this->fecha_factura));

        $this->titulo_mes = strftime("%B", strtotime($Nueva_Fecha));
        $this->titulo_cliente = $this->cliente;

        $this->datos_pendiente = DB::select(
                'call buscar_pendiente(:nombre,"","")',
                [
                    'nombre' =>  $this->nom
                ]
            );

        return view('livewire.factura-terminado')->extends('principal')->section('content');
    }

    public function mount(){
        $id_factura = DB::select('call trae_factura_venta_actual()');
        $this->titulo_factura = "Factura";
        $this->num_factura_sistema = "FA-00-00000000";
        $this->nom = "";

        if(isset( $id_factura )){
            
        }else{
            setlocale(LC_TIME, "spanish");
        
            $this->titulo_mes = strftime("%B", $this->mes);
            $this->titulo_cliente = "";
          
            $this->contenedor = "";
            $this->total_cantidad_bultos = "";
            $this->total_total_puros = "";
            $this->total_peso_bruto = "";
            $this->total_peso_neto = "";
             
            $this->fecha_factura = Carbon::now()->format("Y-m-d");
            $factura = DB::select('call insertar_factura_terminado()');
        }
       
    }

    public function insertar_detalle_factura(){
        
    }
}
