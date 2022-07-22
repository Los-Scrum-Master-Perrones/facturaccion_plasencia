<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InventarioCajas extends Component
{

    public $listacajas;
    public $busqueda;

    public function render()
    {
        $this->listacajas = DB::select('call buscar_listadecajas(:nombre)',[
            'nombre'=>$this->busqueda
        ]);
        $this->dispatchBrowserEvent('tamanio_tabla');

        return view('livewire.inventario-cajas')->extends('principal')->section('content');
    }

    public function mount(){

        $this->listacajas = [];
        $this->busqueda = "";
        $this->listacajas = DB::table('call mostrar_cajas');

    }


    //Entradas Salidas entrdas_errornea

    public function materiales_traspaso($request)
    {
        $validator = Validator::make(
            [
                'pa_id' => $request['pa_id'],
                'pa_cantidad' => $request['pa_cantidad'],
                'pa_fecha' => $request['pa_fecha'],
                'pa_tipo' => $request['pa_tipo']
            ],
            [
                'pa_id' => "required|",
                'pa_cantidad' => "required|numeric",
                'pa_fecha' => "required|date",
                'pa_tipo' => "required"
            ],
            [
                'pa_id.required' => "El ID es necesaria.",
                'pa_cantidad.required' => "La cantidad es necesaria.",
                'pa_cantidad.numeric' => "La cantidad traspasada debe ser un numero.",
                'pa_fecha.required' => "La fecha es requerida.",
                'pa_fecha.date' => "Debe ingresar una fecha real.",
                'pa_tipo.required' => "El tipo de traslado es requerido."
            ]
        );

        if (!$validator->fails()) {

            if($request['pa_tipo']=="Mal Estado"){
                DB::select(
                    'call actualizar_cajas_trasladar_danados(:pa_cantidad,
                                                                :pa_id)',
                    [
                        'pa_cantidad' => $request['pa_cantidad'],
                        'pa_id' => $request['pa_id']
                    ]
                );

                DB::select(
                    'call 01_entradas_salidas_registrar(:pa_codigo,
                                :pa_fecha,
                                :pa_cantidad,
                                :pa_tipo,
                                :pa_descripcion,
                                :pa_usuario,
                                :pa_id_material)',
                    [
                        'pa_codigo' => $request['pa_codigo'],
                        'pa_fecha' => $request['pa_fecha'],
                        'pa_cantidad' => intval($request['pa_cantidad']) * (-1),
                        'pa_tipo' => 'Salida Mal Estado Cajas',
                        'pa_descripcion' => 'Cajas Dañadas',
                        'pa_usuario' => Auth::user()->id,
                        'pa_id_material' => $request['pa_id']
                    ]
                );
            }


            if($request['pa_tipo']=="Faltante"){
                DB::select(
                    'call actualizar_cajas_trasladar_faltante(:pa_cantidad,
                                                                :pa_id)',
                    [
                        'pa_cantidad' => ($request['pa_cantidad'])*(-1),
                        'pa_id' => $request['pa_id']
                    ]
                );

                DB::select(
                    'call 01_entradas_salidas_registrar(:pa_codigo,
                                :pa_fecha,
                                :pa_cantidad,
                                :pa_tipo,
                                :pa_descripcion,
                                :pa_usuario,
                                :pa_id_material)',
                    [
                        'pa_codigo' => $request['pa_codigo'],
                        'pa_fecha' => $request['pa_fecha'],
                        'pa_cantidad' => intval($request['pa_cantidad']) * (-1),
                        'pa_tipo' => 'Salida Faltante Cajas',
                        'pa_descripcion' => 'Salida porque cajas en fisico no existe',
                        'pa_usuario' => Auth::user()->id,
                        'pa_id_material' => $request['pa_id']
                    ]
                );
            }

            $this->dispatchBrowserEvent('entrada_exitoso');
        } else {
            $this->dispatchBrowserEvent('entrdas_errornea', ['mensaje' => $validator->errors()->all()]);
        }
    }

    public function materiales_entrada($request)
    {
        $validator = Validator::make(
            [
                'pa_id' => $request['pa_id'],
                'pa_cantidad' => $request['pa_cantidad'],
                'pa_fecha' => $request['pa_fecha'],
                'pa_tipo' => $request['pa_tipo']
            ],
            [
                'pa_id' => "required|",
                'pa_cantidad' => "required|numeric",
                'pa_fecha' => "required|date",
                'pa_tipo' => "required"
            ],
            [
                'pa_id.required' => "El ID es necesaria.",
                'pa_cantidad.required' => "La cantidad es necesaria.",
                'pa_cantidad.numeric' => "La cantidad traspasada debe ser un numero.",
                'pa_fecha.required' => "La fecha es requerida.",
                'pa_fecha.date' => "Debe ingresar una fecha real.",
                'pa_tipo.required' => "El tipo de traslado es requerido."
            ]
        );

        if (!$validator->fails()) {


        if($request['pa_tipo']=="Entrada Normal Cajas"){
            DB::select(
                'call actualizar_cajas_trasladar_faltante(:pa_cantidad,
                                                          :pa_id)',
                [
                    'pa_cantidad' => intval($request['pa_cantidad'])*(-1),
                    'pa_id' => $request['pa_id']
                ]
            );

            DB::select(
                'call 01_entradas_salidas_registrar(:pa_codigo,
                            :pa_fecha,
                            :pa_cantidad,
                            :pa_tipo,
                            :pa_descripcion,
                            :pa_usuario,
                            :pa_id_material)',
                [
                    'pa_codigo' => $request['pa_codigo'],
                    'pa_fecha' => $request['pa_fecha'],
                    'pa_cantidad' => intval($request['pa_cantidad']),
                    'pa_tipo' => $request['pa_tipo'],
                    'pa_descripcion' => $request['pa_descripcion'],
                    'pa_usuario' => Auth::user()->id,
                    'pa_id_material' => $request['pa_id']
                ]
            );
        }


        if($request['pa_tipo']=="Mal Estado Cajas"){
            DB::select(
                'call actualizar_cajas_trasladar_danados(:pa_cantidad,
                                                            :pa_id)',
                [
                    'pa_cantidad' => $request['pa_cantidad'],
                    'pa_id' => $request['pa_id']
                ]
            );

            DB::select(
                'call 01_entradas_salidas_registrar(:pa_codigo,
                            :pa_fecha,
                            :pa_cantidad,
                            :pa_tipo,
                            :pa_descripcion,
                            :pa_usuario,
                            :pa_id_material)',
                [
                    'pa_codigo' => $request['pa_codigo'],
                    'pa_fecha' => $request['pa_fecha'],
                    'pa_cantidad' => intval($request['pa_cantidad']) * (-1),
                    'pa_tipo' => 'Entrada Renovar Cajas',
                    'pa_descripcion' => 'Renovar Cajas Dañado',
                    'pa_usuario' => Auth::user()->id,
                    'pa_id_material' => $request['pa_id']
                ]
            );
        }

        $this->dispatchBrowserEvent('entrada_exitoso');
        } else {
            $this->dispatchBrowserEvent('entrdas_errornea', ['mensaje' => $validator->errors()->all()]);
        }

    }

    public function materiales_salida($request)
    {
        $validator = Validator::make(
            [
                'pa_id' => $request['pa_id'],
                'pa_cantidad' => $request['pa_cantidad'],
                'pa_fecha' => $request['pa_fecha'],
                'pa_tipo' => $request['pa_tipo']
            ],
            [
                'pa_id' => "required|",
                'pa_cantidad' => "required|numeric",
                'pa_fecha' => "required|date",
                'pa_tipo' => "required"
            ],
            [
                'pa_id.required' => "El ID es necesaria.",
                'pa_cantidad.required' => "La cantidad es necesaria.",
                'pa_cantidad.numeric' => "La cantidad traspasada debe ser un numero.",
                'pa_fecha.required' => "La fecha es requerida.",
                'pa_fecha.date' => "Debe ingresar una fecha real.",
                'pa_tipo.required' => "El tipo de traslado es requerido."
            ]
        );

        if (!$validator->fails()) {

            DB::select(
                'call actualizar_cajas_salida(:pa_cantidad,
                                                          :pa_id,:pa_descripcion)',
                [
                    'pa_cantidad' => $request['pa_cantidad'],
                    'pa_id' => $request['pa_id'],
                    'pa_descripcion' => $request['pa_tipo']
                ]
            );

            DB::select(
                'call 01_entradas_salidas_registrar(:pa_codigo,
                                                           :pa_fecha,
                                                           :pa_cantidad,
                                                           :pa_tipo,
                                                           :pa_descripcion,
                                                           :pa_usuario,
                                                           :pa_id_material)',
                [
                    'pa_codigo' => $request['pa_codigo'],
                    'pa_fecha' => $request['pa_fecha'],
                    'pa_cantidad' => $request['pa_cantidad'],
                    'pa_tipo' => 'Salida Caja',
                    'pa_descripcion' => $request['pa_descripcion'],
                    'pa_usuario' => Auth::user()->id,
                    'pa_id_material' => $request['pa_id']
                ]
            );

            $this->dispatchBrowserEvent('entrada_exitoso');
        } else {
            $this->dispatchBrowserEvent('entrdas_errornea', ['mensaje' => $validator->errors()->all()]);
        }


    }
}


