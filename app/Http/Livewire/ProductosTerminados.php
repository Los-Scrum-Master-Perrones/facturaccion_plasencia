<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductosTerminados extends Component
{
    public function render()
    {
        return view('livewire.productos-terminados')->extends('principal')->section('content');
    }
}
