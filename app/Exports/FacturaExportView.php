<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;



class FacturaExportView implements  FromView,ShouldAutoSize,
                                WithStrictNullComparison,
                                WithColumnFormatting{

    public $nom;
    
    function __construct($nom) {
        $this->nom = $nom;
    }

    public function view(): View
    {
        return view('Exports.factura-terminado-exports', [
            'detalles_venta' => DB::select('call mostrar_detalle_factura_export(:nombre)',
            ['nombre'=>(String)$this->nom
            ])
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'O' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
