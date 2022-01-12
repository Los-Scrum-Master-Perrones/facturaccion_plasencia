<?php

namespace App\Imports;

use App\Models\vitola_producto;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\Importable;
class VitolaImport implements ToModel
{
    use Importable; 

    
    
    public function model(array $row)
    {
    if($row[9] == null ||  $row[9] == "VITOLA" ){
        $vitola = null;
    }else{
        $vitola_existe = vitola_producto::where('vitola',$row[9])->count();
      if($vitola_existe>0){
        $vitola = null;
      }else{
        
        $vitola =  new vitola_producto([
            'VITOLA' => $row[9],
        ]);
     }
      }

      return $vitola;
    }


}













