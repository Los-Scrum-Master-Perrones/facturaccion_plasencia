<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Exports\PendienteExport;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class Pendiente extends Component
{
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

    public $datos_pendiente;
    public $fecha;

 /* procedimientos almacanedos cargar select de nuevo pendiente*/
    public $marcas;
    public $capas;
    public $nombres;
    public $vitolas;
    public $tipo_empaques;
    
    public $busqueda;
    public $borrar;
    public $actualizar;


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
        $this->capas= \DB::select('call buscar_capa("")');
        $this->nombres= \DB::select('call buscar_nombre("")');
        $this->vitolas= \DB::select('call buscar_vitola("")');
        $this->marcas= \DB::select('call buscar_marca("")');
        $this->tipo_empaques= \DB::select('call buscar_tipo_empaque("")');

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

       
       $this->datos_pendiente = DB::select('call buscar_pendiente(:fede,:cat,:item,:pres,:orden,:marca,:vito,:nom,:capa,:empa,:hon)',
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
        
        return view('livewire.pendiente')->extends('principal')->section('content');
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
 
        $this->datos_pendiente = [];
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


        $this->capas= \DB::select('call buscar_capa("")');
        $this->marcas=\DB::select('call buscar_marca("")');
        $this->nombres= \DB::select('call buscar_nombre("")');
        $this->vitolas= \DB::select('call buscar_vitola("")');
        $this->tipo_empaques= \DB::select('call buscar_tipo_empaque("")');

        $this->datos_pendiente = DB::select('call buscar_pendiente(:fede,:cat,:item,:pres,:orden,:marca,:vito,:nom,:capa,:empa,:hon)',
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









    public function pendiente_indexi(Request $request)
    {

        $insertar_pendiente = DB::select(
            'call insertar_pendiente(:fecha)',
            ['fecha' => (string)$request->fecha]
        );
        
            $insertar_pendiente_empaque =   \DB::select(
                'call insertar_pendente_empaque(:fecha)',
                ['fecha' => (string)$request->fecha]
            );
    
         
    
            $this->datos_pendiente = DB::select('call buscar_pendiente(:fede,:cat,:item,:pres,:orden,:marca,:vito,:nom,:capa,:empa,:hon)',
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

             
            return redirect()->route('pendiente')->with('insertar_pendiente', $insertar_pendiente);
         }










    public function pendiente_index(Request $request)
    {

        $this->datos_pendiente=  \DB::select('call mostrar_pendiente');

        return redirect()->route('pendiente');
    }


   


    public function buscar(Request $request)
    {
        if ($request->fecha_de == null) {
            $fede = "0";
        } else {
            $fede = $request->fecha_de;
        }

        if ($request->fecha_hasta === null) {
            $feha = "0";
        } else {
            $feha = $request->fecha_hasta;
        }


        if ($request->nombre == null) {
            $nom = "0";
        } else {
            $nom = $request->nombre;
        }

        $this->capas= \DB::select('call buscar_capa("")');
        $this->marcas=\DB::select('call buscar_marca("")');
        $this->nombres= \DB::select('call buscar_nombre("")');
        $this->vitolas= \DB::select('call buscar_vitola("")');
        $this->tipo_empaques= \DB::select('call buscar_tipo_empaque("")');
      
        $this->datos_pendiente = DB::select('call buscar_pendiente(:fede,:cat,:item,:pres,:orden,:marca,:vito,:nom,:capa,:empa,:hon)',
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
        
        return redirect()->route('pendiente'); 
    }

    


    public function eliminar_pendiente(Request $request){

        $this->datos_pendiente =[];    
        $this->borrar=\DB::select('call borrar_pendientes(:eliminar)',['eliminar'=>$request->id_pendiente]);
     
        return redirect()->route('pendiente'); 
    
        }

        public function actualizar_pendiente(Request $request){         
    
        
            $this->actualizar=\DB::select('call actualizar_pendientes(:id,:item,:orden,:observacion,:presentacion,:pendiente,:cprecio,:precio,:orden1)',
            ['id'=>$request->id_pendientea,
            'item'=>$request->itema,
            'orden'=>$request->orden_sistema,
            'observacion'=>$request->observacion,
            'presentacion'=>$request->presentacion,
            'pendiente'=>$request->pendiente,
            'cprecio'=>$request->cprecio,
            'precio'=>$request->precio,
            'orden1'=>$request->orden
            ]);
    
            
            $this->datos_pendiente = DB::select('call buscar_pendiente(:fede,:cat,:item,:pres,:orden,:marca,:vito,:nom,:capa,:empa,:hon)',
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
         
            return redirect()->route('pendiente'); 
        
            }


            

    function exportPendiente()
    {
        return Excel::download(new PendienteExport($this->nom, $this->fede, $this->fecha), 'Pendiente.xlsx');
    }
	


    function insertar_nuevo_pendiente(Request $request){
        if(isset($request->cello)){
           
            $cello = $request->cello;
        }else{
            $cello = "no";
        }

        if(isset($request->anillo)){
            $anillo = $request->anillo;
            
        }else{
            $anillo = "no";
        }

        if(isset($request->upc)){
            $upc = $request->upc;
           
        }else{
            $upc = "no";
        }

        $insertar_nuevo_pendiente=\DB::select('call insertar_nuevo_pendiente(:categoria,:item,:orden,:observacion,:presentacion,:mes,:orden1,:marca,
        :vitola,:nombre,:capa,:tipo_empaque,:cello,:anillo,:upc,:pendiente,:saldo,:paquetes,:unidades,:cprecio,:precio)',
        
        ['categoria'=>$request->categoria,
        'item'=>$request->itemn,
        'orden'=>$request->ordensis,
        'observacion'=>$request->observacionn,
        'presentacion'=>$request->presentacionn,
        'mes'=>$request->fechan,
        'orden1'=>$request->ordenn,
        'marca'=>$request->marca,
        'vitola'=>$request->vitola,
        'nombre'=>$request->nombre,
        'capa'=>$request->capa,
        'tipo_empaque'=>$request->tipo,
        'cello'=>$cello,
        'anillo'=>$anillo,
        'upc'=>$upc,
        'pendiente'=>$request->pendienten,
        'saldo'=>$request->saldon,
        'paquetes'=>$request->paquetes,
        'unidades'=>$request->unidades,
        'cprecio'=>$request->c_precion,
        'precio'=>$request->precion
        ]);
                
        return redirect()->route('pendiente'); 
    }

}
