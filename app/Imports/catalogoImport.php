<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\Importable;
use App\Models\pedido;
use Maatwebsite\Excel\Concerns\ToModel;

class catalogoImport implements ToModel
{   use Importable;

   public $item;
   public $contar = 0;
   public $orden;

    public function model(array $row)
    {

        // if($row[4] == null && $row[1] == null && $row[5] ==null ||$row[0] == "RP Item#" || $row[0] == null){

        // if($row[4] != null && $row[0] != null && $row[2] != null && $row[1] == null && $row[3] == null){
        //     $this->orden = $row[5];
        //     $this->item =$row[0];
        //     $this->contar = DB::select('call contar_detalles_productos(:item)', ['item'=> $this->item]);
        //     $pedio = null;
        // }else{ 
        //     if($this->contar>0){

        //         $pedio = new pedido([
        //         'item' => $this->item,
        //         'cant_paquetes' => $row[1],
        //         'unidades' => $row[4],
        //         'numero_orden' =>$this->orden ,
        //         'categoria' => "2",
        //         ]);
        //         $this->contar--;

        //     }else{

        //          $pedio = null;
        //     }}
        // }else{

        // $pedio = new pedido([
        // 'item' => $row[0],
        // 'cant_paquetes' => $row[1],
        // 'unidades' => $row[4],
        // 'numero_orden' => $row[5],
        // 'categoria' => "2",
        // ]);
        // }

        return null;
         }
}
