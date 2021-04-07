<?php

namespace App\Imports;

use App\Models\nombre_producto;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\Importable;
class NombreImport implements ToModel
{
    use Importable;


    public function model(array $row)
    {
    if($row[10] == null ||  $row[10] == "NOMBRE" ){
        $nombre = null;
    }else{
        $nombre_existe = nombre_producto::where('nombre',$row[10])->count();
      if($nombre_existe>0){
        $nombre = null;
      }else{
        
        $nombre =  new nombre_producto([
            'NOMBRE' => $row[10],
        ]);
     }
      }

      return $nombre;
    }


}

