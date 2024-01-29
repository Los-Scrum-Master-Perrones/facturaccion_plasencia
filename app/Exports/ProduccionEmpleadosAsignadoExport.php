<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProduccionEmpleadosAsignadoExport implements
    FromView,
    ShouldAutoSize
{

    public $nom;

    function __construct($nom) {
        $this->nom = $nom;
    }

    public function view(): View
    {
        return view('ProduccionEmpleadosAsignadoExport',[ 'empleados' => $this->nom]) ;
    }


}
