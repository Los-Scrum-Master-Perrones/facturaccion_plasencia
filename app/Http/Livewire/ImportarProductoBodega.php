<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Imports\existenciaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class ImportarProductoBodega extends Component
{

    use WithFileUploads;

    public $existencias;
    public $select_file;
    public $busqueda;
    public $borrar;

    public function render()
    {

        $this->existencias  =  DB::select('call buscar_existencia(:buscar)', ['buscar' => $this->busqueda]);

        if (isset($this->select_file)) {
            $this->select_file->store('select_file');
        }

        return view('livewire.importar-producto-bodega')->extends('principal')->section('content');
    }


    public function mount()
    {

        $this->existencias = [];
        $this->busqueda = "";
        $this->existencias  =  DB::select('call mostrar_existencia_bodega');
    }

    public  function import()
    {
        $this->borrar =  DB::select('call borrar_datos_existencia');
        DB::select('ALTER TABLE importar_existencias AUTO_INCREMENT = 1');
        $this->validate([
            'select_file' => 'max:1024', // 1MB Max
        ]);
        (new existenciaImport)->import($this->select_file);
    }

    public  function vaciar()
    {
        $this->borrar =  DB::select('call borrar_datos_existencia');
    }
}
