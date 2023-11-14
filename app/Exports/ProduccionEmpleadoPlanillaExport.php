<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ProduccionEmpleadoPlanillaExport implements
    FromView,
    ShouldAutoSize
{

    public $nom;
    public $rangoFecha;
    public $titulo;

    function __construct($nom,$rangoFecha,$titulo) {
        $this->nom = $nom;
        $this->rangoFecha = $rangoFecha;
        $this->titulo = $titulo;
    }

    public function view(): View
    {
        return view('ReportePlanillaProduccion',[ 'pendiente' => $this->nom , 'rangoFecha' => $this->rangoFecha, 'titulo' => $this->titulo]) ;
    }


}
