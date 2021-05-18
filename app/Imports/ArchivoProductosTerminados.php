<?php

namespace App\Imports;

use App\Models\ArchivoProductoTerminado;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class ArchivoProductosTerminados implements  ToModel
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
            && $row[3] ==null&& $row[4] ==null&& $row[5] ==null ){
                $producto = null;
            }else if (
                $row[0] == 'Lote' ||  $row[0] == ''
            ) {
                $producto = null;
            } else{
            $producto = new ArchivoProductoTerminado([
                'Lote' => $row[0],
                'Marca' => $row[1],
                'Alias_vitola' => $row[2],
                'Vitola' => $row[3],
                'Nombre_capa' => $row[4],
                'Existencia_total' => $row[5]         
            ]);
        }        
        return $producto;
    }

}
