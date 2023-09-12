<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class CatalogoPrecioExport implements  FromView, ShouldAutoSize,
                                WithStrictNullComparison,WithStyles{

    public $nom;

    function __construct($nom) {
        $this->nom = $nom;
    }

    public function view(): View
    {
        return  $this->nom;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Autoajusta el ancho de todas las columnas al contenido
            'A1:Z1000' => [
                'autosize' => true,
            ],
        ];
    }

}
