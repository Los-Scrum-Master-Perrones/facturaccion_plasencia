<?php

namespace App\Http\Livewire\Produccion;

use App\Exports\ProduccionModulosEmpleadoExport;
use App\Exports\ProduccionMoldesRestantesExport;
use App\Exports\ProduccionPlanificacionSemanal;
use App\Models\ProduccionDiarioModulos;
use App\Models\ProduccionDiarioPendienteVineta;
use App\Models\ProduccionDiarioProducir;
use App\Models\ProduccionDiarioProducirGuardados;
use App\Models\ProduccionMoldeDiario;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ProduccionDiarioMarcas extends Component
{
    public $b_codigo = '';
    public $b_rol = '';
    public $b_nombre = '';

    public $empleados = [];
    public $modulo_empleado = [];
    public $modulos = [];
    public $modulo_actual = 1;
    public $nombre_empleado = '';
    public $verempleados = false;


    public function render()
    {
        $pendiente_catalogo = DB::select('CALL `buscar_produccion_empleado_planificacion_marcas`()');
        $this->modulo_empleado = DB::select('CALL `buscar_produccion_modulos_empleados`(?,?,@total_tarea)', [$this->modulo_actual, $this->nombre_empleado]);
        $this->modulos = DB::select('CALL `buscar_produccion_empleado_planificacion_modulos`()');

        $moldes = DB::select(
            'CALL `buscar_produccion_moldes_inventario`(0)'
        );

        $this->empleados = DB::select('CALL `buscar_produccion_empleado_planificacion`(?, ?, ?)', [
            $this->b_codigo,
            $this->b_rol,
            $this->b_nombre,
        ]);

        $roleros = [];
        $boncheros = [];
        $revisador = [];
        $brocha = [];
        foreach ($this->empleados as $uso) {
            if ($uso->rol == 'rolero') {
                $roleros['roleros'][] =  $uso;
            }
            if ($uso->rol == 'bonchero') {
                $boncheros['boncheros'][] =  $uso;
            }
            if ($uso->rol == 'revisador') {
                $revisador['revisador'][] =  $uso;
            }
            if ($uso->rol == 'brocha') {
                $brocha['brocha'][] =  $uso;
            }
        }


        $usosMoldes = [];
        $usosMoldesConID = [];
        foreach ($moldes as $uso) {
            $usosMoldes[$uso->ring][] =  $uso;
            $usosMoldesConID[$uso->id][] =  $uso;
        }


        $apratado_moldes = ProduccionMoldeDiario::all();
        $apartdoMoldes = [];
        foreach ($apratado_moldes as $uso) {
            $apartdoMoldes[$uso->id_produccion_diario][$uso->id_molde][] =  $uso;
        }



        $todas_vinetas = DB::select('SELECT * FROM produccion_diario_pendiente_vinetas');
        $apartdoVinetas = [];
        foreach ($todas_vinetas as $uso) {
            if(is_null($uso->bonchero)){
                $uso->bonchero = "";
            }
            if(is_null($uso->rolero)){
                $uso->rolero = "";
            }
            $apartdoVinetas[$uso->id_produccion_pendiente . $uso->rolero . $uso->bonchero][] =  $uso;
        }


        return view(
            'livewire.produccion.produccion-diario-marcas',
            [
                'roleros' => $roleros,
                'boncheros' => $boncheros,
                'revisador' => $revisador,
                'moldesss' => $moldes,
                'usosMoldes' => $usosMoldes,
                'apartdoMoldes' => $apartdoMoldes,
                'usosMoldesConID' => $usosMoldesConID,
                'pendiente_catalogo' => $pendiente_catalogo,
                'vinetas' => $apartdoVinetas,
                'tareaglobal' => DB::select('SELECT @total_tarea as total_tarea')[0]->total_tarea,
                'emplead' => DB::select('CALL `buscar_produccion_empleado_planificacion_busqueda`()')
            ]
        )->extends('layouts.produccion.produccion-menu')->section('contenido');
    }



    public function cambiar_modulo($id)
    {
        $this->modulo_actual = $id;
        $this->nombre_empleado = '';
    }

    public function ocultar_empleados()
    {
        $this->verempleados = !$this->verempleados;
    }

    public function eliminar_detalle(ProduccionDiarioProducir $mod, $num)
    {
        if ($num == 1) {
            $mod->id_empleado = null;
        } elseif ($num == 2) {
            $mod->id_empleado2 = null;
        } elseif ($num == 3) {
            $mod->id_produccion_orden = null;
            $mod->moldes_para_uso = 0;
            $mod->moldes_sobrantes = 0;
            $mod->moldes_ids = null;
            ProduccionMoldeDiario::where('id_produccion_diario', $mod->id)
                ->update(['cantidad' => 0, 'check' => 0]);
        }
        $mod->save();
    }

    public function agregar_detalle(ProduccionDiarioProducir $mod, $num, $id)
    {
        if ($num == 1) {
            $mod->id_empleado = $id;
        } elseif ($num == 2) {
            $mod->id_empleado2 = $id;
        } elseif ($num == 3) {
            $mod->id_produccion_orden = $id;
        }
        $mod->save();

        if ($num == 3) {
            //$this->actualizar_asignacion_moldes();
        }
    }

    public function agregar_detalle_extra(ProduccionDiarioProducir $mod, $modulo, $id)
    {
        $tupla = ProduccionDiarioProducir::where('modulo', '=', $mod->modulo)
                                            ->whereRaw('(id_produccion_orden is null or id_produccion_orden = 0)')
                                            ->first();

        if(!$tupla){
            $tupla = new ProduccionDiarioProducir();
        }
        $tupla->modulo = $mod->modulo;
        $tupla->id_empleado = $mod->id_empleado;
        $tupla->id_empleado2 = $mod->id_empleado2;
        $tupla->moldes_a_usar = $mod->moldes_a_usar;
        $tupla->moldes_para_uso = 0;
        $tupla->tareas = $mod->tareas;
        $tupla->id_produccion_orden = $id;
        $tupla->moldes_ids = 'extra';
        $tupla->created_at = $mod->created_at;
        $tupla->save();

    }

    public function eliminar_detalle_extra(ProduccionDiarioProducir $mod)
    {
        $mod->delete();
    }

    public function nueva_tupla_detalle($num, $id)
    {
        $mod = new ProduccionDiarioProducir;
        $mod->modulo = $this->modulo_actual;
        if ($num == 1) {
            $mod->id_empleado = $id;
        } elseif ($num == 2) {
            $mod->id_empleado2 = $id;
        }
        $mod->save();
    }

    public function nueva_tareas(ProduccionDiarioProducir $mod, $id)
    {
        if ($id > 0) {
            $mod->tareas = $id;
        } else {
            $mod->tareas = 0;
        }
        $mod->save();
    }


    public function nueva_moldes(ProduccionDiarioProducir $mod, $id)
    {
        if ($id > 0) {
            $mod->moldes_a_usar = $id;
            $mod->moldes_para_uso = 0;
            $mod->moldes_sobrantes = 0;
            $mod->moldes_ids = null;

            ProduccionMoldeDiario::where('id_produccion_diario', $mod->id)
                ->update(['cantidad' => 0, 'check' => 0]);
        } else {
            $mod->moldes_a_usar = 0;
            $mod->moldes_para_uso = 0;
            $mod->moldes_sobrantes = 0;
            $mod->moldes_ids = null;
        }
        $mod->save();
    }

    public function agregar_nuevo_modulo()
    {
        $numero_modulos = ProduccionDiarioModulos::all()->count();
        $numero_modulos += 1;
        if ($numero_modulos < 8) {
            $modulo = new ProduccionDiarioModulos();
            $modulo->nombre = 'Modulo ' . $numero_modulos;
            $modulo->save();
        }
    }

    public function agregar_revisador_modulo(ProduccionDiarioModulos $modulo, $id, $num)
    {
        if ($num == 1) {
            $modulo->id_revisador1 = $id;
        } elseif ($num == 2) {
            $modulo->id_revisador2 = $id;
        }
        $modulo->save();
    }

    public function eliminar_revisador_modulo(ProduccionDiarioModulos $modulo, $num)
    {
        if ($num == 1) {
            $modulo->id_revisador1 = null;
        } elseif ($num == 2) {
            $modulo->id_revisador2 = null;
        }
        $modulo->save();
    }

    public function imprimir_planificacion()
    {
        $modulos = DB::select('call buscar_produccion_empleado_planificacion_modulos()');
        return Excel::download(new ProduccionModulosEmpleadoExport($modulos), 'Reporte diario de marcas a producir.xlsx');
    }

    public function imprimir_moldes_restantes()
    {
        $moldes = DB::select('CALL `buscar_produccion_moldes_inventario`(0)');
        return Excel::download(new ProduccionMoldesRestantesExport($moldes), 'Reporte moldes en uso.xlsx');
    }

    public function imprimir_planificacion_semanal()
    {
        $modulos = DB::select('call reporte_produccion_planificacion_semanal()');
        return Excel::download(new ProduccionPlanificacionSemanal($modulos), 'Reporte semanal a producir.xlsx');
    }


    public function actualizar_moldes_usar($cantidad)
    {
        DB::update('update produccion_diario_producir set moldes_a_usar = ?', [$cantidad]);
        //$this->actualizar_asignacion_moldes();
    }



    public function asignare_molde($id, ProduccionDiarioProducir $modulo, $id_collapse)
    {
        $moldes_existencia = DB::select('call buscar_produccion_moldes_inventario(?)', [$id])[0];
        $check = 0;
        $moldesss =  ProduccionMoldeDiario::where('id_produccion_diario', '=', $modulo->id)->where('id_molde', '=', $id)->first();



        if (!$moldesss) {
            $moldesss = ProduccionMoldeDiario::updateOrCreate(
                ['id_produccion_diario' => $modulo->id, 'id_molde' => $id],
                ['cantidad' => 0, 'check' => $check]
            );

            $moldesss->save();
        }

        $molde_necesario = $modulo->moldes_para_uso - $modulo->moldes_a_usar;
        if ($molde_necesario == 0) {
            $modulo->moldes_para_uso -= $moldesss->cantidad;
            $moldesss->cantidad = 0;
            $moldesss->check = 0;

            $modulo->save();
            $moldesss->save();
            return;
        }

        if ($moldesss->check == 0) {
            if ($modulo->moldes_para_uso > 0 && ($modulo->moldes_para_uso + $moldes_existencia->buenos) <= $modulo->moldes_a_usar) {
                $moldesss->cantidad = $moldes_existencia->buenos;
                $modulo->moldes_para_uso += $moldes_existencia->buenos;
            } elseif ($modulo->moldes_para_uso > 0 && ($modulo->moldes_para_uso + $moldes_existencia->buenos) > $modulo->moldes_a_usar) {
                $moldesss->cantidad = $modulo->moldes_a_usar - $modulo->moldes_para_uso;
                $modulo->moldes_para_uso +=  $modulo->moldes_a_usar - $modulo->moldes_para_uso;
            } elseif ($modulo->moldes_para_uso == 0 && $moldes_existencia->buenos < $modulo->moldes_a_usar) {
                $moldesss->cantidad = $moldes_existencia->buenos;
                $modulo->moldes_para_uso += $moldes_existencia->buenos;
            } elseif ($modulo->moldes_para_uso == 0 && $moldes_existencia->buenos > $modulo->moldes_a_usar) {
                $moldesss->cantidad = $modulo->moldes_a_usar;
                $modulo->moldes_para_uso = $modulo->moldes_a_usar;
            }
            $moldesss->check = 1;
        } else {
            $modulo->moldes_para_uso -= $moldesss->cantidad;
            $moldesss->cantidad = 0;
            $moldesss->check = 0;
        }



        if ($moldesss->cantidad < 0) {
            $moldesss->cantidad = 0;
        }
        $modulo->save();
        $moldesss->save();

        $this->dispatchBrowserEvent('abrirOpciones', ['id' => $id_collapse]);
    }

    public function generar_vinetas()
    {

        try {
            DB::beginTransaction();
            $produccion  = DB::select('call buscar_produccion_vinetas_diario()');
            $produccion_empleados  = DB::select('call buscar_produccion_vinetas_empleado_orden()');
            $datos1  = [];

            foreach ($produccion_empleados as $key => $value) {
                $datos1[$value->id_produccion_orden][] = $value;
            }

            $datos2  = [];
            $conteo = 0;
            foreach ($produccion as $key => $value) {
                $empleados = $datos1[$value->id_produccion_orden];

                $conteo = 0;
                $por_parejas = $value->por_parejas_normal;

                for ($i = 1; $i <= $value->vinetas; $i++) {


                    if (!isset($empleados[$conteo]->id_empleado1)) {
                        $conteo--;
                    }
                    $datos2[] = [
                        "id_produccion_pendiente" => intval($value->id_produccion_orden),
                        "fecha" => Carbon::now()->format('Y-m-d'),
                        "peso" => 0,
                        "rolero" => $empleados[$conteo]->id_empleado1,
                        "bonchero" => $empleados[$conteo]->id_empleado2,
                        "revisador" => $empleados[$conteo]->revisadores,
                        "puros" => 50,
                        "estado" => 'A',
                        "id_modulo" => $empleados[$conteo]->id_modulo,
                    ];
                    if ($value->por_parejas_normal == $i) {
                        $conteo++;
                        $value->por_parejas_normal += $por_parejas;
                    }
                }

                if ($value->pico > 0) {
                    $datos2[] = [
                        "id_produccion_pendiente" => intval($value->id_produccion_orden),
                        "fecha" => Carbon::now()->format('Y-m-d'),
                        "peso" => 0,
                        "rolero" => $empleados[0]->id_empleado1,
                        "bonchero" => $empleados[0]->id_empleado2,
                        "revisador" => $empleados[0]->revisadores,
                        "puros" => $value->pico,
                        "estado" => 'A',
                        "id_modulo" => $empleados[0]->id_modulo,
                    ];
                }
            }


            ProduccionDiarioPendienteVineta::upsert(
                $datos2,
                [],
                []
            );

            $this->dispatchBrowserEvent('error_general', ['errorr' => 'Actualizado con exito', 'icon' => 'info']);
            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function generar_vinetas_pdf(Request $re)
    {

        $vinetas  = DB::select('CALL `buscar_produccion_vinetas_generar`(?,?,?)', [$re->id_orden, $re->id_rolero, $re->id_bonchero]);

        $pdf = Pdf::loadView('Exports.vinetas-export-pdf', ["vinetas" => $vinetas]);
        $pdf->setPaper('legal', 'portrait');

        return $pdf->stream('ejemplo.pdf');
        return $pdf->download('ejemplo.pdf');
    }


    public function vinetas(Request $request, $estado){
        $vinetas  = DB::select('CALL `traer_produccion_vinetas_api_estado`(?,?)', [$estado, $request->marca]);

        return response()->json([
            'data' => $vinetas,
            'estatus' => Response::HTTP_OK,
        ], Response::HTTP_OK);

    }

    public function scanner_vinetas($id){
        $scannervinetas  = DB::select('CALL `traer_produccion_vinetas_api_scannner`(?)', [$id]);

        if (count($scannervinetas) == 1){
            ProduccionDiarioPendienteVineta::where('id', $scannervinetas[0]->id)->update(['estado'=>'E']);
        }

        return response()->json([
            'data' => $scannervinetas,
            'estatus' => Response::HTTP_OK,
        ], Response::HTTP_OK);

    }


    public function scanner_vinetas_aceptar(Request $reques,$id){
        //$scannervinetas  = DB::select('CALL `traer_produccion_vinetas_api_scannner`(?)', [$id]);

        $mensje = [];
        try {
            $validator = Validator::make($reques->all(), [
                'puro' => 'required|integer|min:1',
                'fecha' => 'required|date',
                'peso' => 'required|numeric|min:0.1',
                'bonchero' => 'required|exists:produccion_empleado,codigo',
                'rolero' => 'required|exists:produccion_empleado,codigo',
                'revisador' => 'required|string|regex:/^[0-9\s]+$/',
            ], [
                'puro.required' => 'La cantidad de puros es obligatorio.',
                'puro.integer' => 'La cantidad de puros debe ser un número entero.',
                'puro.min' => 'El valor mínimo para los puros es :min.',
                'fecha.required' => 'La fecha es obligatorio.',
                'fecha.date' => 'La fecha debe ser tener un formato valido.',
                'peso.required' => 'El peso es obligatorio.',
                'peso.numeric' => 'El pesos debe ser un número.',
                'peso.min' => 'El valor mínimo para el peso es de :min.',
                'bonchero.required' => 'El bonchero es obligatorio.',
                'bonchero.exists' => 'El valor proporcionado para el bonchero no existe en la base de datos.',
                'rolero.required' => 'El rolero es obligatorio.',
                'rolero.exists' => 'El valor proporcionado para rolero no existe en la base de datos.',
                'revisador.required' => 'Debe asignar revisadores a esta viñeta.',
                'revisador.string' => 'Los codigos de revisadores debe ser una cadena de texto.',
                'revisador.regex' => 'Los codigos de revisadores debe contener solo números y espacios.',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();

                foreach ($errors as $key => $value) {
                    $mensje[] =$value;
                }

                return response()->json([
                    'data' => $mensje,
                    'estatus' => 500
                ], 500);

            }else{
                DB::beginTransaction();

                $vineta = ProduccionDiarioPendienteVineta::find($id);
                $vineta->peso = $reques->all()['peso'];
                $vineta->fecha = $reques->all()['fecha'];
                $vineta->revisador = $reques->all()['revisador'];
                $vineta->puros = $reques->all()['puro'];
                $vineta->peso = $reques->all()['peso'];
                $vineta->estado = "S";
                $vineta->save();

                $mensje[] = "Se Actualizo, Muy bien por ti";
                DB::commit();
            }

        } catch (\Exception $th) {
            $mensje[] = $th->getMessage();
            DB::rollBack();
        }

        return response()->json([
            'data' => $mensje,
            'estatus' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }


    public function guardar_planificacion(){
        $planificacion = DB::select('call buscar_produccion_modulos_empleados_guardar()');

        $date = CarbonImmutable::now()->locale('es_HN');

        $startOfWeek = $date->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $date->endOfWeek(Carbon::SUNDAY);

        foreach ($planificacion as $key => $value) {
            if(!(is_null($value->id_pendiente) || $value->id_pendiente =='0' )){
                if($value->restantes > 0){
                $detalle = ProduccionDiarioProducirGuardados::where('id_empleado',$value->id_empleado1)
                                            ->where('id_empleado2',$value->id_empleado2)
                                            ->where('id_produccion_orden',$value->id_pendiente)
                                            ->where('inicio_semana',$startOfWeek->format('Y-m-d'))
                                            ->where('fin_semana',$endOfWeek->format('Y-m-d'))->first();

                    if(!$detalle){
                        $plan = new ProduccionDiarioProducirGuardados();
                        $plan->modulo = $value->id_modulo;
                        $plan->id_empleado = $value->id_empleado1;
                        $plan->id_empleado2 = $value->id_empleado2;
                        $plan->id_produccion_orden = $value->id_pendiente;
                        $plan->pendiente =  $value->restantes;
                        $plan->tareas = $value->tareas;
                        $plan->inicio_semana = $startOfWeek->format('Y-m-d');
                        $plan->fin_semana = $endOfWeek->format('Y-m-d');
                        $plan->save();
                    }
                }
            }
        }
    }
}
