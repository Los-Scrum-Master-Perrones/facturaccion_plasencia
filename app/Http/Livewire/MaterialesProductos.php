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
    public $empaques = [];

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
        $this->empaques = DB::select('SELECT tipo_empaques.id_tipo_empaque,tipo_empaques.tipo_empaque FROM tipo_empaques');
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

    public function eliminar_ficha($id)
    {
        DB::delete('delete from materiales_productos where id = ?', [$id]);

        $this->dispatchBrowserEvent('eliminacion_exitoso');
    }



    public function nuevo_material($request)
    {

        $validator = Validator::make(
            [
                'item' => $request['item'],
                'codigo_producto' => $request['codigo_producto'],
                'tipo_empaque' => $request['tipo_empaque'],
                'codigo_material' => $request['codigo_material'],
                'des_material' => $request['des_material'],
                'cantidad' => $request['cantidad'],
                'uxe' => $request['uxe']
            ],
            [
                'codigo_producto' => "required",
                'tipo_empaque' => "required",
                'codigo_material' => "required",
                'des_material' => "required",
                'cantidad' => "required|integer",
                'uxe' => "required"
            ],
            [
                'codigo_producto.required' => "El codigo producto solicitado es necesaria.",
                'tipo_empaque.required' => "Debe seleccionar un tipo de empque.",
                'codigo_material.required' => "El codigo material solicitado es necesaria.",
                'des_material.required' => "Debe llevar un descripcion del material.",
                'uxe.required' => "Debe ingresar SI o NO en una unidades por empaque.",
                'cantidad.required' => "Debe ingresar la cantidad.",
                'cantidad.integer' => "La cantidad solicitado debe ser un numero entero.",
            ]
        );

        if (!$validator->fails()) {

           DB::select(
                'call insertar_materiales_productos(:pa_item,
                                            :pa_codigo_producto,
                                            :pa_tipo_empaque,
                                            :pa_codigo_material,
                                            :pa_des_material,
                                            :pa_cantidad,
                                            :pa_uxe)',
                [
                    'pa_item' => $request['item'],
                    'pa_codigo_producto' => $request['codigo_producto'],
                    'pa_tipo_empaque' => $request['tipo_empaque'],
                    'pa_codigo_material' => $request['codigo_material'],
                    'pa_des_material' => $request['des_material'],
                    'pa_cantidad' => $request['cantidad'],
                    'pa_uxe' => $request['uxe']
                ]
            );
            $this->dispatchBrowserEvent('insercion_exitoso');
        } else {
            $this->dispatchBrowserEvent('insercion_falta', ['mensaje' => $validator->errors()->all()]);
        }
    }


    public function actualizar_material($request)
    {

        $validator = Validator::make(
            [
                'item' => $request['item'],
                'codigo_producto' => $request['codigo_producto'],
                'tipo_empaque' => $request['tipo_empaque'],
                'codigo_material' => $request['codigo_material'],
                'des_material' => $request['des_material'],
                'cantidad' => $request['cantidad'],
                'uxe' => $request['uxe']
            ],
            [
                'codigo_producto' => "required",
                'tipo_empaque' => "required",
                'codigo_material' => "required",
                'des_material' => "required",
                'cantidad' => "required|integer",
                'uxe' => "required"
            ],
            [
                'codigo_producto.required' => "El codigo producto solicitado es necesaria.",
                'tipo_empaque.required' => "Debe seleccionar un tipo de empque.",
                'codigo_material.required' => "El codigo material solicitado es necesaria.",
                'des_material.required' => "Debe llevar un descripcion del material.",
                'uxe.required' => "Debe ingresar SI o NO en una unidades por empaque.",
                'cantidad.required' => "Debe ingresar la cantidad.",
                'cantidad.integer' => "La cantidad solicitado debe ser un numero entero.",
            ]
        );

        if (!$validator->fails()) {

           DB::select(
                'call actualizar_materiales_productos(:pa_item,
                                            :pa_codigo_producto,
                                            :pa_tipo_empaque,
                                            :pa_codigo_material,
                                            :pa_des_material,
                                            :pa_cantidad,
                                            :pa_uxe,
                                            :pa_id)',
                [
                    'pa_item' => $request['item'],
                    'pa_codigo_producto' => $request['codigo_producto'],
                    'pa_tipo_empaque' => $request['tipo_empaque'],
                    'pa_codigo_material' => $request['codigo_material'],
                    'pa_des_material' => $request['des_material'],
                    'pa_cantidad' => $request['cantidad'],
                    'pa_uxe' => $request['uxe'],
                    'pa_id' => $request['id']
                ]
            );
            $this->dispatchBrowserEvent('actualiza_exitoso');
        } else {
            $this->dispatchBrowserEvent('actualiza_falta', ['mensaje' => $validator->errors()->all()]);
        }
    }
}
