<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

use App\Exports\ProgramcionExport;
use App\Exports\RemisionTerminado;
use App\Models\ReporteDiario;
use App\Exports\ProgramacionTerminadoExport;
use Illuminate\Support\Facades\DB;
use Spatie\Browsershot\Browsershot;

class ReporteDiarios extends Component
{
    public $programaciones;
    public $detalles_programaciones;
    public $id_tov;
    public $titulo;
    public $item_b;
    public $id_d;
    public $borrar;
    public $busqueda;
    public $detallestodos;
    public $idp;
    public $saldo;
    public $id_pen;
    public $id_tov_imprimir;

    public function render()
    {

        $detallesdiarios = DB::table('detalle_terminado_diario')
        ->join('detalle_programacion_terminado', 'detalle_programacion_terminado.id', 
        'detalle_terminado_diario.id_det_progra_term')
        ->join('pendiente_empaque', 'pendiente_empaque.id_pendiente', '=', 'detalle_programacion_terminado.id_pendiente')
        ->join('marca_productos', 'marca_productos.id_marca', '=', 'pendiente_empaque.marca')
        ->select('detalle_terminado_diario.id_terminado_diario')
        ->where('pendiente_empaque.item','like', '%'. $this->busqueda . '%')
        ->orwhere('marca_productos.marca', 'like', '%'.$this->busqueda.'%');

        $this->programaciones = ReporteDiario::where('procesado','=','1')
        ->whereIn('id', $detallesdiarios)
        ->orderby('fecha', 'desc')->get();


        $this->detalles_programaciones = DB::table('detalle_terminado_diario')
        ->join('detalle_programacion_terminado', 'detalle_programacion_terminado.id', 
        'detalle_terminado_diario.id_det_progra_term')
        ->join('pendiente_empaque', 'pendiente_empaque.id_pendiente', '=', 'detalle_programacion_terminado.id_pendiente')
        ->join('tipo_empaques', 'tipo_empaques.id_tipo_empaque', 'pendiente_empaque.tipo_empaque')
        ->join('marca_productos', 'marca_productos.id_marca', '=', 'pendiente_empaque.marca')
        ->join('vitola_productos', 'vitola_productos.id_vitola', '=', 'pendiente_empaque.vitola')
        ->join('capa_productos', 'capa_productos.id_capa', 'pendiente_empaque.capa')
        ->join('clase_productos', 'clase_productos.item', 'pendiente_empaque.item')
        ->join('nombre_productos', 'nombre_productos.id_nombre', 'pendiente_empaque.nombre')
        ->select('detalle_terminado_diario.id as detid', 'detalle_programacion_terminado.id','pendiente_empaque.item', 'detalle_programacion_terminado.orden',
         'detalle_programacion_terminado.numero_orden', 'detalle_terminado_diario.cantidad',
         'vitola_productos.vitola', 'capa_productos.capa', 'nombre_productos.nombre as nombre',
         'tipo_empaques.tipo_empaque as tipo_empaque',
         DB::raw('(CASE 
                        WHEN clase_productos.sampler = "si" THEN  clase_productos.descripcion_sampler
                        ELSE marca_productos.marca 
                        END) AS marca'))
         ->where('detalle_terminado_diario.id_terminado_diario', '=', $this->id_tov)
         ->where(function($search){
            $search->where('marca_productos.marca', 'like', '%'.$this->busqueda.'%')
            ->orwhere('clase_productos.item', 'like', '%'.$this->busqueda.'%');
         })
         //->where('marca_productos.marca', 'like', '%'.$this->busqueda.'%')
        ->get();
        $this->titulo = DB::table('diariosterminado')->max('fecha');
        if($this->id_tov){
            $this->titulo = DB::table('diariosterminado')->where('id', '=', $this->id_tov)->max('fecha');
        }

        $this->dispatchBrowserEvent('tamanio_tabla');

        return view('livewire.reportediario')->extends('principal')->section('content');
    }

    function obtenerId($fecha){
        $res = DB::table('diariosterminado')
        ->where('fecha', '=', $fecha)->first();
        return $res->id;
    }


    public function mount()
    {
        $this->id_tov = 0;
        $this->borrar = [];
        $this->programaciones = [];
        $this->detalles_programaciones = [];
        $this->busqueda = "";
        $this->idp = 0;
        $this->saldo = 0;
        $this->id_pen = 0;
        $this->detallestodos = [];
        $this->titulo = 0;
        $this->id_d = 0;
        $this->id_tov_imprimir = 0;
    }



    public function ver($id)
    {
        $this->id_tov = $id;
        $this->id_tov_imprimir = $id;
    }

    public function ExcelDiarioRemision(Request $request)
    {
        $fecha = Carbon::parse($request->fecha)->format('Y-m-d');
        return Excel::download(new RemisionTerminado($fecha), 'Remision Terminado '.$request->fecha.'.xlsx');
    }
}
