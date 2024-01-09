<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class pedidoImportCatalogo implements WithMultipleSheets, SkipsUnknownSheets
{

    use Importable;

    public function sheets(): array
    {
        return [
            'ROLL NEW'=> new pedidoImportCatalogoHoja(1),
            'CATALOG' => new pedidoImportCatalogoHoja(2),
            'TAKE FROM EXISTING INVENT'=> new pedidoImportCatalogoHoja(3),
            'International Sales'=> new pedidoImportCatalogoHoja(4),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} was skipped");
    }

}






