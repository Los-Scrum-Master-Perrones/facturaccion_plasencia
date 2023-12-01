<?php

namespace App\Http\Livewire\Produccion;

use App\Models\ProduccionMaterialesNombres;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProduccionMateriales extends Component
{

    use WithFileUploads;
    use WithPagination;
    public $select_file;
    protected $paginationTheme = 'bootstrap';

    //busqueda
    public $b_codigo = '';
    public $b_nombre = '';
    public $b_clase = '';

    //filtros tabla
    public $codigos = [];
    public $nombre = [];
    public $clases = [];

    //nuevo
    public ProduccionMaterialesNombres $material;

    public $rules = [
        'material.id' => 'nullable',
        'material.codigo' => 'nullable',
        'material.nombre' => 'required|string|max:100|unique:produccion_materiales_nombres,nombre',
        'material.clase' => 'required|in:TRIPA,BANDA,CAPA,PICADURA',
        'material.precio' => 'nullable|numeric|min:0',
    ];


    protected $messages = [
        'material.nombre.required' => 'El nombre del material es requerido.',
        'material.nombre.string' => 'El nombre del material debe ser una cadena de caracteres.',
        'material.nombre.max' => 'El nombre del material no debe exceder los 100 caracteres.',
        'material.nombre.unique' => 'El nombre del material ya está en uso.',

        'material.clase.required' => 'La clase del material es requerida.',
        'material.clase.in' => 'La clase del material debe ser TRIPA, BANDA, CAPA o PICADURA.',

        'material.precio.numeric' => 'El precio del material debe ser un valor numérico.',
        'material.precio.min' => 'El precio del material no puede ser menor que cero.',
    ];

    public $por_pagina = 50;
    public $total = 0;

    public function mount()
    {
        $this->material = new ProduccionMaterialesNombres([
            'id' => null,
            'codigo' => '',
            'nombre' => '',
            'clase' => '',
            'precio' => 0,
        ]);

        $da = DB::select('CALL `buscar_produccion_materiales_nombre_conteo`()');

        if (count($da) > 0) {
            $this->codigos = [];
            $this->nombre = [];
            $this->clases = [];

            foreach ($da as $detalles) {
                array_push($this->codigos, $detalles->codigo);
                array_push($this->nombre, $detalles->nombre);
                array_push($this->clases, $detalles->clase);
            }
            $this->codigos = array_unique($this->codigos);
            $this->nombre = array_unique($this->nombre);
            $this->clases = array_unique($this->clases);
        }
    }

    public function render()
    {
        $start = ($this->page - 1) * $this->por_pagina;

        $da = DB::select(
            'CALL `buscar_produccion_materiales_nombre`(?,?,?,?,?,@salida);',
            [
                $this->b_codigo,
                $this->b_nombre,
                $this->b_clase,
                $start,
                $this->por_pagina,
            ]
        );

        $this->total = DB::select('SELECT @salida AS longitud')[0]->longitud;


        return view('livewire.produccion.produccion-materiales', [
            'productos' => new LengthAwarePaginator($da,  $this->total, $this->por_pagina)
        ])->extends('layouts.produccion.produccion-menu')->section('contenido');
    }


    public function actualizarMaterial() {

        try {
            DB::beginTransaction();
            $this->rules['material.nombre'] = 'required|string|max:100|unique:produccion_materiales_nombres,nombre,'.$this->material->id;

            $this->validate();
            $this->material->save();
            $this->dispatchBrowserEvent('error_general',['errorr' => 'Editado con exito','icon' => 'success']);
            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general',['errorr' => $th->getMessage(),'icon' => 'error']);
            DB::rollBack();
        }
    }


    public function edit(ProduccionMaterialesNombres $material){

        try {
            DB::beginTransaction();
            $this->material = $material;
            $this->dispatchBrowserEvent('error_general',['errorr' => 'Listo para Editar','icon' => 'info']);
            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general',['errorr' => $th->getMessage(),'icon' => 'error']);
            DB::rollBack();
        }
    }


    public function generar_codigos()  {
        

    }
}
