<?php

namespace App\Exports;

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


    public $feha;
    public $r_uno;
    public $r_dos;
    public $r_tres;
    public $r_cuatro;





    function __construct($fecha,$r_uno  ,$r_dos  ,$r_tres   ,$r_cuatro  ) {
        $this->feha = $fecha;
        $this->r_uno = $r_uno;
        $this->r_dos = $r_dos;
        $this->r_tres = $r_tres;
        $this->r_cuatro = $r_cuatro;

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

        $datos_pendiente = DB::select('call buscar_pendiente(:uno,:dos,:tres,:cuatro)',
        [
            'uno' =>  $this->r_uno,
            'dos' =>  $this->r_dos,
            'tres' =>  $this->r_tres,
            'cuatro' =>  $this->r_cuatro
        ]
    );

        return collect($datos_pendiente);
    }
}
