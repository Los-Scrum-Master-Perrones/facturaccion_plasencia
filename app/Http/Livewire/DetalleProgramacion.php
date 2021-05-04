<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DetalleProgramacion extends Component
{
    public function render()
    {
        return view('livewire.detalle-programacion')->extends('principal')->section('content');
    }
}
