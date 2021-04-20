<?php

namespace App\Imports;

use App\Models\InventarioCajas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class InventarioCajasImport implements ToModel
{
    
use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      if($row[0] == 'Código' || $row[0] == null ){
            $inventariocajas = null;
        }
        else{

        $inventariocajas = new InventarioCajas([
            'codigo' => $row[0],
            'productoServicio' => $row[1],
            'marca' => $row[2]          
        ]);
    }
        
    return $inventariocajas;
    }
}
