<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class CajasExport   implements FromCollection,
ShouldAutoSize,
WithHeadings,
WithStrictNullComparison
{


    public function headings(): array
    {
        return [
            'CÓDIGO',
            'PRODUCTO/SERVICIO',
            'MARCA',
            'EXISTENCIA',           
        ];
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $cajas_export = \DB::select('call mostrar_cajas_export');
        return collect($cajas_export);
    }
}
