<?php

namespace App\Imports;

use App\Models\marca_producto;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\Importable;
class MarcaImport implements ToModel
{
    use Importable;
    public function model(array $row)
    {
    if($row[8] == null || $row[8] == "PENDIENTE" || $row[8] == "MARCA" ){
        $marca = null;
    }else{
        $marca_existe = marca_producto::where('marca',$row[8])->count();
      if($marca_existe>0){
        $marca = null;
      }else{
        
        $marca =  new marca_producto([
            'MARCA' => $row[8],
        ]);
     }
      }

      return $marca;
    }


}
