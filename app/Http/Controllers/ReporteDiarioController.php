<?php

namespace App\Http\Controllers;

use App\Models\ReporteDiario;
use App\Models\detalle_terminado_diario;
use App\Models\Terminado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReporteDiarioController extends Controller
{
    public function index()
    {
        $report = DB::table('diariosterminado')->orderBy('fecha', 'desc')
        ->limit(20)->get();
        return response()->json($report,200);
    }

    public function sinProcesar()
    {
        $report = ReporteDiario::where('procesado', '=', '0')->get();
        return response()->json($report, 200);
    }

    public function totaldiario($fecha){
        $id_det_terminado = $this->obtenerId($fecha);
        $report = DB::table('detalle_terminado_diario')
        ->where('detalle_terminado_diario.id_terminado_diario', '=', $id_det_terminado)
        ->get()->sum('cantidad');
        $convert = ['cantidad'=>$report];
        return response()->json($convert);
    }

    public function ActualizarProgramacionTerminado($fecha){
        $id_det_terminado = $this->obtenerId($fecha);
        $report = DB::table('detalle_terminado_diario')
        ->join('detalle_programacion_terminado', 'detalle_programacion_terminado.id', 
        'detalle_terminado_diario.id_det_progra_term')
        ->join('pendiente_empaque', 'pendiente_empaque.id_pendiente', '=', 'detalle_programacion_terminado.id_pendiente')
        ->join('marca_productos', 'marca_productos.id_marca', '=', 'pendiente_empaque.marca')
        ->join('vitola_productos', 'vitola_productos.id_vitola', '=', 'pendiente_empaque.vitola')
        ->join('tipo_empaques', 'tipo_empaques.id_tipo_empaque', 'pendiente_empaque.tipo_empaque')
        ->join('capa_productos', 'capa_productos.id_capa', 'pendiente_empaque.capa')
        ->join('clase_productos', 'clase_productos.item', 'pendiente_empaque.item')
        ->select('detalle_programacion_terminado.id','pendiente_empaque.item', 'detalle_programacion_terminado.orden',
         'detalle_programacion_terminado.numero_orden',
         'clase_productos.sampler','detalle_terminado_diario.cantidad', 
         'detalle_programacion_terminado.id_programacion')
         ->where('detalle_terminado_diario.id_terminado_diario', '=', $id_det_terminado)
        ->get();
        foreach ($report as $value) {
            if($value->sampler!="si"){
                $detalle_programacion_terminado = Terminado::find($value->id);
                $detalle_programacion_terminado->listos = $detalle_programacion_terminado->listos + $value->cantidad;
                $detalle_programacion_terminado->save();
            }else{
                DB::select(
                    'call update_listos(:id,:cantidad,:item,:programacion,:numero_orden,:orden)',
                    [
                        'id' =>  $value->id,
                        'cantidad' => $value->cantidad,
                        'item' =>  $value->item,
                        'programacion' =>  $value->id_programacion,
                        'numero_orden' =>  $value->numero_orden,
                        'orden' =>  $value->orden
                    ]
                );
            }
        }
        $diarios = ReporteDiario::find($id_det_terminado);
        $diarios->procesado = 1;
        $diarios->save();
        return response()->json($report);

    }

    public function DesaplicarProgramacionTerminado($fecha){
        $id_det_terminado = $this->obtenerId($fecha);
        $report = DB::table('detalle_terminado_diario')
        ->join('detalle_programacion_terminado', 'detalle_programacion_terminado.id', 
        'detalle_terminado_diario.id_det_progra_term')
        ->join('pendiente_empaque', 'pendiente_empaque.id_pendiente', '=', 'detalle_programacion_terminado.id_pendiente')
        ->join('marca_productos', 'marca_productos.id_marca', '=', 'pendiente_empaque.marca')
        ->join('vitola_productos', 'vitola_productos.id_vitola', '=', 'pendiente_empaque.vitola')
        ->join('tipo_empaques', 'tipo_empaques.id_tipo_empaque', 'pendiente_empaque.tipo_empaque')
        ->join('capa_productos', 'capa_productos.id_capa', 'pendiente_empaque.capa')
        ->join('clase_productos', 'clase_productos.item', 'pendiente_empaque.item')
        ->select('detalle_programacion_terminado.id','pendiente_empaque.item', 'detalle_programacion_terminado.orden',
         'detalle_programacion_terminado.numero_orden',
         'clase_productos.sampler','detalle_terminado_diario.cantidad', 
         'detalle_programacion_terminado.id_programacion')
         ->where('detalle_terminado_diario.id_terminado_diario', '=', $id_det_terminado)
        ->get();
        foreach ($report as $value) {
            if($value->sampler!="si"){
                $detalle_programacion_terminado = Terminado::find($value->id);
                $detalle_programacion_terminado->listos = $detalle_programacion_terminado->listos - $value->cantidad;
                $detalle_programacion_terminado->save();
            }else{
                DB::select(
                    'call update_listos_desaplicar(:id,:cantidad,:item,:programacion,:numero_orden,:orden)',
                    [
                        'id' =>  $value->id,
                        'cantidad' => $value->cantidad,
                        'item' =>  $value->item,
                        'programacion' =>  $value->id_programacion,
                        'numero_orden' =>  $value->numero_orden,
                        'orden' =>  $value->orden
                    ]
                );
            }
        }
        $diarios = ReporteDiario::find($id_det_terminado);
        $diarios->procesado = 0;
        $diarios->save();
        return response()->json($report);

    }

    public function MostrarDetalleDiarios($fecha)
    {
        $id_det_terminado = $this->obtenerId($fecha);
        $report = DB::table('detalle_terminado_diario')
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
         'vitola_productos.vitola', 'capa_productos.capa', 'detalle_terminado_diario.unidades','detalle_terminado_diario.bultos',
         'tipo_empaques.tipo_empaque as tipoempaque', 'detalle_programacion_terminado.orden', 'nombre_productos.nombre',
         DB::raw('(CASE 
                        WHEN clase_productos.sampler = "si" THEN  clase_productos.descripcion_sampler
                        ELSE marca_productos.marca 
                        END) AS marca'))
         ->where('detalle_terminado_diario.id_terminado_diario', '=', $id_det_terminado)
        ->get();
        return response()->json($report, 200);
    }

    public function Editable($fecha){
        $response = DB::table('diariosterminado')
        ->where('fecha', '=', $fecha)
        ->where('procesado', '!=', 1)->first();
        return response()->json($response, 200);
    }

    public function consultarProceso(){
        $response = DB::table('diariosterminado')
        ->where('procesado', '!=', 1)->first();
        return response()->json($response, 200);
    }

    public function guardaregistrodiario(Request $request){
        $fecha = Carbon::parse($request->fecha)->format('Y-m-d');
        $validacion = DB::table('diariosterminado')
        ->where('procesado', '!=', 1)->first();

        $response = DB::table('diariosterminado')
        ->where('fecha', '=', $fecha)->first();

        if($response==null && $validacion==null){
        $guardar = new ReporteDiario();
        $guardar->fecha = $fecha;
        $guardar->observacion = "Registro generado desde la app";
        $guardar->save();
        return response()->json($guardar, 200);
        }else{
            return response()->json($guardar, 1);
        }
    }


    public function store(Request $request)
    {
        $fecha = DB::table('diariosterminado')->where('procesado', '!=', 1)->first();
        $id = $this->obtenerId($fecha->fecha);
        $detalle_terminado_diario = new detalle_terminado_diario();
        $detalle_terminado_diario->id_det_progra_term = $request->id_det_progra_term;
        $detalle_terminado_diario->id_terminado_diario = $id;
        $detalle_terminado_diario->cantidad = $request->cantidad;
        $detalle_terminado_diario->bultos = $request->bultos;
        $detalle_terminado_diario->unidades = $request->unidades;
        $detalle_terminado_diario->save();
        return response()->json($detalle_terminado_diario);

    }

    public function Scan($id)
    {
        $res = DB::table('detalle_programacion_terminado')
        ->join('pendiente_empaque', 'pendiente_empaque.id_pendiente', '=', 'detalle_programacion_terminado.id_pendiente')
        ->join('marca_productos', 'marca_productos.id_marca', '=', 'pendiente_empaque.marca')
        ->join('vitola_productos', 'vitola_productos.id_vitola', '=', 'pendiente_empaque.vitola')
        ->join('tipo_empaques', 'tipo_empaques.id_tipo_empaque', 'pendiente_empaque.tipo_empaque')
        ->join('capa_productos', 'capa_productos.id_capa', 'pendiente_empaque.capa')
        ->join('clase_productos', 'clase_productos.item', 'pendiente_empaque.item')
        ->select('detalle_programacion_terminado.id','pendiente_empaque.item', 'detalle_programacion_terminado.orden',
         'detalle_programacion_terminado.numero_orden', 
         'vitola_productos.vitola', 'capa_productos.capa', 
         'tipo_empaques.tipo_empaque as tipoempaque', 'clase_productos.cantidad_bulto as bultos',
         DB::raw('(CASE 
                        WHEN clase_productos.sampler = "si" THEN  clase_productos.descripcion_sampler
                        ELSE marca_productos.marca 
                        END) AS marca'))
         ->where('detalle_programacion_terminado.id', '=', $id)
        ->first();
        return response()->json($res,200);
    }

    public function inventarioempaque(Request $request){
        $marca = $request->marca;
        if($marca == null){
            $existencias = DB::select('call existencia_empaque(:Pa_marca)',
        [
            ':Pa_marca' => ''
        ]);
        }
        else{
        $existencias = DB::select('call existencia_empaque(:Pa_marca)',
        [
            ':Pa_marca' => $marca
        ]);
    }
        return response()->json(collect($existencias),200);

    }

    public function inventarioempaquetotal(Request $request){
        $marca = $request->marca;
        $existencias = DB::select('call existencia_empaque(:Pa_marca)',
        [
            ':Pa_marca' => ''
        ]);
        $res = ['cantidad'=>collect($existencias)->sum('cantidad')];

        return response()->json($res, 200);

    }

    public function destroy($id)
    {
        $report = DB::table('detalle_terminado_diario')
        ->join('detalle_programacion_terminado', 'detalle_programacion_terminado.id', 
        'detalle_terminado_diario.id_det_progra_term')
        ->join('pendiente_empaque', 'pendiente_empaque.id_pendiente', '=', 'detalle_programacion_terminado.id_pendiente')
        ->join('marca_productos', 'marca_productos.id_marca', '=', 'pendiente_empaque.marca')
        ->join('vitola_productos', 'vitola_productos.id_vitola', '=', 'pendiente_empaque.vitola')
        ->join('tipo_empaques', 'tipo_empaques.id_tipo_empaque', 'pendiente_empaque.tipo_empaque')
        ->join('capa_productos', 'capa_productos.id_capa', 'pendiente_empaque.capa')
        ->join('clase_productos', 'clase_productos.item', 'pendiente_empaque.item')
        ->select('detalle_terminado_diario.id as detid', 'detalle_programacion_terminado.id','pendiente_empaque.item', 'detalle_programacion_terminado.orden',
         'detalle_programacion_terminado.numero_orden', 'detalle_terminado_diario.cantidad',
         'vitola_productos.vitola', 'capa_productos.capa', 
         'tipo_empaques.tipo_empaque as tipoempaque',
         DB::raw('(CASE 
                        WHEN clase_productos.sampler = "si" THEN  clase_productos.descripcion_sampler
                        ELSE marca_productos.marca 
                        END) AS marca'))
        ->first();
        $delete = DB::table('detalle_terminado_diario')->where('id', '=', $id)->delete();
        return response()->json($report, 200);
    }

    function validarFecha($fecha){
        $res = DB::table('diariosterminado')
        ->where('fecha', '=', $fecha)->get();
        return count($res)>0 ? false : true;
    }

    function obtenerId($fecha){
        $res = DB::table('diariosterminado')
        ->where('fecha', '=', $fecha)->first();
        return $res->id;
    }
}
