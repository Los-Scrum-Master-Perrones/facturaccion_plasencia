<?php

namespace App\Http\Livewire\Produccion;

use App\Imports\ProduccionMateriales2Import;
use App\Models\ProduccionMateriales;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProduccionMaterialesCatalogo extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $select_file;
    protected $paginationTheme = 'bootstrap';

    //busqueda
    public $b_presentacion = '';
    public $b_codigo = '';
    public $b_marca = '';
    public $b_nombre = '';
    public $b_vitola = '';
    public $b_capa = '';
    public $b_nombre_material = '';
    public $b_banda = '';

    //Productos
    public $produc_pendiente = '';
    public $presentacionn = '';
    public $marcas_nuevo = '';
    public $capas_nuevo = '';
    public $vitolas_nuevo = '';
    public $nombres_nuevo = '';

    //filtros tabla
    public $presentacion = [];
    public $codigos = [];
    public $marcas = [];
    public $nombres = [];
    public $vitolas = [];
    public $capas = [];
    public $nombres_materials = [];
    public $bandas = [];
    public $datos_codigo = [];



    //nuevo
    public ProduccionMateriales $material;

    public $rules = [
        'material.id_producto' => 'string|required',
        'material.marca' => 'string',
        'material.nombre' => 'string',
        'material.vitola' => 'string',
        'material.capa' => 'string',
        'material.nombre_material' => 'string',
        'material.onza' => 'string',
        'material.banda' => 'string',
        'material.onza_banda' => 'string',
        'material.base' => 'string',
        'material.activo' => 'string',
    ];

    public $por_pagina = 50;
    public $total = 0;
    public $activoss = 'A';

    public function activos($ac)
    {
        $this->activoss = $ac;
    }
    public function activar_desactivar(ProduccionMateriales $tupla, $ac)
    {
        $tupla->activo = $ac;
        $tupla->save();
    }

    public function mount()
    {

        $this->material = new ProduccionMateriales([
            `id_producto` =>  0,
            `marca` =>  '',
            `nombre` => '',
            `vitola` =>  '',
            `capa` =>  '',
            `nombre_material` => '',
            `onza` =>  '',
            `banda` => '',
            `onza_banda` =>  '',
            `base` => '',
            `activo` => 'A',
        ]);

        $da = DB::select('CALL `buscar_produccion_materiales_catalogo_detalles`()');

        if (count($da) > 0) {
            $this->presentacion = [];
            $this->codigos = [];
            $this->marcas = [];
            $this->nombres = [];
            $this->vitolas = [];
            $this->capas = [];
            $this->nombres_materials = [];
            $this->bandas = [];

            foreach ($da as $detalles) {
                array_push($this->presentacion, $detalles->presentacion);
                array_push($this->codigos, $detalles->codigo);
                array_push($this->marcas, $detalles->marca);
                array_push($this->nombres, $detalles->nombre);
                array_push($this->vitolas, $detalles->vitola);
                array_push($this->capas, $detalles->capa);
                array_push($this->nombres_materials, $detalles->nombre_material);
                array_push($this->bandas, $detalles->banda);
            }

            $this->presentacion = array_unique($this->presentacion);
            $this->codigos = array_unique($this->codigos);
            $this->marcas = array_unique($this->marcas);
            $this->nombres = array_unique($this->nombres);
            $this->vitolas = array_unique($this->vitolas);
            $this->capas = array_unique($this->capas);
            $this->nombres_materials = array_unique($this->nombres_materials);
            $this->bandas = array_unique($this->bandas);
        }


    }

    public function render()
    {
        $start = ($this->page - 1) * $this->por_pagina;

        $da = DB::select(
            'CALL `buscar_produccion_materiales_catalogo`(?,?,?,?,?,?,?,?,?,?,@salida,?);',
            [
                $this->b_codigo,
                $this->b_presentacion,
                $this->b_marca,
                $this->b_nombre,
                $this->b_vitola,
                $this->b_capa,
                $this->b_nombre_material,
                $this->b_banda,
                $start,
                $this->por_pagina,
                $this->activoss
            ]
        );

        $this->total = DB::select('SELECT @salida AS longitud')[0]->longitud;

        $this->datos_codigo = DB::select("CALL `buscar_produccion_catalogo`('','','','','','',0,'999999','','')");


        return view('livewire.produccion.produccion-materiales-catalogo', [
            'productos' => new LengthAwarePaginator($da,  $this->total, $this->por_pagina)
        ])->extends('layouts.produccion.produccion-menu')->section('contenido');
    }



    /* public function eliminar_salida(Produccion $salida) {

        try {
            DB::beginTransaction();

            $salida->delete();

            $this->dispatchBrowserEvent('error_general',['errorr' => 'Registro eliminado con exito','icon' => 'success']);

            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general',['errorr' => $th->getMessage(),'icon' => 'error']);
            DB::rollBack();
        }

    }
*/

    public function asignar_codigo_producto($id,ProduccionMateriales $edit)
    {
        try {
            DB::beginTransaction();
            $edit->id_producto = $id;
            $edit->save();
            $this->dispatchBrowserEvent('error_general', ['errorr' => 'Editado con exito', 'icon' => 'success']);
            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function editar_producto(ProduccionMateriales $edit)
    {
        try {
            DB::beginTransaction();
            $this->material = $edit;
            $this->dispatchBrowserEvent('error_general', ['errorr' => 'Listo para Editar', 'icon' => 'info']);
            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function modificar_onzas($id,ProduccionMateriales $edit)
    {
        try {

            $patron = "/^\d+\sONZ$/";

            if (preg_match($patron, $id)) {
                DB::beginTransaction();
                $edit->onza = $id;
                $edit->save();
                $this->dispatchBrowserEvent('error_general', ['errorr' => 'Editado con exito', 'icon' => 'success']);
                DB::commit();
            } else {
                $this->dispatchBrowserEvent('error_general', ['errorr' => 'El formato no es el indicado (XX ONZ.)', 'icon' => 'info']);
            }
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }



    public function registra_producto()
    {

        try {
            DB::beginTransaction();

            $this->material->save();

            $this->material = new ProduccionMateriales([
                `id_producto` =>  0,
                `marca` =>  '',
                `nombre` => '',
                `vitola` =>  '',
                `capa` =>  '',
                `nombre_material` => '',
                `onza` =>  '',
                `banda` => '',
                `onza_banda` =>  '',
                `base` => '',
                `activo` => 'A',
            ]);

            $this->dispatchBrowserEvent('error_general', ['errorr' => 'Registro creado con exito', 'icon' => 'success']);

            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function import()
    {
        $this->validate([
            'select_file' => 'max:1024', // 1MB Max
        ]);
        (new ProduccionMateriales2Import)->import($this->select_file);
    }
}
