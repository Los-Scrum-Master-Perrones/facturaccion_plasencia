<?php

namespace App\Imports;

use App\Models\Cajas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;


class CajasImport implements ToModel
{
use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        if($row[0] == null && $row[1] ==null && $row[2] ==null
        && $row[3] ==null&& $row[4] ==null&& $row[5] ==null && $row[6] ==null 
        ){
            $cajas = null;
        }else if($row[0] == 'Código' ||  $row[0] == 'LISTADO DE PRODUCTOS POR DEPARTAMENTOS Y CATEGORIAS'		
        ){
            $cajas = null;
        }
        else{

        $cajas = new Cajas([
            'codigo' => $row[0],
            'descripcion' => $row[1],
            'lote_origen' => $row[2],
            'lote_destino' => $row[3],
            'cantidad' => $row[4],
            'costo_u' => $row[5],
            'subtotal' => $row[6]            
        ]);
    }
        
    return $cajas;
}


    
}
