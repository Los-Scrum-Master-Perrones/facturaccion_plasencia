<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Materiales extends Component
{
    public function render()
    {
        return view('livewire.Materiales.materiales')->extends('principal')->section('content');
    }
}
