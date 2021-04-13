<?php

namespace App\View\Components;

use Illuminate\View\Component;

class detalle extends Component
{

    public $hol;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->hol ='jose';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->hol ='jose';
        return view('components.detalle');
    }
}
