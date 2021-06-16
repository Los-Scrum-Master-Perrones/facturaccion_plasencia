<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;




use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class detallesExport implements FromCollection, 
ShouldAutoSize,
WithHeadings,
WithStrictNullComparison,
WithColumnFormatting
{function __construct() {
    
}

public function headings(): array
{
    return [
        '# ORDEN',
        'ORDEN',
        'MARCA',
        'VITOLA',
        'NOMBRE',
        'CAPA',
        'TIPO DE EMPAQUE',
        'ANILLO',
        'CELLO',
        'UPC',
        'SALDO',
       
    ];
}

public function columnFormats(): array
{
    return [
        'B' => NumberFormat::FORMAT_TEXT,
        'O' => NumberFormat::FORMAT_NUMBER,
    ];
}

public function collection()
{
  
    $detalles_programaciones=\DB::select('call mostrar_detallesprovicional_exportar()');


    return collect($detalles_programaciones);
}
}
