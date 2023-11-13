<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProduccionPlanificacionSemanal implements
    FromView,
    ShouldAutoSize
{

    public $nom;

    function __construct($nom) {
        $this->nom = $nom;
    }

    public function view(): View
    {
        $moyorDias = 0;
        foreach ($this->nom as $key => $value) {
            $dias = $value->restantes/$value->tarea_acumulada;
            if($dias>$moyorDias){
                $moyorDias = $dias;
            }
        }
        return view('ReportePlanificacionSemanal',[ 'pendientes' => $this->nom , 'dias' => $moyorDias ]) ;
    }


}
