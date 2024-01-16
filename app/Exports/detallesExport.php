<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class detallesExport implements
    FromView,
    ShouldAutoSize,
    WithStrictNullComparison
{

    public $nom;
    public $nm;

    function __construct($nom,$nm) {
        $this->nom = $nom;
        $this->nm = $nm;
    }

    public function view(): View
    {
        $detalles_provicionales = DB::select('call mostrar_detalles_provicional("",?)',[ $this->nm]);
        foreach ($detalles_provicionales as $key => $value) {

            if($value->sampler == 'si'){
                $value->marca = $value->descripcion_sampler.' '. $value->marca;
            }

        }
        return view('Exports.detalle-programacion-export',
                        ['detalles_provicionales'=>$detalles_provicionales,
                          'existencia'=>$this->nom]) ;
    }

}
