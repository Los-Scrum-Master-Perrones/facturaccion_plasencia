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

        if($row[0] == null && $row[4] ==null && $row[12] ==null
        && $row[14] ==null&& $row[17] ==null&& $row[19] ==null && $row[23] ==null 
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
            'marca' => $row[2]           
        ]);
    }
        
    return $cajas;
}


    
}
