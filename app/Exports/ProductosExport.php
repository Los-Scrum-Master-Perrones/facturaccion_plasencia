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


class ProductosExport implements FromCollection,
                                ShouldAutoSize,
                                WithHeadings,
                                WithStrictNullComparison,
                                WithColumnFormatting
{
    
    public $busqueda;
    
    function __construct($busqueda) {
        $this->busqueda = $busqueda;
    }

    public function headings(): array
    {
        return [
            'Item',
            'Marca',
            'Nombre',
            'Vitola',
            'Tipo de empaque'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function collection()
    {
        $datos_producto = \DB::select('call buscar_pendiente(:busqueda)',
        ['busqueda'=>(String)$this->busqueda
        ]);

        return collect($datos_producto);
    }
}
