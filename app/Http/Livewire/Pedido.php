<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pedido extends Component
{

    public $data;
    public $pedido_completo;
    public $verificar;
    public $total_puros = 0;


    public $b_categoria;
    public $b_item;
    public $b_orden;

    public function render()
    {
        $this->total_puros = 0;

        $this->data = compact(DB::table('vitola_productos')->get()); 
        $this->verificar = DB::select('call verificar_item_clase');
        $this->pedido_completo = DB::select('call buscar_pedidos(:item,:categoria,:orden)',[
            "item"=>$this->b_item,
            "categoria"=>$this->b_categoria,
            "orden"=>$this->b_orden
        ]);        

        $datos = [];
        $cantidad_detalle_sampler = 0;   
        $detalles = 0;  
        $valores = [];  

        for($i = 0; $i < count($this->pedido_completo) ;$i++){
            $this->total_puros += $this->pedido_completo[$i]->unidades*$this->pedido_completo[$i]->cant_paquetes;


            $sampler = DB::select('SELECT clase_productos.sampler FROM clase_productos WHERE  clase_productos.item = ?;', [$this->pedido_completo[$i]->item]);
            if( $sampler[0]->sampler == "si"){
                if($cantidad_detalle_sampler == 0 && $detalles == 0){
                    $datos = DB::select('call traer_numero_detalles_productos(?)', [$this->pedido_completo[$i]->item]);
                    $cantidad_detalle_sampler = $datos[0]->tuplas;
                }
                $valores = DB::select('call traer_numero_detalles_productos_datos(?,?)', [$this->pedido_completo[$i]->item,$detalles]);
                   
                

                $descripcion_sampler = DB::select('SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE  clase_productos.item = ?;', [$this->pedido_completo[$i]->item]);


                $this->pedido_completo[$i]->descripcion = $descripcion_sampler[0]->descripcion_sampler." ".$valores[0]->marca." ".$valores[0]->nombre." ".$valores[0]->capa." ".$valores[0]->vitola;

                $detalles++;

                if($detalles == $cantidad_detalle_sampler){
                    $detalles = 0;
                    $cantidad_detalle_sampler = 0;
                }
            }
            
        }

       
        
        return view('livewire.pedido')->extends('principal')->section('content');
    }

    public function mount(){
        $this->b_categoria= "";
        $this->b_item = "";
        $this->b_orden = "";
        $this->total_puros = 0;
        $this->data = []; 
        $this->verificar = [];
        $this->pedido_completo = [];
    }

    function vaciar_import_excel()
    {
    
        DB::table('pedidos')->delete();        
        $this->data = compact(DB::table('vitola_productos')->get()); 
        $this->verificar = DB::select('call verificar_item_clase');
        $this->pedido_completo = DB::select('call mostrar_pedido');
    }
}
