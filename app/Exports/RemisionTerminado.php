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
class RemisionTerminado implements FromView, ShouldAutoSize
{

    use Exportable;

    protected $fecha;
    public function __construct(String $fecha )
    {

        $this->fecha = $fecha;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $id_det_terminado = $this->obtenerId($this->fecha);
        $data = DB::table('detalle_terminado_diario')
        ->join('detalle_programacion_terminado', 'detalle_programacion_terminado.id', 
        'detalle_terminado_diario.id_det_progra_term')
        ->join('pendiente_empaque', 'pendiente_empaque.id_pendiente', '=', 'detalle_programacion_terminado.id_pendiente')
        ->join('marca_productos', 'marca_productos.id_marca', '=', 'pendiente_empaque.marca')
        ->join('vitola_productos', 'vitola_productos.id_vitola', '=', 'pendiente_empaque.vitola')
        ->join('tipo_empaques', 'tipo_empaques.id_tipo_empaque', 'pendiente_empaque.tipo_empaque')
        ->join('capa_productos', 'capa_productos.id_capa', 'pendiente_empaque.capa')
        ->join('clase_productos', 'clase_productos.item', 'pendiente_empaque.item')
        ->join('nombre_productos', 'nombre_productos.id_nombre', 'pendiente_empaque.nombre')
        ->select('detalle_terminado_diario.id as detid', 'detalle_programacion_terminado.id','pendiente_empaque.item', 'detalle_programacion_terminado.orden',
         'detalle_programacion_terminado.numero_orden', 'detalle_terminado_diario.cantidad',
         'vitola_productos.vitola', 'capa_productos.capa', 'nombre_productos.nombre as nombres',
         'tipo_empaques.tipo_empaque as tipoempaque','clase_productos.codigo_producto',
         'clase_productos.sampler',
         DB::raw('(CASE 
                        WHEN clase_productos.sampler = "si" THEN  clase_productos.descripcion_sampler
                        ELSE marca_productos.marca 
                        END) AS marca'))
         ->where('detalle_terminado_diario.id_terminado_diario', '=', $id_det_terminado)
        ->get();

        $total = DB::table('detalle_terminado_diario')->where('detalle_terminado_diario.id_terminado_diario',
         '=', $id_det_terminado)
        ->sum('cantidad');

        return view('Exports.remisiondiaria', [
            'dato'=>$data, 'fecha'=>$this->fecha, 'total'=>$total
        ]);
    }

    function obtenerId($fecha){
        $res = DB::table('diariosterminado')
        ->where('fecha', '=', $fecha)->first();
        return $res->id;
    }
}
