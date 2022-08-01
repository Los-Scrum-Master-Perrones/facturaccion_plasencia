<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class PendienteMaterialesExport implements
    FromView,
    ShouldAutoSize,
    WithStrictNullComparison
{

    public $datos_pendiente;

    function __construct($datos_pendiente) {
        $this->datos_pendiente = $datos_pendiente;
    }

    public function view(): View
    {

        return view('Exports.pendiente-materiales-export',
                        ['datos_pendiente'=>$this->datos_pendiente]) ;
    }

}
