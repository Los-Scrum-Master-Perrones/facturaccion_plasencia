<?php

namespace App\Http\Livewire;

use App\Models\InventarioMantenimiento as ModelsInventarioMantenimiento;
use Livewire\Component;

class InventarioMantenimiento extends Component
{
    public function render()
    {

        $inventarioM = ModelsInventarioMantenimiento::all();
        return view('livewire.inventario-mantenimiento', 
        [
             'inventarioM'=>$inventarioM
        ])->extends('principal')->section('content');
    }

    public function eliminarMaterial(ModelsInventarioMantenimiento $id )
    {
        $id->delete();  
    }
}
