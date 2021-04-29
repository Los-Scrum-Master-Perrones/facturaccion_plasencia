<?php

namespace App\Imports;

use App\Models\marca_producto;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\Importable;



class DPMarcaImport implements ToModel
{
    use Importable;
    public function model(array $row)
    {
    if($row[1] == null || $row[1] == "Marca"){
        $marca = null;
    }else{
        $marca_existe = marca_producto::where('marca',$row[1])->count();
      if($marca_existe>0){
        $marca = null;
      }else{
        
        $marca =  new marca_producto([
            'MARCA' => $row[1],
        ]);
     }
      }

      return $marca;
    }


}
