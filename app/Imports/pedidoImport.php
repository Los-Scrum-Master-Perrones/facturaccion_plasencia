<?php

namespace App\Imports;

use App\Imports\newrollImport;
use App\Imports\catalogoImport;
use App\Imports\inventarioexistenteImport;
use App\Imports\warehouseImport;

use App\Models\pedido;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class pedidoImport implements WithMultipleSheets, SkipsUnknownSheets
{
    
    use Importable;

    public function sheets(): array
    {
        return [
           'ROLL NEW'=> new newrollImport(), 
           'CATALOG' =>new catalogoImport(),
           'TAKE FROM EXISTING INVENT'=>new inventarioexistenteImport(),
           'International Sales'=> new warehouseImport(),
        ];
        
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }


    // public function model(array $row)
    // {
    //     if($row[4] == null && $row[5] ==null){
    //         $pedio = null;
    //     }else{
    //         $pedio =  new pedido([
    //             'item' => $row[0],
    //             'unidades' => $row[4],
    //             'numero_orden' => $row[2],
    //         ]);
    //     }

    // 	return $pedio;
    // }
   
}


 
   


