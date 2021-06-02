<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BusquedaAvanzada extends Component
{
    public function render()
    {
        return view('livewire.busqueda-avanzada')->extends('principal')->section('content');
    }
}
