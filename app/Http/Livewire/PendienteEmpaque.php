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
    public $datos_pendiente_empaque_nuevo;

    public $total_pendiente = 0;
    public $total_saldo = 0;
    public function render()
    {

        $this->total_pendiente = 0;
        $this->total_saldo = 0;
        
        $this->datos_pendiente_empaque = DB::select('call buscar_pendiente_empaque(:nombre,:fechade)'
        ,['nombre'=>$this->nombre,
        'fechade'=>$this->fechade]);
    
        $this->datos_pendiente_empaque_nuevo = DB::select('select pendiente_empaque.id_pendiente,pendiente_empaque.saldo from pendiente_empaque');

        $this->tuplas=count($this->datos_pendiente_empaque);


        $datos = [];
        $cantidad_detalle_sampler = 0;   
        $detalles = 0;  
        $valores = [];  

        $datos_pendiente = DB::select('select * from pendiente_empaque ORDER BY mes,item,orden,id_pendiente asc');

        // for($i = 0; $i < count($datos_pendiente) ;$i++){
        //     // $this->total_pendiente += $this->datos_pendiente_empaque[$i]->pendiente;
        //     // $this->total_saldo += $this->datos_pendiente_empaque[$i]->saldo;
           


        //     $sampler = DB::select('SELECT clase_productos.sampler FROM clase_productos WHERE  clase_productos.item = ?;', [$datos_pendiente[$i]->item]);
        //    if(isset($sampler[0])) {
        //        if( $sampler[0]->sampler == "si"){
        //         if($cantidad_detalle_sampler == 0 && $detalles == 0){
        //             $datos = DB::select('call traer_numero_detalles_productos(?)', [$datos_pendiente[$i]->item]);
        //             $cantidad_detalle_sampler = $datos[0]->tuplas;
        //         }
        //         $valores = DB::select('call traer_detalles_productos_actualizar(?,?)', [$datos_pendiente[$i]->item,$detalles]);

        //        echo $datos_pendiente[$i]->item." ".  $detalles.' '.$cantidad_detalle_sampler.' id: '.$datos_pendiente[$i]->id_pendiente.'<br>';
        //         $actualizar = DB::select('call actualizar_pendiente_empaque_sampler(:marca,:nombre,:vitola,:capa,:tipo,:item)',[
        //             'marca'=>$valores[0]->marca,
        //            'nombre'=>$valores[0]->nombre,
        //            'vitola'=>$valores[0]->vitola,
        //            'capa'=>$valores[0]->capa,
        //             'tipo'=>$valores[0]->tipo_empaque ,
        //            'item'=>$datos_pendiente[$i]->id_pendiente
        //         ]);
              
        //         $detalles++;

        //         if($detalles == $cantidad_detalle_sampler){
        //             $detalles = 0;
        //             $cantidad_detalle_sampler = 0;
        //         }
        //     }}
            
        // }
       
        return view('livewire.pendiente-empaque')->extends('principal')->section('content');
    }

    public function mount(){

        $this->datos_pendiente_empaque = DB::select('call buscar_pendiente_empaque(:nombre,:fechade)'
        ,['nombre'=>$this->nombre,
        'fechade'=>$this->fechade]);
        
        $this->tuplas=count($this->datos_pendiente_empaque);

         $this->total_pendiente = 0;
         $this->total_saldo = 0;
 
        $this->fechade= "";
        $this->fechahasta= "";
        $this->nombre= "";
    }

    public function insertar_detalle_provicional(){

        $this->datos_pendiente_empaque = DB::select('call buscar_pendiente_empaque(:nombre,:fechade)'
        ,['nombre'=>$this->nombre,
        'fechade'=>$this->fechade]);
        
        $this->tuplas=count($this->datos_pendiente_empaque);

        for($i = 0 ; $this->tuplas > $i ; $i++){
            $detalles = DB::select('call insertar_detalle_temporal(:numero_orden,:orden,:cod_producto,:saldo,:id_pendiente,:cant)'
            ,['numero_orden'=>isset($this->datos_pendiente_empaque[$i]->orden_del_sitema)?$this->datos_pendiente_empaque[$i]->orden_del_sitema:null,
            'orden'=>isset($this->datos_pendiente_empaque[$i]->orden)?$this->datos_pendiente_empaque[$i]->orden:null,
            'cod_producto'=>isset($this->datos_pendiente_empaque[$i]->item)?$this->datos_pendiente_empaque[$i]->item:null,
            'saldo'=>isset($this->datos_pendiente_empaque[$i]->saldo)?$this->datos_pendiente_empaque[$i]->saldo:null,
            'id_pendiente'=>isset($this->datos_pendiente_empaque[$i]->id_pendiente)?$this->datos_pendiente_empaque[$i]->id_pendiente:null,
            'cant'=>isset($this->datos_pendiente_empaque[$i]->cant_cajas)?$this->datos_pendiente_empaque[$i]->cant_cajas:null]);
        }


        

        return redirect()->route('detalles_programacion'); 
       
    }


    public function insertar_detalle_provicional_sin_existencia($id){

        $datos_pendiente = DB::select('call datos_pendiente_programar(:id)'
        ,['id'=>$id]);
        
        $this->tuplas=count($this->datos_pendiente_empaque);

       
            $detalles = DB::select('call insertar_detallePro_temporalSinExistencia(:numero_orden,:orden,:cod_producto,:saldo,:id_pendiente,:cant)'
            ,['numero_orden'=>isset($datos_pendiente[0]->orden_del_sitema)?$datos_pendiente[0]->orden_del_sitema:null,
            'orden'=>isset($datos_pendiente[0]->orden)?$datos_pendiente[0]->orden:null,
            'cod_producto'=>isset($datos_pendiente[0]->item)?$datos_pendiente[0]->item:null,
            'saldo'=>isset($datos_pendiente[0]->saldo)?$datos_pendiente[0]->saldo:null,
            'id_pendiente'=>isset($datos_pendiente[0]->id_pendiente)?$datos_pendiente[0]->id_pendiente:null,
            'cant'=>isset($datos_pendiente[0]->cant_cajas)?$datos_pendiente[0]->cant_cajas:null]);
        

        return redirect()->route('detalles_programacion'); 
       
    }


    
    public function actualizar_pendiente_empaque(Request $request){         
    
        $this->actualizar=\DB::select('call actualizar_pendiente_empaque(:id,:saldo)',
        ['id'=>$request->id_pendientea,
        'saldo' =>$request->saldo
        ]);


        return redirect()->route('pendiente_empaque'); 
    
        }


    


}
