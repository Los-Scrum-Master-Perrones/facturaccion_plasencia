<?php

namespace App\Http\Livewire\Produccion;

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
        foreach ($this->empleados as $uso) {
            if ($uso->rol == 'rolero') {
                $roleros['roleros'][] =  $uso;
            } else {

                $boncheros['boncheros'][] =  $uso;
            }
        }


        return view('livewire.produccion.produccion-diario-marcas',
        [
            'roleros' => $roleros,
            'boncheros' => $boncheros,
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
}

