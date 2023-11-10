<?php

namespace App\Http\Livewire\Produccion;

use App\Exports\ProduccionModulosEmpleadoExport;
use App\Models\ProduccionDiarioModulos;
use App\Models\ProduccionDiarioProducir;
use App\Models\ProduccionMolde;
use App\Models\ProduccionMoldeDiario;
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
        foreach ($moldes as $uso) {
            $usosMoldes[$uso->ring][] =  $uso;
        }


        $apratado_moldes = ProduccionMoldeDiario::all();
        $apartdoMoldes = [];
        foreach ($apratado_moldes as $uso) {
            $apartdoMoldes[$uso->id_produccion_diario][$uso->id_molde][] =  $uso;
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
            //$this->actualizar_asignacion_moldes();
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

    public function actualizar_moldes_usar($cantidad)
    {
        DB::update('update produccion_diario_producir set moldes_a_usar = ?', [$cantidad]);
        //$this->actualizar_asignacion_moldes();
    }



    public function asignare_molde($id,ProduccionDiarioProducir $modulo,$id_collapse)
    {
        $moldes_existencia = DB::select('call buscar_produccion_moldes_inventario(?)',[$id])[0];
        $check = 0;
        $moldesss =  ProduccionMoldeDiario::where('id_produccion_diario','=',$modulo->id)->where('id_molde','=',$id)->first();



        if(!$moldesss){
            $moldesss = ProduccionMoldeDiario::updateOrCreate(
                ['id_produccion_diario' => $modulo->id, 'id_molde' => $id],
                ['cantidad' =>0 , 'check' => $check]
            );

            $moldesss->save();
        }

        $molde_necesario = $modulo->moldes_para_uso - $modulo->moldes_a_usar;
        if($molde_necesario == 0){
            $modulo->moldes_para_uso -= $moldesss->cantidad;
            $moldesss->cantidad = 0;
            $moldesss->check = 0;

            $modulo->save();
            $moldesss->save();
            return;
        }

        if($moldesss->check == 0){
            if($modulo->moldes_para_uso > 0 && ($modulo->moldes_para_uso+$moldes_existencia->buenos) < $modulo->moldes_a_usar){
                $moldesss->cantidad = $moldes_existencia->buenos;
                $modulo->moldes_para_uso += $moldes_existencia->buenos;
            }

            if($modulo->moldes_para_uso > 0 && ($modulo->moldes_para_uso+$moldes_existencia->buenos) > $modulo->moldes_a_usar){
                $moldesss->cantidad = $modulo->moldes_a_usar - $modulo->moldes_para_uso;
                $modulo->moldes_para_uso +=  $modulo->moldes_a_usar - $modulo->moldes_para_uso;
            }

            if($modulo->moldes_para_uso == 0 && $moldes_existencia->buenos < $modulo->moldes_a_usar ){
                $moldesss->cantidad = $moldes_existencia->buenos;
                $modulo->moldes_para_uso += $moldes_existencia->buenos;
            }

            if($modulo->moldes_para_uso == 0 && $moldes_existencia->buenos > $modulo->moldes_a_usar ){
                $moldesss->cantidad = $modulo->moldes_a_usar;
                $modulo->moldes_para_uso = $modulo->moldes_a_usar;
            }
            $moldesss->check = 1;
        }else{
            $modulo->moldes_para_uso -= $moldesss->cantidad;
            $moldesss->cantidad = 0;
            $moldesss->check = 0;
        }



        if($moldesss->cantidad < 0){
            $moldesss->cantidad = 0;
        }
        $modulo->save();
        $moldesss->save();

        $this->dispatchBrowserEvent('abrirOpciones',['id' => $id_collapse]);

    }

}
