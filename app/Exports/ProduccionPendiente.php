<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProduccionPendiente implements
    FromView,
    ShouldAutoSize
{

    public $nom;
    public $tipo;
    public $usosMateriales;

    function __construct($nom,$usosMateriales,$tipo) {
        $this->nom = $nom;
        $this->tipo = $tipo;
        $this->usosMateriales = $usosMateriales;
    }

    public function view(): View
    {
        if($this->tipo == 1){
            return view('Exports.produccion-pendiente-export',[ 'pendiente' => $this->nom ]) ;
        }

        if($this->tipo == 2){
            return view('Exports.produccion-pendiente-materiales-export',[ 'pendiente' => $this->nom,'usosMateriales' => $this->usosMateriales ]) ;
        }

    }


}
