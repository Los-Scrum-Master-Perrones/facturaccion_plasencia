<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;



class MaterialesProgramacionExportView implements  FromView, ShouldAutoSize,
                                WithStrictNullComparison,
                                WithColumnFormatting,WithTitle{

    public $nom;
    public $titulos;

    function __construct($nom,$titulos) {
        $this->nom = $nom;
        $this->titulos = $titulos;
    }

    public function view(): View
    {
        return  $this->nom;
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'O' => NumberFormat::FORMAT_NUMBER,
        ];
    }


    public function title(): String
    {
        return  $this->titulos;
    }
}




