<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Exports\PendienteExport;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;


class Pendiente extends Component
{
    /* variables para la busqueda*/
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





    public $marcas;
    public $capas;
    public $nombres;
    public $vitolas;
    public $tipo_empaques;

    
    public $busqueda;
    public $borrar;
    public $actualizar;

    public function render()
    {
      

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
        
        return view('livewire.pendiente')->extends('principal')->section('content');
    }


    public function mount(){
 

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
   


    public function pendiente_indexi(Request $request)
    {
            $insertar_pendiente_empaque =   \DB::select(
                'call insertar_pendente_empaque(:fecha)',
                ['fecha' => (string)$request->fecha]
            );
    
            $insertar_pendiente = DB::select(
                'call insertar_pendiente(:fecha)',
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
        $this->datos_pendiente = DB::select(
            'call buscar_pendiente(:nombre,:fechade)',
            [
                'nombre' =>  $this->nom,
                'fechade' =>  $this->fede
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
