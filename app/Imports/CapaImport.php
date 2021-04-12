<?php

namespace App\Imports;

use App\Models\capa_producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
class CapaImport implements ToModel
{
    use Importable;
    public function model(array $row)
    {

        if($row[11] == null || $row[11] == "CAPA" ){
            $capa = null;
        }else{
            $capa_existe = capa_producto::where('capa',$row[11])->count();
          if($capa_existe>0){
            $capa = null;
          }else{
            
            $capa =  new capa_producto([
                'CAPA' => $row[11],
            ]);
          }

        }
        return $capa;
    }
}
