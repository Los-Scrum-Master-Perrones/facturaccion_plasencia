<?php

namespace App\Imports;

use App\Models\ListaCajas;
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
      if($row[0] == 'Código' || $row[0] == null ||$row[0] == ' - CAJAS DE MADERA'||$row[0] == 'Tabacos de Oriente, S. De R. L.  - El Paraiso'||
      $row[0] == 'LISTADO DE PRODUCTOS POR DEPARTAMENTOS Y CATEGORIAS'){
            $inventariocajas = null;
        }
        else{

        $inventariocajas = new ListaCajas([
            'codigo' => $row[0],
            'productoServicio' => $row[1],
            'marca' => $row[2]          
        ]);
    }
        
    return $inventariocajas;
    }
}
