<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProduccionMoldesRestantesExport implements
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
