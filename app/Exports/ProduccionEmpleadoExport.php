<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProduccionEmpleadoExport implements FromCollection,WithHeadings
{
    use Exportable;

    public $nom;

    function __construct($nom) {
        $this->nom = $nom;
    }

    public function Collection()
    {
        return $this->nom;
    }

    public function headings(): array
    {
        return [
            'N#',
            'ORDEN',
            'FECHA',
            'Codigo',
            'Rol',
            'Empleado',
            'CODIGO PRODUCTO',
            'PRESENTACION',
            'MARCA',
            'NOMBRE',
            'VITOLA',
            'CAPA',
            'CANTIDAD',
            'CANTIDAD (L)',
        ];
    }
}
