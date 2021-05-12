<?php

namespace App\Http\Livewire;
use DB;
use Livewire\Component;

use Illuminate\Http\Request;

class DetalleProgramacion extends Component
{

    
    public $detalles_provicionales;
    public $busqueda;
    public $borrar;
    public $actualizar;
    public $actualizar_insertar;
    public $fecha;
    public $contenedor;
    public $insertar_programacion;

    public function render()
    {
        $this->detalles_provicionales= \DB::select('call mostrar_detalles_provicional(:buscar)',['buscar'=>$this->busqueda]);

        return view('livewire.detalle-programacion')->extends('principal')->section('content');
    }

    public function mount(){

    $this->detalles_provicionales=[];
    $this->borrar=[];
    $this->busqueda = "";
    $this->actualizar = [];
    $this->actualizar_insertar = [];
    $this->contenedor="";
    $this->fecha="";
    $this->insertar_programacion=[];
    }

    public function eliminar_detalles(Request $request){

        $this->detalles_provicionales=[];
    
        $this->borrar=\DB::select('call eliminar_detalles(:buscar)',['buscar'=>$request->id_usuarioE]);
        ;


        return redirect()->route('detalles_programacion'); 
    
        }

        public function actualizar_saldo(Request $request){

            $this->detalles_provicionales=[];
        
            $this->actualizar =\DB::select('call actualizar_saldo_programacion(:id, :saldo)',
            ['id'=>$request->id_detalle,
            'saldo'=>$request->saldo ]);
           
            
    
    
            return redirect()->route('detalles_programacion'); 
        
            }

            public function insertarDetalle_y_actualizarPendiente(){
               

                
                $this->detalles_provicionales= \DB::select('call mostrar_detalles_provicional(:buscar)',['buscar'=> $this->busqueda]);
               

                $this->insertar_programacion = \DB::select('call insertar_programacion(:fecha,:contenedor)',
                [ 'fecha'=>$this->fecha,
                'contenedor'=>$this->contenedor]);

                
               
                $this->tuplas=count($this->detalles_provicionales);

               
                    
                for($i = 0 ; $this->tuplas > $i ; $i++){
                $this->actualizar_insertar = \DB::select('call insertar_detalle_programacion(:numero_orden, :orden,:cod_producto,:saldo,:id_pendiente)',
                ['numero_orden'=>isset($this->detalles_provicionales[$i]->numero_orden)?$this->detalles_provicionales[$i]->numero_orden:null,
                'orden'=>isset($this->detalles_provicionales[$i]->orden)?$this->detalles_provicionales[$i]->orden:null,
                'cod_producto'=>isset($this->detalles_provicionales[$i]->cod_producto)?$this->detalles_provicionales[$i]->cod_producto:null,
                'saldo'=>isset($this->detalles_provicionales[$i]->saldo)?$this->detalles_provicionales[$i]->saldo:null,
                'id_pendiente'=>isset($this->detalles_provicionales[$i]->id_pendiente)?$this->detalles_provicionales[$i]->id_pendiente:null
               ]);
            }
               
                

                return redirect()->route('historial_programacion'); 
            
                }
                

}
