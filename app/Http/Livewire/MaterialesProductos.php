<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class MaterialesProductos extends Component
{
    public $materiales = [];
    //busquedas
    public $items = [];
    public $codigo_productos = [];
    public $codigo_materials = [];
    public $des_materials = [];
    public $tipo_empaques = [];

    public $item = "";
    public $codigo_producto = "";
    public $codigo_material = "";
    public $des_material = "";
    public $tipo_empaque = "";
    public $tuplas_conteo;
    public $todos;
    public $paginacion;


    public function render()
    {



        $da = DB::select(
            'CALL `mostrar_materiales_productos`(?, ?, ?, ?,-1, ?)',
            [
                $this->item,
                $this->codigo_producto,
                $this->codigo_material,
                $this->des_material,
                $this->tipo_empaque
            ]
        );

        $this->tuplas_conteo = count($da);

        $this->codigo_materials_existentes = DB::select('SELECT DISTINCT item FROM clase_productos');

        if ($this->todos == 1) {
            $this->materiales = DB::select(
                'CALL `mostrar_materiales_productos`(?, ?, ?, ?,-1, ?)',
                [
                    $this->item,
                    $this->codigo_producto,
                    $this->codigo_material,
                    $this->des_material,
                    $this->tipo_empaque
                ]
            );
        } else {
            $this->materiales = DB::select(
                'CALL `mostrar_materiales_productos`(?, ?, ?, ?, ?, ?)',
                [
                    $this->item,
                    $this->codigo_producto,
                    $this->codigo_material,
                    $this->des_material,
                    $this->paginacion,
                    $this->tipo_empaque
                ]
            );
        }

        if (count($da) > 0) {

            $this->items = [];
            $this->codigo_productos = [];
            $this->codigo_materials = [];
            $this->des_materials = [];
            $this->tipo_empaques = [];

            foreach ($da as $detalles) {
                array_push($this->items, $detalles->item);
                array_push($this->codigo_productos, $detalles->codigo_producto);
                array_push($this->codigo_materials, $detalles->codigo_material);
                array_push($this->des_materials, $detalles->des_material);
                array_push($this->tipo_empaques, $detalles->tipo_empaque);
            }

            $this->items = array_unique($this->items);
            $this->codigo_productos = array_unique($this->codigo_productos);
            $this->codigo_materials = array_unique($this->codigo_materials);
            $this->des_materials = array_unique($this->des_materials);
            $this->tipo_empaques = array_unique($this->tipo_empaques);
        }

        return view('livewire.Materiales.materiales-productos')->extends('principal')->section('content');
    }
    public function paginacion_numerica($numero)
    {
        $this->paginacion = $numero;
        $this->tama();
    }

    public function tama(){
        $this->dispatchBrowserEvent('tamanio_tabla');
    }

    public function mostrar_todo($todo)
    {
        $this->tama();
        $this->todos = $todo;
    }


    public function nuevo_material($request)
    {


        $validator = Validator::make(
            [
                'factoryed' => $request['factoryed'],
                'navisored' => $request['navisored'],
                'desed' => $request['desed'],
                'branded' => $request['branded'],
                'saldo_med' => $request['saldo_med'],
                'saldo_ed' => $request['saldo_ed'],
                'codigoed' => $request['codigoed'],
                'lineaed' => $request['lineaed']
            ],
            [
                'factoryed' => "required",
                'navisored' => "required",
                'desed' => "required",
                'branded' => "required",
                'saldo_med' => "required|integer",
                'saldo_ed' => "required|integer"
            ],
            [
                'factoryed.required' => "La orden del sistema es necesaria.",
                'navisored.required' => "La orden es necesaria.",
                'desed.required' => "El pendiente solicitado es necesaria.",
                'branded.required' => "El saldo solicitado es necesaria.",
                'saldo_med.required' => "Debe ingresar el saldo minimo.",
                'saldo_med.integer' => "El saldo minimo solicitado debe ser un numero entero.",
                'saldo_ed.required' => "Debe ingresar el saldo.",
                'saldo_ed.integer' => "El saldo solicitado debe ser un numero entero.",
            ]
        );

        if (!$validator->fails()) {

           DB::select(
                'call actualizar_materiales(:pa_navision_item,
                                            :pa_codigo_material,
                                            :pa_brand,
                                            :pa_linea,
                                            :pa_item_description,
                                            :pa_saldo_minimo,
                                            :pa_saldo,
                                            :pa_factory_item)',
                [
                    'pa_factory_item' => $request['factoryed'],
                    'pa_navision_item' => $request['navisored'],
                    'pa_item_description' => $request['desed'],
                    'pa_brand' => $request['branded'],
                    'pa_saldo_minimo' => $request['saldo_med'],
                    'pa_saldo' => $request['saldo_ed'],
                    'pa_codigo_material' => $request['codigoed'],
                    'pa_linea' => $request['lineaed']
                ]
            );
            $this->dispatchBrowserEvent('actualiza_exitoso');
        } else {
            $this->dispatchBrowserEvent('actualiza_falta', ['mensaje' => $validator->errors()->all()]);
        }
    }


    public function actualizar_material($request)
    {

        $validator = Validator::make(
            [
                'factoryed' => $request['factoryed'],
                'navisored' => $request['navisored'],
                'desed' => $request['desed'],
                'branded' => $request['branded'],
                'saldo_med' => $request['saldo_med'],
                'saldo_ed' => $request['saldo_ed'],
                'codigoed' => $request['codigoed'],
                'lineaed' => $request['lineaed']
            ],
            [
                'factoryed' => "required",
                'navisored' => "required",
                'desed' => "required",
                'branded' => "required",
                'saldo_med' => "required|integer",
                'saldo_ed' => "required|integer"
            ],
            [
                'factoryed.required' => "La orden del sistema es necesaria.",
                'navisored.required' => "La orden es necesaria.",
                'desed.required' => "El pendiente solicitado es necesaria.",
                'branded.required' => "El saldo solicitado es necesaria.",
                'saldo_med.required' => "Debe ingresar el saldo minimo.",
                'saldo_med.integer' => "El saldo minimo solicitado debe ser un numero entero.",
                'saldo_ed.required' => "Debe ingresar el saldo.",
                'saldo_ed.integer' => "El saldo solicitado debe ser un numero entero.",
            ]
        );

        if (!$validator->fails()) {

           DB::select(
                'call actualizar_materiales(:pa_navision_item,
                                            :pa_codigo_material,
                                            :pa_brand,
                                            :pa_linea,
                                            :pa_item_description,
                                            :pa_saldo_minimo,
                                            :pa_saldo,
                                            :pa_factory_item)',
                [
                    'pa_factory_item' => $request['factoryed'],
                    'pa_navision_item' => $request['navisored'],
                    'pa_item_description' => $request['desed'],
                    'pa_brand' => $request['branded'],
                    'pa_saldo_minimo' => $request['saldo_med'],
                    'pa_saldo' => $request['saldo_ed'],
                    'pa_codigo_material' => $request['codigoed'],
                    'pa_linea' => $request['lineaed']
                ]
            );
            $this->dispatchBrowserEvent('actualiza_exitoso');
        } else {
            $this->dispatchBrowserEvent('actualiza_falta', ['mensaje' => $validator->errors()->all()]);
        }
    }
}
