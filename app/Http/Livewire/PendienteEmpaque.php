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

/* variables wire model*/
public $fede;
public $cat;
public $item;
public $pres;
public $orden;
public $marca;
public $vito;
public $nom;
public $capa;
public $empa;
public $hon;
    
    /* procedimientos almacanedos busquedas pendiente*/
    public $marcas_p;
    public $nombre_p;
    public $vitolas_p;
    public $capas_p;
    public $empaques_p;

   /* varaibles de metodos para la busqueda*/
    public $oculto_marca;
    public $oculto_nombre;
    public $oculto_capa;
    public $oculto_vitola;
    public $oculto_empaque;

    public $iluminadoIndiceMarca;
    public $iluminadoIndiceNombre;
    public $iluminadoIndiceCapa;
    public $iluminadoIndiceVitola;
    public $iluminadoIndiceEmpaque;

    public function render()
    {


          /*Procedimientos de busquedas de la tabla pendiente*/
          $this->marcas_p=\DB::select('call buscar_marca_pendiente(?)',[$this->marca]);
          $this->nombre_p=\DB::select('call buscar_nombre_pendiente(?)',[$this->nom]);
          $this->vitolas_p=\DB::select('call buscar_vitola_pendiente(?)',[$this->vito]);
          $this->capas_p=\DB::select('call buscar_capa_pendiente(?)',[$this->capa]);
          $this->empaques_p=\DB::select('call buscar_tipo_empaque_pendiente(?)',[$this->empa]);
  
          if($this->marca == null){
              $this->marca="";
          }
          if($this->nom == null){
              $this->nom="";
          }
          if($this->capa == null){
              $this->capa="";
          }  
          if($this->vito == null){
              $this->vito="";
          }  
          if($this->empa == null){
              $this->empa="";
          }


        $this->total_pendiente = 0;
        $this->total_saldo = 0;
        
        $this->datos_pendiente_empaque = DB::select('call buscar_pendiente_empaque(:fede,:cat,:item,:pres,:orden,:marca,:vito,:nom,:capa,:empa,:hon)',
        [
            'fede' =>  $this->fede,
            'cat' =>  $this->cat,
            'item' =>  $this->item,
            'pres' =>  $this->pres,
            'orden' =>  $this->orden,
            'marca' =>  $this->marca,
            'vito' =>  $this->vito,
            'nom' =>  $this->nom,
            'capa' =>  $this->capa,
            'empa' =>  $this->empa,
            'hon' =>  $this->hon
        ]
    );
    
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


        $this->oculto_marca = 0;
        $this->oculto_nombre = 0;
        $this->oculto_capa = 0;
        $this->oculto_vitola = 0;
        $this->oculto_empaque= 0;

        $this->iluminadoIndiceMarca = 0;
        $this->iluminadoIndiceNombre = 0;
        $this->iluminadoIndiceCapa = 0;
        $this->iluminadoIndiceVitola = 0;
        $this->iluminadoIndiceEmpaque = 0;

        $this->fede = "";
        $this->cat = "";
        $this->item = "";
        $this->pres = "";
        $this->orden = "";
        $this->marca = "";
        $this->vito = "";
        $this->nom = "";
        $this->capa = "";
        $this->empa = "";
        $this->hon = "";


        $this->fecha = "";
        $this->borrar = [];
        $this->actualizar= [];
        $this->reset_marca();
        $this->reset_nombre();
        $this->reset_capa();
        $this->reset_vitola();
        $this->reset_empaque();

        $this->datos_pendiente_empaque = DB::select('call buscar_pendiente_empaque(:fede,:cat,:item,:pres,:orden,:marca,:vito,:nom,:capa,:empa,:hon)',
        [
            'fede' =>  $this->fede,
            'cat' =>  $this->cat,
            'item' =>  $this->item,
            'pres' =>  $this->pres,
            'orden' =>  $this->orden,
            'marca' =>  $this->marca,
            'vito' =>  $this->vito,
            'nom' =>  $this->nom,
            'capa' =>  $this->capa,
            'empa' =>  $this->empa,
            'hon' =>  $this->hon
        ]
    );
        
        $this->tuplas=count($this->datos_pendiente_empaque);

         $this->total_pendiente = 0;
         $this->total_saldo = 0;
 
        $this->fechade= "";
        $this->fechahasta= "";
        $this->nombre= "";
    }



    
     //Busqueda de Marca

     public function reset_marca(){
        $this->marca = "";
        $this->oculto_marca = 0;
    }    

    public function incrementaIluminadoMarca(){
        if($this->iluminadoIndiceMarca === count($this->marcas_p)-1){
            $this->iluminadoIndiceMarca = 0;
            return $this->iluminadoIndiceMarca;
        }

        $this->iluminadoIndiceMarca++;
    }

    public function decrementarIluminadoMarca(){
        
        if($this->iluminadoIndiceMarca === 0){
            $this->iluminadoIndiceMarca = count($this->marcas_p)-1;
            return;
        }

        $this->iluminadoIndiceMarca--;
    }

    public function seleccionarMarca(){
        $mascc = $this->marcas_p[$this->iluminadoIndiceMarca] ?? null; 
           
        if( $mascc ){
            $this->marca =  $mascc['marca'];
            $this->oculto_marca = 1;
        }      
    }





    //Busqueda de Nombre
    public function reset_nombre(){
        $this->nom = "";
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
            $this->nom =  $mascc['nombre'];
            $this->oculto_nombre = 1;
        }         
    }



    //Busqueda de Capa
    public function reset_capa(){
        $this->capa = "";
        $this->oculto_capa = 0;
    }

    public function incrementaIluminadoCapa(){
        if($this->iluminadoIndiceCapa === count($this->capas_p)-1){
            $this->iluminadoIndiceCapa = 0;
            return;
        }

        $this->iluminadoIndiceCapa++;
    }

    public function decrementarIluminadoCapa(){
        
        if($this->iluminadoIndiceCapa === 0){
            $this->iluminadoIndiceCapa = count($this->capas_p)-1;
            return;
        }

        $this->iluminadoIndiceCapa--;
    }

    public function seleccionarCapa(){
        $mascc = $this->capas_p[$this->iluminadoIndiceCapa] ?? null; 
           
        if( $mascc ){
            $this->capas =  $mascc['capa'];
            $this->oculto_capa = 1;
        }             
    }



       //Busqueda de Vitola
       public function reset_vitola(){
        $this->vito = "";
        $this->oculto_vitola = 0;
    }

    public function incrementaIluminadoVitola(){
        if($this->iluminadoIndiceVitola === count($this->vitolas_p)-1){
            $this->iluminadoIndiceVitola = 0;
            return;
        }

        $this->iluminadoIndiceVitola++;
    }

    public function decrementarIluminadoVitola(){
        
        if($this->iluminadoIndiceVitola === 0){
            $this->iluminadoIndiceVitola = count($this->vitolas_p)-1;
            return;
        }

        $this->iluminadoIndiceVitola--;
    }

    public function seleccionarVitola(){
        $mascc = $this->vitolas_p[$this->iluminadoIndiceVitola] ?? null; 
           
        if( $mascc ){
            $this->vito =  $mascc['vitola'];
            $this->oculto_vitola = 1;
        }              
    }




       //Busqueda de Empaque
       public function reset_empaque(){
        $this->empa = "";
        $this->oculto_empaque= 0;
    }

    public function incrementaIluminadoEmpaque(){
        if($this->iluminadoIndiceEmpaque === count($this->empaques_p)-1){
            $this->iluminadoIndiceEmpaque = 0;
            return;
        }
        $this->iluminadoIndiceEmpaque++;
    }

    public function decrementarIluminadoEmpaque(){
        
        if($this->iluminadoIndiceEmpaque === 0){
            $this->iluminadoIndiceEmpaque = count($this->empaques_p)-1;
            return;
        }

        $this->iluminadoIndiceEmpaque--;
    }

    public function seleccionarEmpaque(){
        $mascc = $this->empaques_p[$this->iluminadoIndiceEmpaque] ?? null; 
           
        if( $mascc ){
            $this->empa =  $mascc['empaque'];
            $this->oculto_empaque = 1;
        }      
        
    }
   

/* fin de las funciones de busquedas avanzadas*/


    public function insertar_detalle_provicional(){

        $this->datos_pendiente_empaque = DB::select('call buscar_pendiente_empaque(:fede,:cat,:item,:pres,:orden,:marca,:vito,:nom,:capa,:empa,:hon)',
        [
            'fede' =>  $this->fede,
            'cat' =>  $this->cat,
            'item' =>  $this->item,
            'pres' =>  $this->pres,
            'orden' =>  $this->orden,
            'marca' =>  $this->marca,
            'vito' =>  $this->vito,
            'nom' =>  $this->nom,
            'capa' =>  $this->capa,
            'empa' =>  $this->empa,
            'hon' =>  $this->hon
        ]
    );
        
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
