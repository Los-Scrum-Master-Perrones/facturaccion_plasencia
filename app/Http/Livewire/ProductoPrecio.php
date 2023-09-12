<?php

namespace App\Http\Livewire;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ProductoPrecio extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $codigo_p = [];
    public $marcas_p = [];
    public $nombre_p = [];
    public $vitolas_p = [];
    public $capas_p = [];
    public $empaques_p = [];


    public $codigo = '';
    public $marca = '';
    public $nombre = '';
    public $vitola = '';
    public $capa = '';
    public $empaque = '';
    public $datos = [];

   

    public function mount()
    {
        $prodcutosPrecio =  DB::select('call mostrar_catalogo_precios()');
        $this->cargar_select_busqueda($prodcutosPrecio);
    }


    public function render()
    {
        $perPage = 25; // Número de registros por página
        $start = ($this->page - 1) * $perPage; // Calcular el índice de inicio

        $prodcutosPrecio = DB::select(
            'call mostrar_catalogo_precios_busqueda(?,?,?,?,?,?,?,?)',
            [
                $this->codigo,
                $this->marca,
                $this->nombre,
                $this->vitola,
                $this->capa,
                $this->empaque,
                $start,
                $perPage
            ]
        );
        $usos = DB::select(
            'call mostrar_catalogo_precios_historial(?,?,?,?,?,?)',
            [
                $this->codigo,
                $this->marca,
                $this->nombre,
                $this->vitola,
                $this->capa,
                $this->empaque
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


        $total = DB::select(
            'call mostrar_catalogo_precios_conteo(?,?,?,?,?,?)',
            [
                $this->codigo,
                $this->marca,
                $this->nombre,
                $this->vitola,
                $this->capa,
                $this->empaque
            ]
        )[0]->total;

        $this->datos=$prodcutosPrecio;

        return view('livewire.producto-precio', [
            'prodcutosPrecio' => new LengthAwarePaginator($prodcutosPrecio, $total , $perPage)
        ])->extends('layouts.Main')->section('content');
    }

    public function cargar_select_busqueda($datos)
    {
        if (count($datos) > 0) {

            $this->codigo_p = [];
            $this->marcas_p = [];
            $this->nombre_p = [];
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
    }
}
