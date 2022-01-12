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



class FacturaExport implements FromCollection,
                                ShouldAutoSize,
                                WithHeadings,
                                WithStrictNullComparison,
                                WithColumnFormatting
{

    public $nom;
    
    function __construct($nom) {
        $this->nom = $nom;
    }

    public function headings(): array
    {
        return [
            'Canti.',
            'Unidad',
            'Units',
            'Totol Tabacos',
            'Capa',
            '#',
            'Clase',
            'Codigo',
            'Item',
            'Orden',
            'Amount',
            'Back Orden',
            'Bruto',
            'Neto',
            'Precio',
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
        $datos_pendiente = \DB::select('call mostrar_detalle_factura_export(:nombre)',
        ['nombre'=>(String)$this->nom
        ]);

        return collect($datos_pendiente);
    }
}
