<?php

namespace App\Http\Livewire;

use Livewire\Component;



use Illuminate\Http\Request;
use Livewire\WithPagination;
use DB;
use Illuminate\Support\Facades\View;


class PendienteEmpaque extends Component
{

    public $datos_pendiente_empaque;
    public $nombre;
    public $tuplas;
    public $datos_pendiente_empaque_nuevo;

    // variables del wire model
    public $r_uno;
    public $r_dos;
    public $r_tres;
    public $r_cuatro;
    
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
          /*Procedimientos de busquedas de la tabla pendiente Empaque*/  
          $this->marcas_p=\DB::select('call buscar_marca_empaque(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );
        $this->nombre_p=\DB::select('call buscar_nombre_empaque(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );
        $this->vitolas_p=\DB::select('call buscar_vitola_empaque(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );
        $this->capas_p=\DB::select('call buscar_capa_empaque(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );
        $this->empaques_p=\DB::select('call buscar_tipo_empaque_empaque(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );

    $this->mes_p=\DB::select('call buscar_fecha_empaque(:uno,:dos,:tres,:cuatro)',
    [
        'uno' =>  $this->r_uno,
        'dos' =>  $this->r_dos,
        'tres' =>  $this->r_tres,
        'cuatro' =>  $this->r_cuatro
    ]
);
    $this->items_p=\DB::select('call buscar_item_empaque(:uno,:dos,:tres,:cuatro)',
    [
        'uno' =>  $this->r_uno,
        'dos' =>  $this->r_dos,
        'tres' =>  $this->r_tres,
        'cuatro' =>  $this->r_cuatro
    ]
);
    $this->ordenes_p=\DB::select('call buscar_ordenes_empaque(:uno,:dos,:tres,:cuatro)',
    [
        'uno' =>  $this->r_uno,
        'dos' =>  $this->r_dos,
        'tres' =>  $this->r_tres,
        'cuatro' =>  $this->r_cuatro
    ]
);
    $this->hons_p=\DB::select('call buscar_hons_empaque(:uno,:dos,:tres,:cuatro)',
    [
        'uno' =>  $this->r_uno,
        'dos' =>  $this->r_dos,
        'tres' =>  $this->r_tres,
        'cuatro' =>  $this->r_cuatro
    ]
);

        
        $this->datos_pendiente_empaque = DB::select('call buscar_pendiente_empaque(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );
    
        $this->datos_pendiente_empaque_nuevo = DB::select('select pendiente_empaque.id_pendiente,pendiente_empaque.saldo from pendiente_empaque');

        $this->tuplas=count($this->datos_pendiente_empaque);


        $datos = [];
        $cantidad_detalle_sampler = 0;   
        $detalles = 0;  
        $valores = [];  

        $datos_pendiente = DB::select('select * from pendiente_empaque ORDER BY mes,item,orden,id_pendiente asc');

      
        return view('livewire.pendiente-empaque')->extends('principal')->section('content');
    }

    public function mount(){

        $this->borrar = [];
        $this->actualizar= [];

        $this->datos_pendiente_empaque = DB::select('call buscar_pendiente_empaque(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );  
   
       
    }



    
     


    public function insertar_detalle_provicional(){

        $this->datos_pendiente_empaque = DB::select('call buscar_pendiente_empaque(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
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
