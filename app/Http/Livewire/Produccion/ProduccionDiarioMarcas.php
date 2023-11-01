<?php

namespace App\Http\Livewire\Produccion;

use App\Models\ProduccionDiarioModulos;
use App\Models\ProduccionDiarioProducir;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

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
        $this->modulo_empleado = DB::select('CALL `buscar_produccion_modulos_empleados`(?)',[$this->modulo_actual]);
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
            if($uso->rol == 'bonchero'){
                $boncheros['boncheros'][] =  $uso;
            }
            if($uso->rol == 'revisador'){
                $revisador['revisador'][] =  $uso;
            }
            if($uso->rol == 'brocha'){
                $brocha['brocha'][] =  $uso;
            }
        }


        return view('livewire.produccion.produccion-diario-marcas',
        [
            'roleros' => $roleros,
            'boncheros' => $boncheros,
            'revisador' => $revisador,
            'pendiente_catalogo' => $pendiente_catalogo
        ]
        )->extends('layouts.produccion.produccion-menu')->section('contenido');
    }

    public function cambiar_modulo($id) {
        $this->modulo_actual = $id;
    }

    public function eliminar_detalle(ProduccionDiarioProducir $mod,$num) {
        if ($num == 1) {
            $mod->id_empleado = null;
        }elseif($num ==2){
            $mod->id_empleado2 = null;
        }elseif($num == 3){
            $mod->id_produccion_orden = null;
        }
        $mod->save();
    }

    public function agregar_detalle(ProduccionDiarioProducir $mod,$num,$id) {
        if ($num == 1) {
            $mod->id_empleado = $id;
        }elseif($num ==2){
            $mod->id_empleado2 = $id;
        }elseif($num ==3){
            $mod->id_produccion_orden = $id;
        }
        $mod->save();
    }
    public function nueva_tupla_detalle($num,$id) {
        $mod = new ProduccionDiarioProducir;
        $mod->modulo = $this->modulo_actual;
        if ($num == 1) {
            $mod->id_empleado = $id;
        }elseif($num ==2){
            $mod->id_empleado2 = $id;
        }
        $mod->save();
    }

    public function nueva_tareas(ProduccionDiarioProducir $mod,$id) {
        if ($id > 0) {
            $mod->tareas = $id;
        }else {
            $mod->tareas = 0;
        }
        $mod->save();
    }





    public function agregar_nuevo_modulo() {
        $numero_modulos = ProduccionDiarioModulos::all()->count();
        $numero_modulos+=1;
        if($numero_modulos < 8){
            $modulo = new ProduccionDiarioModulos();
            $modulo->nombre = 'Modulo '.$numero_modulos;
            $modulo->save();
        }

    }

    public function agregar_revisador_modulo(ProduccionDiarioModulos $modulo,$id,$num) {
        if ($num == 1) {
            $modulo->id_revisador1 = $id;
        }elseif($num ==2){
            $modulo->id_revisador2 = $id;
        }
        $modulo->save();
    }

    public function eliminar_revisador_modulo(ProduccionDiarioModulos $modulo,$num) {
        if ($num == 1) {
            $modulo->id_revisador1 = null;
        }elseif($num ==2){
            $modulo->id_revisador2 = null;
        }
        $modulo->save();
    }

    public function imprimir_reporte(){

        return Excel::download(new ProduccionEmpleadoExport(collect($da)), 'Empleados.xlsx');

    }



}

