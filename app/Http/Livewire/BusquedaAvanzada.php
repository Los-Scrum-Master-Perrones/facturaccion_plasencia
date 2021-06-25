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
    public $vitolasss;
    public $num_fac;
    public $contenedor;

    public $marcas_p;
    public $nombre_p;
    public $capa_p;
    public $vitola_p;

    public $oculto_marca;
    public $oculto_nombre;
    public $oculto_capa;
    public $oculto_vitola;

    public $iluminadoIndice;
    public $iluminadoIndiceNombre;
    public $iluminadoIndiceCapa;
    public $iluminadoIndiceVitola;

    public function render()
    {
        $this->marcas_p = \DB::select("call reporte_marcas(?)",[$this->marca]);
        $this->nombre_p = \DB::select("call reporte_nombres(?)",[$this->nombre]);
        $this->capa_p = \DB::select("call reporte_capas(?)",[$this->capasss]);
        $this->vitola_p = \DB::select("call reporte_vitolas(?)",[$this->vitolasss]);


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

        $this->productos = \DB::select("call reporte_facura_pendiente(:fecha,:marca,:nombre,:capa,:vitola,:factura)",[
            "fecha" => $this->fecha,
            "marca" => $this->marca,
            "nombre" => $this->nombre,
            "capa" => $this->capasss,
            "vitola" => $this->vitolasss,
            "factura" => $this->num_fac
        ]);

        return view('livewire.busqueda-avanzada')->extends('principal')->section('content');
    }


    public function mount(){
        $this->oculto_marca = 0;
        $this->oculto_nombre = 0;
        $this->oculto_capa = 0;
        $this->oculto_vitola = 0;

        $this->iluminadoIndice = 0;
        $this->iluminadoIndiceNombre = 0;
        $this->iluminadoIndiceCapa = 0;
        $this->iluminadoIndiceVitola = 0;

        $this->productos = [];
        $this->reset_marca();
        $this->reset_nombre();
        $this->reset_capa();
        $this->num_fac = "";
        $this->contenedor = "";
        $this->fecha = Carbon::now()->format("Y-m-d");
    }


    //Busqueda de Marca

    public function reset_marca(){
        $this->marca = "";
        $this->oculto_marca = 0;
    }

    

    public function incrementaIluminadoMarca(){
        if($this->iluminadoIndice === count($this->marcas_p)-1){
            $this->iluminadoIndice = 0;
            return;
        }

        $this->iluminadoIndice++;
    }

    public function decrementarIluminadoMarca(){
        
        if($this->iluminadoIndice === 0){
            $this->iluminadoIndice = count($this->marcas_p)-1;
            return;
        }

        $this->iluminadoIndice--;
    }

    public function seleccionarMarca(){
        $mascc = $this->marcas_p[$this->iluminadoIndice] ?? null; 
           
        if( $mascc ){
            $this->marca =  $mascc['marca'];
            $this->oculto_marca = 1;
        }
        
        
    }


    //Busqueda de Nombre
    public function reset_nombre(){
        $this->nombre = "";
        $this->oculto_nombre = 0;
    }

    public function incrementaIluminadoNombre(){
        if($this->iluminadoIndiceNombre === count($this->nombre_p)-1){
            $this->iluminadoIndiceNombre = 0;
            return;
        }

        $this->iluminadoIndiceNombre++;
    }

    public function decrementarIluminadoNombre(){
        
        if($this->iluminadoIndiceNombre === 0){
            $this->iluminadoIndiceNombre = count($this->nombre_p)-1;
            return;
        }

        $this->iluminadoIndiceNombre--;
    }

    public function seleccionarNombre(){
        $mascc = $this->nombre_p[$this->iluminadoIndiceNombre] ?? null; 
           
        if( $mascc ){
            $this->nombre =  $mascc['nombre'];
            $this->oculto_nombre = 1;
        }
        
        
    }



    //Busqueda de Capa
    public function reset_capa(){
        $this->capasss = "";
        $this->oculto_capa = 0;
    }

    public function incrementaIluminadoCapa(){
        if($this->iluminadoIndiceCapa === count($this->nombre_p)-1){
            $this->iluminadoIndiceCapa = 0;
            return;
        }

        $this->iluminadoIndiceCapa++;
    }

    public function decrementarIluminadoCapa(){
        
        if($this->iluminadoIndiceCapa === 0){
            $this->iluminadoIndiceCapa = count($this->nombre_p)-1;
            return;
        }

        $this->iluminadoIndiceCapa--;
    }

    public function seleccionarCapa(){
        $mascc = $this->capa_p[$this->iluminadoIndiceCapa] ?? null; 
           
        if( $mascc ){
            $this->capasss =  $mascc['capas'];
            $this->oculto_capa = 1;
        }        
        
    }


      //Busqueda Vitola
      public function reset_vitola(){
        $this->vitolasss = "";
        $this->oculto_vitola = 0;
    }

    public function incrementaIluminadoVitola(){
        if($this->iluminadoIndiceVitola === count($this->capa_p)-1){
            $this->iluminadoIndiceVitola = 0;
            return;
        }

        $this->iluminadoIndiceVitola++;
    }

    public function decrementarIluminadoVitola(){
        
        if($this->iluminadoIndiceVitola === 0){
            $this->iluminadoIndiceVitola = count($this->vitola_p)-1;
            return;
        }

        $this->iluminadoIndiceVitola--;
    }

    public function seleccionarVitola(){
        $mascc = $this->vitola_p[$this->iluminadoIndiceVitola] ?? null; 
           
        if( $mascc ){
            $this->vitolasss =  $mascc['vitolas'];
            $this->oculto_vitola = 1;
        }        
        
    }


    
   



}
