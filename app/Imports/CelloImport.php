<?php

namespace App\Imports;

use App\Models\cello;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class CelloImport implements ToModel
{
    use Importable;
    public function model(array $row)
    { 

    if($row[14] == null || $row[13] == null  || $row[15] == null  ||
    $row[14] == "CELLO" ||  $row[13] == "ANILLO"  || $row[15] == "UPC" ){
        $cello = null;
    }else{
        $cello_existe = cello::where('cello',$row[14])->count();
        $anillo_existe = cello::where('anillo',$row[13])->count();
        $upc_existe = cello::where('upc',$row[15])->count();
      if($cello_existe>0 && $anillo_existe>0  && $upc_existe>0  ){
        $cello = null;
      }else{
        
        $cello =  new cello([
            'cello' => $row[14],
            'anillo'=>$row[13],
            'upc'=>$row[15],

        ]);
     }
      }

      return $cello;
    }

}
