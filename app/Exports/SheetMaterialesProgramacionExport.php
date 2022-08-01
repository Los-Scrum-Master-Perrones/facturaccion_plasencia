<?php

namespace App\Exports;

use App\Exports\Sheets\PackingListExportSheet;
use App\Exports\Sheets\PackingListExportSheetNormal;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SheetMaterialesProgramacionExport implements WithMultipleSheets
{
    public $nom;
    public $vista2;

    function __construct($nom,$vista2) {
        $this->nom = $nom;
        $this->vista2 = $vista2;
    }

    public function sheets(): array
    {

        $sheets[] = new MaterialesProgramacionExportView($this->nom,'Materiales');

        $sheets[] = new MaterialesProgramacionExportView($this->vista2,'Cajas');

        return $sheets;
    }
}


