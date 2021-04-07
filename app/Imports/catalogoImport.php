<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\Importable;
use App\Models\pedido;
use Maatwebsite\Excel\Concerns\ToModel;

class catalogoImport implements ToModel
{   use Importable;
    public function model(array $row)
    {
        if($row[4] == null && $row[5] ==null){
                    $pedio = null;
                }else{
                    $pedio =  new pedido([
                        'item' => $row[0],
                        'cant_paquetes' => $row[1],
                        'unidades' => $row[4],
                        'numero_orden' => $row[5],
                        'categoria' => "CATALOGO",
                    ]);
                }
        
            	return $pedio;
    }
}
