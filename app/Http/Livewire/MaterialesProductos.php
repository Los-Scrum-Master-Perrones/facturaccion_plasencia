<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MaterialesProductos extends Component
{
    public function render()
    {
        return view('livewire.Materiales.materiales-productos')->extends('principal')->section('content');
    }
}
