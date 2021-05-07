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



class PendienteExport implements FromCollection,
                                ShouldAutoSize,
                                WithHeadings,
                                WithStrictNullComparison,
                                WithColumnFormatting
{

    public $nom;
    public $fede;
    public $feha;
    
    function __construct($nom,$fede,$fecha) {
        $this->nom = $nom;
        $this->fede = $fede;
        $this->feha = $fecha;
    }

    public function headings(): array
    {
        return [
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
            'FACTURA',
            'ENVIADO MES',
            'SALDO',
            'TIPO DE EMPAQUE',
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
        $datos_pendiente = \DB::select('call buscar_pendiente(:nombre,:fechade,:fechahasta)',
        ['nombre'=>(String)$this->nom,
        'fechade'=>(String)$this->fede,
        'fechahasta'=>(String)$this->feha
        ]);

        return collect($datos_pendiente);
    }
}
