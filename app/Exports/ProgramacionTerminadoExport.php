<?php

namespace App\Exports;

use App\CapaEntrega;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProgramacionTerminadoExport implements FromView, ShouldAutoSize
{

    use Exportable;

    protected $fecha;
    public function __construct($busqueda, $id_tov )
    {
        $this->busqueda = $busqueda;
        $this->id_tov = $id_tov;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $detalles_programaciones=\DB::select('call mostrar_detalles_programacion_terminado(:buscar,:id)',
        ['buscar'=>  $this->busqueda,
        'id'=>$this->id_tov]);

        foreach ($detalles_programaciones as $key => $value) {


            if($value->sampler == 'si'){
                $value->marca = $value->descripcion_sampler.' '. $value->marca;
            }

        }


        $data = collect($detalles_programaciones);

        return view('ReporteProgramacionTerminado', [
            'dato'=>$data
        ]);
    }
}
