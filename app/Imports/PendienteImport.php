<?php

namespace App\Imports;

use App\Models\pendiente;
use App\Models\categoria;
use App\Models\clase_producto;
use Maatwebsite\Excel\Concerns\ToModel;
use DB;

use Maatwebsite\Excel\Concerns\Importable;


class PendienteImport implements ToModel
{
    use Importable;
    public function model(array $row)
    {

        if($row[0] == null  && $row[1] == null 
                            && $row[2] == null
                            && $row[3] == null 
                            && $row[4] == null 
                            && $row[5] == null 
                            && $row[6] == null 
                            && $row[7] == null 
                            && $row[8] == "PENDIENTE"
                            && $row[4] == null 
                            && $row[5] == null 
                           ){

            $pendiente = null;

        }else{

            if($row[0] == "CATEGORIA"  ){
            $pendiente = null;
        }else {
            
            $categoria = \DB::select('CALL `traer_categoria_id`(:cate)',['cate'=>$row[0]]);

            $datos_item = \DB::select('call traer_datos_productos(:item)',['item'=>$row[1]]);

            $pendiente = new pendiente([
                        'categoria'=> isset($categoria[0]->id_categoria)? $categoria[0]->id_categoria:0,
                        'item'=> $row[1],
                        'orden_del_sitema'=>$row[2],
                        'observacion'=>$row[3],
                        'presentacion'=>$row[4],
                        'mes'=>$row[6],
                        'orden'=>$row[7],
                        'marca'=>isset($datos_item[0]->id_marca)? $datos_item[0]->id_marca:0 ,
                        'vitola'=>isset( $datos_item[0]->id_vitola)? $datos_item[0]->id_vitola:0,
                        'nombre'=> isset($datos_item[0]->id_nombre)? $datos_item[0]->id_nombre:0 ,
                        'capa'=> isset($datos_item[0]->id_capa)? $datos_item[0]->id_capa:0,
                        'tipo_empaque'=> isset($datos_item[0]->id_tipo_empaque)? $datos_item[0]->id_tipo_empaque:0 ,
                        'cello'=> isset($datos_item[0]->id_cello)? $datos_item[0]->id_cello:0,
                        'pendiente'=>(int)$row[16],
                        'saldo'=>(int)$row[17],
                        'paquetes'=>"0",
                        'unidades'=>"0"
           ]);
            }
       }

        return $pendiente;
    }
}
