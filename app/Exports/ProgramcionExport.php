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

class ProgramcionExport implements FromCollection, 
ShouldAutoSize,
WithHeadings,
WithStrictNullComparison,
WithColumnFormatting
{
  
    public $busqueda;
    public $id_tov;
    
    function __construct($busqueda,$id_tov) {
        $this->busqueda = $busqueda;
        $this->id_tov = $id_tov;
    }

    public function headings(): array
    {
        return [
            'ID_PROGRAMACION',
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
      
        $detalles_programaciones=\DB::select('call mostrar_detalles_exportar(:buscar,:id)',
        ['buscar'=>  $this->busqueda,
        'id'=>$this->id_tov]);


        return collect($detalles_programaciones);
    }
}
