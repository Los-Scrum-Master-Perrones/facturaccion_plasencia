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

        for($i = 0; $i < count($this->pedido_completo) ;$i++){
            $this->total_puros += $this->pedido_completo[$i]->unidades*$this->pedido_completo[$i]->cant_paquetes;
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
