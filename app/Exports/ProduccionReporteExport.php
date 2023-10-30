<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ProduccionReporteExport implements
    FromView,
    ShouldAutoSize,
    WithStrictNullComparison,WithDefaultStyles
{

    public $nom;
    public $rehechos;

    function __construct($nom,$rehechos) {
        $this->nom = $nom;
        $this->rehechos = $rehechos;
    }

    public function view(): View
    {
        return view('ReporteDiarioProduccion',[ 'rehechos' => $this->rehechos, 'pendiente' => $this->nom ]) ;
    }

    function defaultStyles(Style $defaultStyle)
    {
        // Configure the default styles
        return $defaultStyle->getFill()->setFillType(Fill::FILL_SOLID);
    }

}
