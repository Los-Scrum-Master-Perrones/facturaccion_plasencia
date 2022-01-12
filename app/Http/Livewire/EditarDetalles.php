<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\FacadesDB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditarDetalles extends Component
{
    public $detalles;

    public $capas;
    public $marcas;
    public $nombres;
    public $vitolas;
    public $tipo_empaques;
    public $busqueda = "";


    public function render()
    {
        $this->capas = DB::select('call buscar_capa("")');
        $this->marcas = DB::select('call buscar_marca("")');
        $this->nombres = DB::select('call buscar_nombre("")');
        $this->vitolas = DB::select('call buscar_vitola("")');
        $this->tipo_empaques = DB::select('call buscar_tipo_empaque("")');

        $this->detalles = DB::select( 'call mostrar_detalle_clase_productos(:todo)', ['todo' => $this->busqueda]);

        return view('livewire.editar-detalles')->extends('principal')->section('content');
    }

    public function mount()
    {


        $this->busqueda = "";

        $this->capas = DB::select('call buscar_capa("")');
        $this->marcas = DB::select('call buscar_marca("")');
        $this->nombres = DB::select('call buscar_nombre("")');
        $this->vitolas = DB::select('call buscar_vitola("")');
        $this->tipo_empaques = DB::select('call buscar_tipo_empaque("")');
    }

    public function actualizar_detalle_producto(Request $request)
    {

        if (isset($request->cello_ac)) {

            $cello = $request->cello_ac;
        } else {
            $cello = "no";
        }

        if (isset($request->anillo_ac)) {
            $anillo = $request->anillo_ac;
        } else {
            $anillo = "no";
        }

        if (isset($request->upc_ac)) {
            $upc = $request->upc_ac;
        } else {
            $upc = "no";
        }



        if (isset($request->cod_sistema_ac)) {
            $cod_sistema_ac = $request->cod_sistema_ac;
        } else {
            $cod_sistema_ac = "";
        }

        if (isset($request->precio)) {
            $precio = $request->precio;
        } else {
            $precio = "0";
        }


$id_emp = DB::select('SELECT id_tipo_empaque FROM tipo_empaques WHERE tipo_empaque = ?',[$request->tipo_ac]);


        $clase_producto = DB::select(
            'call actualizar_detalles_productos(:id,:cod_producto,:cod_precio,:precio,:capa,:vitola,:nombre,:marca,:cello,:anillo,:upc,:tipo)',
            [
                'id' => $request->id_producto,
                'cod_producto' => $cod_sistema_ac,
                'cod_precio' => $request->cod_precio_ac,
                'precio' => $precio,
                'capa' =>  $request->capa_ac,
                'vitola' => $request->vitola_ac,
                'nombre' => $request->nombre_ac,
                'marca' => $request->marca_ac,
                'cello' => $cello,
                'anillo' => $anillo,
                'upc' => $upc,
                'tipo' => $id_emp[0]->id_tipo_empaque
            ]
        );

        $this->capas = DB::select('call buscar_capa("")');
        $this->marcas = DB::select('call buscar_marca("")');
        $this->nombres = DB::select('call buscar_nombre("")');
        $this->vitolas = DB::select('call buscar_vitola("")');
        $this->tipo_empaques = DB::select('call buscar_tipo_empaque("")');

        $this->detalles = DB::select( 'call mostrar_detalle_clase_productos(:todo)', ['todo' => $this->busqueda]);

        return redirect()->route('editarDetalles');
    }

}
