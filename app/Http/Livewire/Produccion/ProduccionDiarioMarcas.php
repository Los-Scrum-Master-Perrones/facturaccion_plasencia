<?php

namespace App\Http\Livewire\Produccion;

use App\Exports\ProduccionModulosEmpleadoExport;
use App\Models\ProduccionDiarioModulos;
use App\Models\ProduccionDiarioProducir;
use Illuminate\Support\Facades\DB;
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

    public function render()
    {
        $pendiente_catalogo = DB::select('CALL `buscar_produccion_empleado_planificacion_marcas`()');
        $this->modulo_empleado = DB::select('CALL `buscar_produccion_modulos_empleados`(?)', [$this->modulo_actual]);
        $this->modulos = DB::select('CALL `buscar_produccion_empleado_planificacion_modulos`()');

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




        return view(
            'livewire.produccion.produccion-diario-marcas',
            [
                'roleros' => $roleros,
                'boncheros' => $boncheros,
                'revisador' => $revisador,
                'pendiente_catalogo' => $pendiente_catalogo,
            ]
        )->extends('layouts.produccion.produccion-menu')->section('contenido');
    }

    public function cambiar_modulo($id)
    {
        $this->modulo_actual = $id;
    }

    public function eliminar_detalle(ProduccionDiarioProducir $mod, $num)
    {
        if ($num == 1) {
            $mod->id_empleado = null;
        } elseif ($num == 2) {
            $mod->id_empleado2 = null;
        } elseif ($num == 3) {
            $mod->id_produccion_orden = null;
            $mod->moldes_para_uso = null;
            $mod->moldes_sobrantes = null;
            $mod->moldes_ids = null;
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
            $moldes = DB::select(
                'CALL `buscar_produccion_moldes_inventario`()'
            );

            $usosMoldes = [];
            foreach ($moldes as $uso) {
                if ($uso->figuraTipo == 'TORPEDO') {
                    $usosMoldes[$uso->ring . $uso->figuraTipo][] =  $uso;
                } else if ($uso->figuraTipo == 'TORPEDO HAB.') {
                    $usosMoldes[$uso->ring . $uso->figuraTipo][] =  $uso;
                } else {
                    $usosMoldes[$uso->ring][] =  $uso;
                }
            }
            $detalles = DB::select('CALL `buscar_produccion_empleado_planificacion_pendiente`()');

            foreach ($detalles as $detal) {
                try {
                    //code...

                $moldes_necesarios = 35;
                $moldes_necesarios2 = 35;
                $moldes_en_existencia = 0;
                $moldes = [];
                if ($detal->marca == 'The Edge Nicaragua' && $detal->nombre == 'Torpedo') {

                    foreach ($usosMoldes[$detal->ring_real . 'TORPEDO HAB.'] as $key => $value) {
                        $moldes[] = $value;
                        $moldes_necesarios2 -= $value->buenos;
                        $value->buenos -= $moldes_necesarios;

                        if ($value->buenos <= 0) {
                            $value->buenos = 0;
                        }

                        if ($moldes_necesarios2 <= 0) {
                            $moldes_necesarios2 = 0;
                        }

                        $moldes_en_existencia+=$value->buenos;

                    }

                    ProduccionDiarioProducir::where('id',$detal->id_producir)
                                            ->update(['moldes_para_uso' => $moldes_necesarios-$moldes_necesarios2,
                                                      'moldes_sobrantes' => $moldes_en_existencia,
                                                      'moldes_ids' => json_encode($moldes)]);

                }

                $moldes = [];
                if ($detal->marca != 'The Edge Nicaragua' && $detal->nombre == 'Torpedo') {

                    foreach ($usosMoldes[$detal->ring_real . 'TORPEDO'] as $key => $value) {
                        $moldes[] = $value;
                        $moldes_necesarios2 -= $value->buenos;
                        $value->buenos -= $moldes_necesarios;

                        if ($value->buenos <= 0) {
                            $value->buenos = 0;
                        }

                        if ($moldes_necesarios2 <= 0) {
                            $moldes_necesarios2 = 0;
                        }
                        $moldes_en_existencia+=$value->buenos;

                    }

                    ProduccionDiarioProducir::where('id',$detal->id_producir)
                                            ->update(['moldes_para_uso' => $moldes_necesarios-$moldes_necesarios2,
                                                      'moldes_sobrantes' => $moldes_en_existencia,
                                                      'moldes_ids' => json_encode($moldes)]);
                }

                $moldes = [];
                if ($detal->marca != 'The Edge Nicaragua' && $detal->nombre != 'Torpedo') {

                    foreach ($usosMoldes[$detal->ring_real] as $key => $value) {
                        $moldes[] = $value;
                        if ($value->tamanio >= intval($detal->tamanio)) {
                            $moldes_necesarios2 -= $value->buenos;
                            $value->buenos -= $moldes_necesarios;

                            if ($value->buenos <= 0) {
                                $value->buenos = 0;
                            }

                            if ($moldes_necesarios2 <= 0) {
                                $moldes_necesarios2 = 0;
                            }
                        }
                        $moldes_en_existencia+=$value->buenos;

                    }


                    ProduccionDiarioProducir::where('id',$detal->id_producir)
                                            ->update(['moldes_para_uso' => $moldes_necesarios-$moldes_necesarios2,
                                                      'moldes_sobrantes' => $moldes_en_existencia,
                                                      'moldes_ids' => json_encode($moldes)]);
                }

                } catch (\Exception $th) {
                    $this->dispatchBrowserEvent('error_general', ['errorr' => json_encode($moldes), 'icon' => 'info']);
                }
            }


        }
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
}
