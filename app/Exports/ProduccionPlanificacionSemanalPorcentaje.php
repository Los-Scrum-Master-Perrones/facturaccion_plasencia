<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ProduccionPlanificacionSemanalPorcentaje implements
    FromView,
    ShouldAutoSize,
    WithColumnFormatting
{

    public $por_modulo;
    public $produccion;
    public $fecha_inicial;

    function __construct($por_modulo,$produccion,$fecha_inicial) {
        $this->por_modulo = $por_modulo;
        $this->produccion = $produccion;
        $this->fecha_inicial = $fecha_inicial;
    }

    public function view(): View
    {
        return view('ReportePlanificacionSemanalPromedio',[ 'pendientes' => $this->por_modulo , 'fecha_inicial' => $this->fecha_inicial, 'produccion' => $this->produccion ]) ;
    }


    public function columnFormats(): array
    {
        return [
            'K' => NumberFormat::FORMAT_PERCENTAGE,
            'N' => NumberFormat::FORMAT_PERCENTAGE,
            'Q' => NumberFormat::FORMAT_PERCENTAGE,
            'T' => NumberFormat::FORMAT_PERCENTAGE,
            'W' => NumberFormat::FORMAT_PERCENTAGE,
        ];
    }

}
