<?php

namespace App\Exports;

use __PHP_Incomplete_Class;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;



class PendienteExport implements FromCollection,
                                ShouldAutoSize,
                                WithHeadings,
                                WithStrictNullComparison,
                                WithColumnFormatting
{
    public $datos_pendienteExcel;

    function __construct($datos_pendienteExcel) {
        $this->datos_pendienteExcel = $datos_pendienteExcel;
    }


    public function headings(): array
    {
        return [
            'CATEGORIA',
            'ITEM',
            'SO # ORDEN',
            'OBSERVACÓN',
            'PRESENTACIÓN',
            'MES',
            'ORDEN',
            'MARCA',
            'VITOLA',
            'NOMBRE',
            'CAPA',
            'ANILLO',
            'CELLO',
            'UPC',
            'TIPO DE EMPAQUE',
            'PAQUETES',
            'UNIDADES',
            'CODIGO PRECIO',
            'PRECIO',
            'PENDIENTE',
            'SALDO',
            'SALDO ($)',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'R' => NumberFormat::FORMAT_TEXT,
            'O' => NumberFormat::FORMAT_NUMBER,
            'V' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
        ];
    }

    public function collection()
    {
        return collect($this->datos_pendienteExcel);
    }
}
