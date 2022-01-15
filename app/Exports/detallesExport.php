<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;




use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class detallesExport implements
    FromView,
    ShouldAutoSize,
    WithStrictNullComparison
{

    public function view(): View
    {
        $detalles_provicionales = DB::select('call mostrar_detalles_provicional("")');
        foreach ($detalles_provicionales as $key => $value) {

            if($value->sampler == 'si'){
                $value->marca = $value->descripcion_sampler.' '. $value->marca;
            }

        }
        return view('Exports.detalle-programacion-export',['detalles_provicionales'=>$detalles_provicionales]) ;
    }

}
