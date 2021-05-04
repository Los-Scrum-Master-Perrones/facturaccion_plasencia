<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HistorialProgramacion extends Component
{
    public function render()
    {
        
        return view('livewire.historial-programacion')->extends('principal')->section('content');
    }
}
