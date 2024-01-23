<?php

namespace App\Http\Livewire\Produccion\Componentes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProduccionNotificaciones extends Component
{
    public $pendiente_completado;
    public $pendiente_produccion;

    public $ordenes = [];
    public $ordenes_pendientes = [];

    public function render()
    {
        $this->pendiente_completado = DB::select('call `buscar_produccion_todos_modulos_empleados`()');
        $pendiente_catalogo = DB::select('CALL `buscar_produccion_empleado_planificacion_marcas`()');
        $this->pendiente_produccion = DB::select('call `buscar_produccion_pendiente_notificacion`()');


        foreach ($this->pendiente_produccion as $key => $value) {
            $this->ordenes_pendientes[$value->codigo][] = $value;
        }

        foreach ($this->pendiente_completado as $key => $value) {

            if (isset($this->ordenes_pendientes[$value->codigo_producto])) {
                $value->ordenes[] = $this->ordenes_pendientes[$value->codigo_producto];
            }

            if (isset($this->ordenes_pendientes[$value->codigo_producto])) {
                $value->parejas[] = $this->ordenes_pendientes[$value->codigo_producto];
            }

            $this->ordenes[$value->orden_sistema."-".$value->codigo_producto] = $value;
        }



        return view('livewire.produccion.componentes.produccion-notificaciones',[
            'pendiente_catalogo' => $pendiente_catalogo
        ]);
    }
}
