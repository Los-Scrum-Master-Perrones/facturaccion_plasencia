<?php

namespace App\Exports;

use App\Exports\Sheets\ProduccionPlanificacionExportSheet;
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
        $sheets = [];

        foreach ($this->detalles as $detall) {
            $empleados = DB::select('CALL `buscar_produccion_modulos_empleados`(?,"",   @total_tarea)',[$detall->id]);
            $sheets[] = new ProduccionPlanificacionExportSheet($empleados,$detall->nombre);
        }

        return $sheets;
    }
}

