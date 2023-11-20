<?php

namespace App\Exports;

use App\Exports\Sheets\PackingListExportSheet;
use App\Exports\Sheets\ProduccionPlanificacionExportSheet;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProduccionModulosEmpleadoExport implements WithMultipleSheets
{
    public  $detalles;

    function __construct($detalles) {
        $this->detalles = $detalles;
    }

    public function sheets(): array
    {
        $datos = [];
        $sheets = [];



        foreach ($this->detalles as $detall) {

            $empleados = DB::select('CALL `buscar_produccion_modulos_empleados`(?,"")',[$detall->id]);

            $sheets[] = new ProduccionPlanificacionExportSheet($empleados,$detall->nombre);

        }



        return $sheets;
    }
}

