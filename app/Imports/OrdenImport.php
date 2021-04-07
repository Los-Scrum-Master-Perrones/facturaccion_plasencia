<?php

namespace App\Imports;

use App\Models\orden_producto;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\Importable;
class OrdenImport implements ToModel
{
    use Importable;




    
    public function model(array $row)
    {
    if($row[7] == null ||  $row[7] == "ORDEN" ){
        $orden = null;
    }else{
        $orden_existe = orden_producto::where('orden',$row[7])->count();
      if($orden_existe>0){
        $orden = null;
      }else{
        
        $orden =  new orden_producto([
            'ORDEN' => $row[7],
        ]);
     }
      }

      return $orden;
    }


}













