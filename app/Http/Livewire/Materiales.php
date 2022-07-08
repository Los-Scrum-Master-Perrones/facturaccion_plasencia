<?php

namespace App\Http\Livewire;

use App\Models\MaterialesCatalogo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Materiales extends Component
{
    public $materiales = [];
    //busquedas
    public $items_factory = [];
    public $items_navisor = [];
    public $items_codigo = [];
    public $items_codigo_existentes = [];
    public $descripcion = [];
    public $brand = [];

    public $factory = "";
    public $navisor = "";
    public $codigo ="";
    public $descrip = "";
    public $br = "";
    public $factoryItemUltimo = "";

    public $tuplas_conteo;
    public $todos;
    public $paginacion;

    public function render()
    {
        $this->factoryItemUltimo = DB::select('SELECT MAX(materiales_catalogo.factory_item) AS "ultimo_item"
                                               FROM materiales_catalogo')[0]->ultimo_item;
        $da = DB::select('CALL `mostrar_materiales`(?, ?, ?, ?, ?,-1)',
                            [$this->factory,
                            $this->navisor,
                            $this->codigo,
                            $this->br,
                            $this->descrip]);

        $this->tuplas_conteo = count($da);

        $this->items_codigo_existentes = DB::select('SELECT DISTINCT codigo_material,des_material FROM materiales_productos');

        if ($this->todos == 1) {
            $this->materiales = DB::select('CALL `mostrar_materiales`(?, ?, ?, ?, ?,-1)',
                                            [$this->factory,
                                            $this->navisor,
                                            $this->codigo,
                                            $this->br,
                                            $this->descrip]);
        } else {
            $this->materiales = DB::select('CALL `mostrar_materiales`(?, ?, ?, ?, ?, ?)',
                                            [$this->factory,
                                            $this->navisor,
                                            $this->codigo,
                                            $this->br,
                                            $this->descrip,
                                            $this->paginacion
                                        ]);
        }

        if(count($da) > 0){

            $this->items_factory = [];
            $this->items_navisor = [];
            $this->items_codigo = [];
            $this->descripcion = [];
            $this->brand = [];

            foreach($da as $detalles){
                array_push($this->items_factory,$detalles->factory_item);
                array_push($this->items_navisor,$detalles->navision_item);
                array_push($this->items_codigo,$detalles->codigo_material);
                array_push($this->descripcion,$detalles->item_description);
                array_push($this->brand,$detalles->brand);
            }

            $this->items_factory = array_unique($this->items_factory);
            $this->items_navisor = array_unique($this->items_navisor);
            $this->items_codigo = array_unique($this->items_codigo);
            $this->descripcion = array_unique($this->descripcion);
            $this->brand = array_unique($this->brand);
        }

        $this->dispatchBrowserEvent('tamanio_tabla');

        return view('livewire.Materiales.materiales')->extends('principal')->section('content');
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

    public function eliminar_material($id)
    {
        DB::delete('delete from materiales_catalogo where id = ?', [$id]);

        $this->dispatchBrowserEvent('eliminacion_exitoso');
    }



public function insertar_material($request)
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
            'call insertar_materiales(:pa_navision_item,
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
        $this->dispatchBrowserEvent('insercion_exitoso');
    } else {
        $this->dispatchBrowserEvent('insercion_falta', ['mensaje' => $validator->errors()->all()]);
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
