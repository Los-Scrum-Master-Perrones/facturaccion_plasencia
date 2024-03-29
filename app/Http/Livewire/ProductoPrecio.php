<?php

namespace App\Http\Livewire;

use App\Exports\CatalogoPrecioExport;
use App\Models\CatalogoHistorialPrecio;
use App\Models\CatalogoItemsPrecio;
use App\Models\CatalogoMarcasPrecio;
use App\Models\marca_producto;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ProductoPrecio extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $codigo_n = '';
    public $presentacion_n = '';
    public $precio_n = '';
    public $marca_n = '';
    public $nombre_n = '';
    public $vitola_n = '';
    public $capa_n = '';
    public $empaque_n = '';


    public $codigo_p = [];
    public $marcas_p = [];
    public $marcas_p2 = [];
    public $nombre_p = [];
    public $vitolas_p = [];
    public $capas_p = [];
    public $empaques_p = [];

    public $codigo = '';
    public $presentacion = '';
    public $marca = '';
    public $nombre = '';
    public $vitola = '';
    public $capa = '';
    public $empaque = '';


    public $chechDerivados = '';
    public $porcentajes_actual = '';
    public $marca_actual = '';
    public $presentacion_actual = 'no fuma';

    public CatalogoItemsPrecio $new_precio;

    public $rules = [
        'new_precio.codigo' => 'string|required',
        'new_precio.id_catalogo_marca_precio' => 'integer|required',
        'new_precio.presentacion' => 'string|required',
        'new_precio.nombre' => 'string|required',
        'new_precio.vitola' => 'string|required',
        'new_precio.capa' => 'string|required',
        'new_precio.tipo_empaque' => 'string|required',
        'new_precio.fecha' => 'date|required',
    ];
    public $edi_precio = '';

    public $precio_mayor = 4000;
    public $precio_menor = 0;

    public $por_pagina = 50;
    public $total = 0;

    public function mount()
    {
        $this->new_precio = new CatalogoItemsPrecio([
            `codigo` =>  'P-',
            `id_catalogo_marca_precio` =>  0,
            `nombre` =>  '',
            `vitola` =>  '',
            `capa` =>  '',
            `tipo_empaque` =>  '',
            `fecha` =>  Carbon::now()->format('Y-m-d'),
        ]);

        $prodcutosPrecio =  DB::select('call mostrar_catalogo_precios()');
        $this->codigo_n = CatalogoMarcasPrecio::orderBy('id', 'desc')->first()->codigo + 1000;
        $this->cargar_select_busqueda($prodcutosPrecio);
    }

    public function render()
    {
        $this->precio_mayor = $this->precio_mayor >= 0 ? $this->precio_mayor : 0;
        $this->precio_menor = $this->precio_menor >= 0 ? $this->precio_menor : 0;
        if ($this->precio_mayor > $this->precio_menor) {
        } else {
            $this->precio_mayor = 4000;
            $this->precio_menor = 0;
        }

        $start = ($this->page - 1) * $this->por_pagina;

        $prodcutosPrecio = DB::select(
            'call mostrar_catalogo_precios_busqueda(?,?,?,?,?,?,?,?,?,?,?)',
            [
                $this->codigo,
                $this->marca,
                $this->nombre,
                $this->vitola,
                $this->capa,
                $this->empaque,
                $start,
                $this->por_pagina,
                $this->precio_menor == '' ? 0 : $this->precio_menor,
                $this->precio_mayor == '' ? 0 : $this->precio_mayor,
                $this->presentacion
            ]
        );
        $usos = DB::select(
            'call mostrar_catalogo_precios_historial(?,?,?,?,?,?,?)',
            [
                $this->codigo,
                $this->marca,
                $this->nombre,
                $this->vitola,
                $this->capa,
                $this->empaque,
                $this->presentacion
            ]
        );
        $usosArray = [];
        $usosArray2 = [];
        foreach ($usos as $uso) {
            $usosArray[$uso->id_catalogo_items_precio] =  $uso;
            $usosArray2[$uso->id_catalogo_items_precio][] =  $uso;
        }
        foreach ($prodcutosPrecio as $key => $value) {
            $value->precio_actual = $usosArray[$value->id];
            $value->historial[] = $usosArray2[$value->id];
        }


        $this->total = DB::select(
            'call mostrar_catalogo_precios_conteo(?,?,?,?,?,?,?,?,?)',
            [
                $this->codigo,
                $this->marca,
                $this->nombre,
                $this->vitola,
                $this->capa,
                $this->empaque,
                $this->precio_menor == '' ? 0 : $this->precio_menor,
                $this->precio_mayor == '' ? 0 : $this->precio_mayor,
                $this->presentacion
            ]
        )[0]->total;

        return view('livewire.producto-precio', [
            'prodcutosPrecio' => new LengthAwarePaginator($prodcutosPrecio, $this->total, $this->por_pagina),
            'datos' => $prodcutosPrecio
        ])->extends('layouts.Main')->section('content');
    }

    public function cargar_select_busqueda($datos)
    {
        if (count($datos) > 0) {

            $this->codigo_p = [];
            $this->marcas_p = [];
            $this->vitolas_p = [];
            $this->capas_p = [];
            $this->empaques_p = [];

            foreach ($datos as $detalles) {
                array_push($this->codigo_p, $detalles->codigo);
                array_push($this->marcas_p, $detalles->marca);
                array_push($this->nombre_p, $detalles->nombre);
                array_push($this->vitolas_p, $detalles->vitola);
                array_push($this->capas_p, $detalles->capa);
                array_push($this->empaques_p, $detalles->tipo_empaque);
            }

            $this->codigo_p = array_unique($this->codigo_p);
            $this->marcas_p = array_unique($this->marcas_p);
            $this->nombre_p = array_unique($this->nombre_p);
            $this->vitolas_p = array_unique($this->vitolas_p);
            $this->capas_p = array_unique($this->capas_p);
            $this->empaques_p = array_unique($this->empaques_p);
        }



        $this->marcas_p2 = CatalogoMarcasPrecio::all();

    }

    public function imprimir_reporte()
    {
        $prodcutosPrecio = DB::select(
            'call mostrar_catalogo_precios_busqueda_historial(?,?,?,?,?,?,?,?,?)',
            [
                $this->codigo,
                $this->marca,
                $this->nombre,
                $this->vitola,
                $this->capa,
                $this->empaque,
                $this->precio_menor == '' ? 0 : $this->precio_menor,
                $this->precio_mayor == '' ? 0 : $this->precio_mayor,
                $this->presentacion
            ]
            );
        $usos = DB::select('call mostrar_catalogo_precios_historial("","","","","","","")');



        $usosArray = [];
        $usosArray2 = [];
        foreach ($usos as $uso) {
            $uso->precio_anio[$uso->anio] = $uso->precio;

            $usosArray[$uso->id_catalogo_items_precio] =  $uso;
            $usosArray2[$uso->id_catalogo_items_precio][] =  $uso;
        }
        foreach ($prodcutosPrecio as $key => $value) {
            $value->precio_actual = $usosArray[$value->id];
            $value->historial[] = $usosArray2[$value->id];
        }

        $anios = DB::select('SELECT DISTINCT anio
        from catalogo_historial_precio
        ORDER BY anio');


        $vista =  view('Exports.producto-precio', [
            'prodcutosPrecio' => $prodcutosPrecio,
            'anios' => $anios
        ]);

        return Excel::download(new CatalogoPrecioExport($vista), 'Catalogo Precios.xlsx');
    }

    public function save()
    {
        try {
            DB::beginTransaction();

            $marca_precio =  CatalogoMarcasPrecio::firstOrCreate(
                ['marca' => $this->marca_n],
                ['codigo' => $this->codigo_n]
            );

            $codigo_precio_n = intval($marca_precio->codigo);
            $codigo_precio = CatalogoItemsPrecio::where('id_catalogo_marca_precio', '=', $marca_precio->id)->orderBy('id', 'desc')->first();
            if ($codigo_precio) {
                $codigo_precio_n = $codigo_precio->codigo + 1;
            } else {
                $codigo_precio_n++;
            }

            $precio =  CatalogoItemsPrecio::firstOrCreate(
                [
                    'id_catalogo_marca_precio' => $marca_precio->id,
                    'nombre' => $this->nombre_n,
                    'vitola' => $this->vitola_n,
                    'capa' => $this->capa_n,
                    'tipo_empaque' => $this->empaque_n
                ],
                ['codigo' => $codigo_precio_n, 'fecha' => Carbon::now()->format('Y-m-d')]
            );

            CatalogoHistorialPrecio::updateOrCreate(
                [
                    'id_catalogo_items_precio' => $precio->id,
                    'anio' => Carbon::now()->format('Y')
                ],
                ['precio' => $this->precio_n, 'porcentaje_incremento' => 0]
            );

            $this->dispatchBrowserEvent('RegistradoConExito');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function editarPrecio(CatalogoItemsPrecio $p) {
        $this->new_precio = $p;
    }


    public function actualizarPrecio() {
        $this->new_precio->save();

        CatalogoHistorialPrecio::updateOrCreate(
            [
                'id_catalogo_items_precio' => $this->new_precio->id,
                'anio' => Carbon::now()->format('Y')
            ],
            ['precio' => $this->edi_precio]
        );
    }

    public function eliminar_precio(CatalogoItemsPrecio $de)
    {
        try {
            DB::beginTransaction();
            $de->delete();
            $this->dispatchBrowserEvent('error_general', ['errorr' => 'Eliminado con exito', 'icon' => 'info']);
            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }
    //public $chechDerivados = '';
    //public $presentacion_actual = '';
    public function agregarPrecioNuevoAnio(){
        try {
            DB::beginTransaction();
            $precios_anteriores = DB::select('call traer_catalogo_precios_anio_anterioir()');
            $precios = [];
            $items = [];
            foreach ($precios_anteriores as $key => $value) {
                $precios[$value->id][] = $value;
            }

            if($this->marca_actual == "todos"){
                $items = CatalogoItemsPrecio::all();
            }else{
                $items = DB::select('call traer_catalogo_precios_filtro_marca(:pa_marca,:pa_desicion,:pa_presentacion)',[
                    'pa_marca' => $this->marca_actual,
                    'pa_desicion' => $this->chechDerivados=="todos"? 1:0,
                    'pa_presentacion' => $this->presentacion_actual,
                ]);
            }


            foreach ($items as $key => $value) {
                $datos2[] = [
                    "id_catalogo_items_precio" => $value->id,
                    "precio" => doubleval($precios[$value->id][0]->precio)*(1.00+(doubleval($this->porcentajes_actual)/100)),
                    "porcentaje_incremento" => (doubleval($this->porcentajes_actual)/100),
                    "anio" => Carbon::now()->format('Y'),
                ];
            }

            CatalogoHistorialPrecio::upsert(
                $datos2,
                ['id_catalogo_items_precio','anio'],
                ['precio', 'porcentaje_incremento']
            );

            $this->dispatchBrowserEvent('error_general', ['errorr' => 'Actualizado con exito', 'icon' => 'info']);
            DB::commit();


        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }



}
