<?php

namespace App\Http\Livewire;

use App\Exports\MaterialesCatalogoExport;
use App\Models\MaterialesCatalogo;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Materiales extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

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
    public $codigo = "";
    public $descrip = "";
    public $br = "";
    public $factoryItemUltimo = "";

    public $tuplas_conteo;
    public $todos;
    public $paginacion;

    public $por_pagina = 50;
    public $total = 0;



    public function render()
    {   $start = ($this->page - 1) * $this->por_pagina;



        $this->items_codigo_existentes = DB::select('SELECT DISTINCT codigo_material,des_material FROM materiales_productos');


        $datos_materiales = DB::select(
            'CALL `mostrar_materiales`(?, ?, ?, ?, ?, ?, ?, @salida_total,@salida_ultimo_codigo)',
            [
                $this->factory,
                $this->navisor,
                $this->codigo,
                $this->br,
                $this->descrip,
                $start,
                $this->por_pagina,
            ]
        );


        $this->total = DB::select('SELECT @salida_total AS longitud')[0]->longitud;

        $this->factoryItemUltimo = DB::select('SELECT @salida_ultimo_codigo AS ultimo_codigo')[0]->ultimo_codigo;


        $da = DB::select('CALL `mostrar_materiales_detalles`()');

        if (count($da) > 0) {

            $this->items_factory = [];
            $this->items_navisor = [];
            $this->items_codigo = [];
            $this->descripcion = [];
            $this->brand = [];

            foreach ($da as $detalles) {
                array_push($this->items_factory, $detalles->factory_item);
                array_push($this->items_navisor, $detalles->navision_item);
                array_push($this->items_codigo, $detalles->codigo_material);
                array_push($this->descripcion, $detalles->item_description);
                array_push($this->brand, $detalles->brand);
            }

            $this->items_factory = array_unique($this->items_factory);
            $this->items_navisor = array_unique($this->items_navisor);
            $this->items_codigo = array_unique($this->items_codigo);
            $this->descripcion = array_unique($this->descripcion);
            $this->brand = array_unique($this->brand);
        }




        if (Auth::user()->rol == -2) {
            return view('livewire.Materiales.materiales',[
                'datos_materiales' => new LengthAwarePaginator($datos_materiales,  $this->total , $this->por_pagina)
            ])->extends('layouts.Materiales.principal')->section('content');
        }else{
            return view('livewire.Materiales.materiales',[
                'datos_materiales' => new LengthAwarePaginator($datos_materiales,  $this->total , $this->por_pagina)
            ])->extends('principal')->section('content');
        }


    }
    public function paginacion_numerica($numero)
    {
        $this->paginacion = $numero;
        $this->tama();
    }

    public function tama()
    {
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
                                            :pa_factory_item,
                                            :pa_id)',
                [
                    'pa_factory_item' => $request['factoryed'],
                    'pa_navision_item' => $request['navisored'],
                    'pa_item_description' => $request['desed'],
                    'pa_brand' => $request['branded'],
                    'pa_saldo_minimo' => $request['saldo_med'],
                    'pa_saldo' => $request['saldo_ed'],
                    'pa_codigo_material' => $request['codigoed'],
                    'pa_linea' => $request['lineaed'],
                    'pa_id' => $request['ided']
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
                    'pa_codigo' =>$request['codigoed'],
                    'pa_fecha' => Carbon::now()->format('Y-m-d'),
                    'pa_cantidad' => $request['saldo_ed'],
                    'pa_tipo' => 'Editado',
                    'pa_descripcion' => 'Modificado desde el Catalogo',
                    'pa_usuario' => Auth::user()->id,
                    'pa_id_material' => $request['ided']
                ]
            );
            $this->dispatchBrowserEvent('actualiza_exitoso');
        } else {
            $this->dispatchBrowserEvent('actualiza_falta', ['mensaje' => $validator->errors()->all()]);
        }
    }


    // public function import(Request $request)
    // {
    //    (new MaterialesProductosImport)->import($request->select_file);

    //    return redirect()->route('materiales.relacionar');
    //}

    public function imprimir()
    {
        $start = ($this->page - 1) * $this->por_pagina;
        $vista =  view('Exports.materiales-productos-export', [
            'materiales' =>  DB::select(
                'CALL `mostrar_materiales`(?, ?, ?, ?, ?, ?, ?, @salida_total,@salida_ultimo_codigo)',
                [
                    $this->factory,
                    $this->navisor,
                    $this->codigo,
                    $this->br,
                    $this->descrip,
                    $start,
                    $this->por_pagina,
                ]
            )
        ]);


        return Excel::download(new MaterialesCatalogoExport($vista), 'InventarioMateriales.xlsx');
    }

    public function imprimir_valores($var)
    {
        $this->materiales = DB::select(
            'CALL `mostrar_materiales_exportar`(?, ?, ?, ?, ?,?)',
            [
                $this->factory,
                $this->navisor,
                $this->codigo,
                $this->br,
                $this->descrip,
                $var
            ]
        );

        $vista =  view('Exports.materiales-productos-export', [
            'materiales' =>  $this->materiales
        ]);

        return Excel::download(new MaterialesCatalogoExport($vista), 'InventarioMateriales.xlsx');
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
                'pa_cantidad' => "required|numeric|min:1",
                'pa_fecha' => "required|date",
                'pa_tipo' => "required"
            ],
            [
                'pa_id.required' => "El ID es necesaria.",
                'pa_cantidad.required' => "La cantidad es necesaria.",
                'pa_cantidad.numeric' => "La cantidad traspasada debe ser un numero.",
                'pa_cantidad.min' => "La cantidad debe ser igual o mayor a 1.",
                'pa_fecha.required' => "La fecha es requerida.",
                'pa_fecha.date' => "Debe ingresar una fecha real.",
                'pa_tipo.required' => "El tipo de traslado es requerido."
            ]
        );

        if (!$validator->fails()) {

            if($request['pa_tipo']=="Mal Estado"){
                DB::select(
                    'call actualizar_materiales_trasladar_danados(:pa_cantidad,
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
                        'pa_tipo' => 'Salida Mal Estado Material',
                        'pa_descripcion' => 'Material Dañado',
                        'pa_usuario' => Auth::user()->id,
                        'pa_id_material' => $request['pa_id']
                    ]
                );
            }


            if($request['pa_tipo']=="Faltante"){
                DB::select(
                    'call actualizar_materiales_trasladar_faltante(:pa_cantidad,
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
                        'pa_tipo' => 'Salida Faltante Material',
                        'pa_descripcion' => 'Salida porque material en fisico no existe',
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


        if($request['pa_tipo']=="Entrada Normal Material"){
            DB::select(
                'call actualizar_materiales_entradas(:pa_cantidad,
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
                    'pa_cantidad' => intval($request['pa_cantidad']),
                    'pa_tipo' => $request['pa_tipo'],
                    'pa_descripcion' => $request['pa_descripcion'],
                    'pa_usuario' => Auth::user()->id,
                    'pa_id_material' => $request['pa_id']
                ]
            );
        }


        if($request['pa_tipo']=="Mal Estado Material"){
            DB::select(
                'call actualizar_materiales_trasladar_danados(:pa_cantidad,
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
                    'pa_tipo' => 'Entrada Renovar Material',
                    'pa_descripcion' => 'Renovar Material Dañado',
                    'pa_usuario' => Auth::user()->id,
                    'pa_id_material' => $request['pa_id']
                ]
            );
        }


        if($request['pa_tipo']=="Faltante Material"){
            DB::select(
                'call actualizar_materiales_trasladar_faltante(:pa_cantidad,
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
                    'pa_tipo' => 'Entrada Faltante Material',
                    'pa_descripcion' => 'Material no enviado en físico',
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
                'call actualizar_materiales_salida(:pa_cantidad,
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
                    'pa_cantidad' => $request['pa_cantidad'],
                    'pa_tipo' => $request['pa_tipo'],
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
