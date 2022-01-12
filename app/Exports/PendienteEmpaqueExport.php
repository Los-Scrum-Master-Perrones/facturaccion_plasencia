<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use App\Http\Static_Vars_PendienteEmpaque;



class PendienteEmpaqueExport implements
    FromCollection,
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
            'ID',
            'CATEGORIA',
            'ITEM',
            'ORDEN DEL SISTEMA',
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
            'PENDIENTE',
            'SALDO',
            'TIPO DE EMPAQUE',
            'PAQUETES',
            'UNIDADES'
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
