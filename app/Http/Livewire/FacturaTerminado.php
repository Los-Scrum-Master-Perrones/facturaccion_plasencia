<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FacturaTerminado extends Component
{
    public function render()
    {
        return view('livewire.factura-terminado')->extends('principal')->section('content');;
    }
}
