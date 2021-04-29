<?php

namespace App\Imports;

use App\Imports\DPCapaImport;
use App\Imports\DPMarcaImport;
use App\Imports\DPNombreImport;
use App\Imports\DPtipo_empaqueImport;
use App\Imports\DPVitolaImport;

use App\Models\pedido;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class DatosProductosImport implements WithMultipleSheets, SkipsUnknownSheets
{
    
    use Importable;

    public function sheets(): array
    {
        $nombre  = new DPNombreImport();
        $capa  = new DPCapaImport();
        $marca  = new DPMarcaImport();
        $vitola  = new DPVitolaImport();
        $tipo_empaque  = new DPtipo_empaqueImport();

        return [
           'Nombre'=> $nombre, 
           'Capas' => $capa,
           'Marca'=> $marca,
           'Vitola'=> $vitola,
           'Tipo Empaque'=> $tipo_empaque,
        ];
        
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }

}


 
   


