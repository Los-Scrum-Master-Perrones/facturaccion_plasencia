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
class OrdenCaja implements FromView, ShouldAutoSize
{

    use Exportable;

    protected $fecha;
    public function __construct(String $fecha, String $orden_sistema)
    {

        $this->orden_sistema = $orden_sistema;
        $this->fecha = $fecha;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data = DB::table('pendiente')
        ->join('clase_productos', 'clase_productos.item', 'pendiente.item')
        ->join('marca_productos', 'marca_productos.id_marca', '=', 'pendiente.marca')
        ->join('vitola_productos', 'vitola_productos.id_vitola', '=', 'pendiente.vitola')
        ->join('tipo_empaques', 'tipo_empaques.id_tipo_empaque', 'pendiente.tipo_empaque')
        ->join('capa_productos', 'capa_productos.id_capa', 'pendiente.capa')
        ->join('nombre_productos', 'nombre_productos.id_nombre', 'pendiente.nombre')
        ->select('pendiente.item', 'pendiente.orden_del_sitema',
         'vitola_productos.vitola', 'capa_productos.capa', 'nombre_productos.nombre as nombres',
         'tipo_empaques.tipo_empaque as tipoempaque','clase_productos.codigo_producto',
         'clase_productos.codigo_caja as caja','pendiente.pendiente', 'tipo_empaques.por_caja',
         'pendiente.mes',
         DB::raw('(CASE 
                        WHEN clase_productos.sampler = "si" THEN  clase_productos.descripcion_sampler
                        ELSE marca_productos.marca 
                        END) AS marca'))
         ->where('pendiente.orden_del_sitema', '=', $this->orden_sistema)
         ->where('tipo_empaques.tipo_empaque', 'like', '%'.'CAJAS'.'%')
        ->get();


        return view('Exports.orden-caja', [
            'dato'=>$data, 'fecha'=>$this->fecha
        ]);
    }
}
