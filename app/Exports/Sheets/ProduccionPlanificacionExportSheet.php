<?php

namespace App\Exports\Sheets;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProduccionPlanificacionExportSheet implements FromView,WithStrictNullComparison,WithTitle,
ShouldAutoSize
{
    public  $detalles;
    public  $p;

    function __construct($detalles,$p) {
        $this->detalles = $detalles;
        $this->p = $p;
    }

    public function view(): View
    {
        return view('Exports.produccion-planificacion',['modulo_empleado' => $this->detalles]);
    }

    public function title(): string
    {
        return $this->p;
    }
}

