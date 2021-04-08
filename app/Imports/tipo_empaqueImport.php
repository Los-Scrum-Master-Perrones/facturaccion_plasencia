<?php

namespace App\Imports;

use App\Models\tipo_empaque;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class tipo_empaqueImport implements ToModel
{   
    use Importable;
    public function model(array $row)
    {
    if($row[12] == null ||  $row[12] == "TIPO DE EMPAQUE" ){
        $tipo = null;
    }else{
        $tipo_existe = tipo_empaque::where('tipo_empaque',$row[12])->count();
      if($tipo_existe>0){
        $tipo = null;
      }else{
        
        $tipo =  new tipo_empaque([
            'tipo_empaque' => $row[12],
        ]);
     }
      }

      return $tipo;
    }

}


