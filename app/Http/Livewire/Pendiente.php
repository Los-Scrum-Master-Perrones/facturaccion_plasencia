<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Exports\PendienteExport;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;


class Pendiente extends Component
{
    public $datos_pendiente;
    public $fecha;

    // variables del wire  model para la busqueda
    public $r_uno;
    public $r_dos;
    public $r_tres;
    public $r_cuatro;

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
    public $mes_p;
    public $items_p;
    public $ordenes_p;
    public $hons_p;

 

 


    public function render()
    {
        $this->capas= \DB::select('call buscar_capa("")');
        $this->nombres= \DB::select('call buscar_nombre("")');
        $this->vitolas= \DB::select('call buscar_vitola("")');
        $this->marcas= \DB::select('call buscar_marca("")');
        $this->tipo_empaques= \DB::select('call buscar_tipo_empaque("")');
$b_mesA = "hola";
$b_itemA ="";
$b_ordenA = "";
$b_honA = "";
$b_marcaA = "";
$b_vitolaA = "";
$b_nombreA = "";
$b_capaA = "";
$b_empaqueA = "";

        /*Procedimientos de busquedas de la tabla pendiente*/
        $this->marcas_p=\DB::select('call buscar_marca_pendiente(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );
        $this->nombre_p=\DB::select('call buscar_nombre_pendiente(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );
        $this->vitolas_p=\DB::select('call buscar_vitola_pendiente(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );
        $this->capas_p=\DB::select('call buscar_capa_pendiente(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );
        $this->empaques_p=\DB::select('call buscar_tipo_empaque_pendiente(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );

      

        
        $this->mes_p=\DB::select('call buscar_fechas_pendiente(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );
        $this->items_p=\DB::select('call buscar_item_pendiente(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );
        $this->ordenes_p=\DB::select('call buscar_ordenes_pendiente(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );
        $this->hons_p=\DB::select('call buscar_hons_pendiente(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );

     

       
       $this->datos_pendiente = DB::select('call buscar_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );


        $datos = [];
        $cantidad_detalle_sampler = 0;   
        $detalles = 0;  
        $valores = [];  

        for($i = 0; $i < count($this->datos_pendiente) ;$i++){
           


            $sampler = DB::select('SELECT clase_productos.sampler FROM clase_productos WHERE  clase_productos.item = ?;', [$this->datos_pendiente[$i]->item]);
            if( $sampler[0]->sampler == "si"){
                if($cantidad_detalle_sampler == 0 && $detalles == 0){
                    $datos = DB::select('call traer_numero_detalles_productos(?)', [$this->datos_pendiente[$i]->item]);
                    $cantidad_detalle_sampler = $datos[0]->tuplas;
                }
                $valores = DB::select('call traer_detalles_productos_actualizar(?,?)', [$this->datos_pendiente[$i]->item,$detalles]);

               
                $actualizar = DB::select('call actualizar_pendiente_sampler(:marca,:nombre,:vitola,:capa,:tipo,:item)',[
                    'marca'=>$valores[0]->marca,
                   'nombre'=>$valores[0]->nombre,
                   'vitola'=>$valores[0]->vitola,
                   'capa'=>$valores[0]->capa,
                    'tipo'=>$valores[0]->tipo_empaque ,
                   'item'=>$this->datos_pendiente[$i]->id_pendiente
                ]);
              
                $detalles++;

                if($detalles == $cantidad_detalle_sampler){
                    $detalles = 0;
                    $cantidad_detalle_sampler = 0;
                }
            }
            
        }
        
        return view('livewire.pendiente')->extends('principal')->section('content')->with('b_mesA', $b_mesA)->with('b_itemA', $b_itemA)->with('b_ordenA', $b_ordenA)
        ->with('b_honA', $b_honA)->with('b_marcaA', $b_marcaA)->with('b_vitolaA', $b_vitolaA)
        ->with('b_nombreA', $b_nombreA)->with('b_capaA', $b_capaA)->with('b_empaqueA', $b_empaqueA);

    }





    public function mount(){    
 
        $this->datos_pendiente = [];

        $this->fecha = "";
        $this->borrar = [];
        $this->actualizar= [];     

        $datos = [];
        $cantidad_detalle_sampler = 0;   
        $detalles = 0;  
        $valores = [];  
        
        $this->capas= \DB::select('call buscar_capa("")');
        $this->marcas=\DB::select('call buscar_marca("")');
        $this->nombres= \DB::select('call buscar_nombre("")');
        $this->vitolas= \DB::select('call buscar_vitola("")');
        $this->tipo_empaques= \DB::select('call buscar_tipo_empaque("")');

        

   $this->datos_pendiente = DB::select('call buscar_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
    }



   








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
    
         
    
            $this->datos_pendiente = DB::select('call buscar_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
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
      
        $this->datos_pendiente = DB::select('call buscar_pendiente(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
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
            $b_mesA = $request->b_mesA;
            $b_itemA = $request->b_itemA;
            $b_ordenA = $request->b_ordenA;
            $b_honA = $request->b_honA;
            $b_marcaA = $request->b_marcaA;
            $b_vitolaA = $request->b_vitolaA;
            $b_nombreA = $request->b_nombreA;
            $b_capaA = $request->b_capaA;
            $b_empaqueA = $request->b_empaqueA;
        
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
    
            
            $this->datos_pendiente = DB::select('call buscar_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
         
        return redirect()->route('pendiente')->with('b_mesA', $b_mesA)->with('b_itemA', $b_itemA)->with('b_ordenA', $b_ordenA)
                                    ->with('b_honA', $b_honA)->with('b_marcaA', $b_marcaA)->with('b_vitolaA', $b_vitolaA)
                                    ->with('b_nombreA', $b_nombreA)->with('b_capaA', $b_capaA)->with('b_empaqueA', $b_empaqueA);
        }


            

    function exportPendiente()
    {
        return Excel::download(new PendienteExport($this->fecha,$this->r_uno, $this->r_dos, $this->r_tres,$this->r_cuatro), 'Pendiente.xlsx');
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
