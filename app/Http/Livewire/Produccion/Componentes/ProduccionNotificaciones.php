<?php

namespace App\Http\Livewire\Produccion\Componentes;

use App\Exports\ProduccionEmpleadosAsignadoExport;
use App\Models\ProduccionDiarioProducir;
use App\Models\ProduccionMoldeDiario;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ProduccionNotificaciones extends Component
{
    public $pendiente_completado;
    public $pendiente_produccion;

    public $ordenes_existentes = [];

    public $ids;

    public function render()
    {

        $ordenes = [];
        $ordenes_pendientes = [];
        $ordenes_parejas = [];

        $this->pendiente_completado = DB::select('call `buscar_produccion_todos_modulos_empleados`()');
        $pendiente_catalogo = DB::select('CALL `buscar_produccion_empleado_planificacion_marcas`()');
        $empleados_parejas = DB::select('CALL `buscar_produccion_parejas_notificacion`()');
        $this->pendiente_produccion = DB::select('call `buscar_produccion_pendiente_notificacion`()');

        foreach ($this->pendiente_produccion as $key => $value) {
            $ordenes_pendientes[$value->codigo][] = $value;
        }

        foreach ($empleados_parejas as $key => $value) {
            $ordenes_parejas[$value->id_produccion_orden][] = $value;
        }

        foreach ($this->pendiente_completado as $key => $value) {

            if (isset($ordenes_pendientes[$value->codigo_producto])) {
                $value->ordenes[] = $ordenes_pendientes[$value->codigo_producto];
            }

            $ordenes[$value->orden_sistema . "-" . $value->codigo_producto] = $value;
        }

        foreach ($this->pendiente_completado as $key => $value) {

            if (isset($ordenes_pendientes[$value->codigo_producto])) {
                $value->ordenes[] = $ordenes_pendientes[$value->codigo_producto];
            }

            $ordenes[$value->orden_sistema . "-" . $value->codigo_producto] = $value;
        }

        Cache::put('ordenes', $ordenes);
        //$ordenes_existentes[] = $ordenes_pendientes[$value->codigo_producto][0];

        return view('livewire.produccion.componentes.produccion-notificaciones', [
            'pendiente_catalogo' => $pendiente_catalogo,
            'ordenes' => $ordenes,
            'ordenes_pendientes' => $ordenes_pendientes,
            'ordenes_parejas' => $ordenes_parejas
        ]);
    }

    public function agregar_detalle($id, $id_pendient)
    {
        $validator = Validator::make(
            [
                'id' => $id,
                'id_pendient' => $id_pendient,
            ],
            [
                'id' => 'required|integer',
                'id_pendient' => 'required|integer',
            ],
            [
                'id.required' => 'El campo ID es requerido.',
                'id.integer' => 'El campo ID debe ser un número entero.',
                'id_pendient.required' => 'El campo ID Pendiente es requerido.',
                'id_pendient.integer' => 'El campo ID Pendiente debe ser un número entero.',
            ]
        );

        if (!$validator->fails()) {
            try {
                DB::beginTransaction();
                ProduccionDiarioProducir::where('id_produccion_orden', '=', $id)->update([
                    'id_produccion_orden' => $id_pendient,
                    'moldes_para_uso' => 0,
                    'moldes_a_usar' => 0
                ]);
                DB::commit();
                $this->dispatchBrowserEvent('error_general', ['errorr' => 'Produccion Actualizada con exito', 'icon' => 'success']);
            } catch (\Exception $e) {
                DB::rollback();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $e->getMessage(), 'icon' => 'error']);
            }
        } else {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors(), 'icon' => 'error']);
        }
    }

    public function agregar_detalle_parejas($id, $id_pendient, $ids_parejas)
    {
        $validator = Validator::make(
            [
                'id' => $id,
                'id_pendient' => $id_pendient,
            ],
            [
                'id' => 'required|integer',
                'id_pendient' => 'required|integer',
            ],
            [
                'id.required' => 'El campo ID es requerido.',
                'id.integer' => 'El campo ID debe ser un número entero.',
                'id_pendient.required' => 'El campo ID Pendiente es requerido.',
                'id_pendient.integer' => 'El campo ID Pendiente debe ser un número entero.',
            ]
        );

        if (!$validator->fails()) {
            try {
                DB::beginTransaction();


                foreach ($ids_parejas as $key => $value) {
                    ProduccionDiarioProducir::where('id', '=', $value)->update([
                        'id_produccion_orden' => $id_pendient,
                        'moldes_para_uso' => 0,
                        'moldes_a_usar' => 0
                    ]);
                    ProduccionMoldeDiario::where('id_produccion_diario', $value)
                        ->update(['cantidad' => 0, 'check' => 0]);
                }

                DB::commit();
                $this->dispatchBrowserEvent('error_general', ['errorr' => 'Produccion Actualizada con exito', 'icon' => 'success']);
            } catch (\Exception $e) {
                DB::rollback();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $e->getMessage(), 'icon' => 'error']);
            }
        } else {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors(), 'icon' => 'error']);
        }
    }

    

    public function actualiazarOrdenesExistentes()
    {

        try {
            DB::beginTransaction();

            $ordenes = Cache::get('ordenes');
            $ordenesexistentes = [];

            foreach ($ordenes as $key => $orden) {
                if (isset($orden->ordenes)) {
                    $orden->ordenes[0][0]->id_parejas = $orden->id;
                    //$ordenesexistentes[] = $orden->ordenes[0][0];

                    $produccion_diario = ProduccionDiarioProducir::where('id_produccion_orden', '=', $orden->ordenes[0][0]->id_parejas)->get();

                    foreach ($produccion_diario as $key => $value) {
                        ProduccionMoldeDiario::where('id_produccion_diario', $value->id)
                            ->update(['cantidad' => 0, 'check' => 0]);
                    }


                    ProduccionDiarioProducir::where('id_produccion_orden', '=', $orden->ordenes[0][0]->id_parejas)->update([
                        'id_produccion_orden' => $orden->ordenes[0][0]->id,
                        'moldes_para_uso' => 0,
                        'moldes_a_usar' => 0
                    ]);


                    foreach ($produccion_diario as $key => $value) {
                        $ordenesexistentes[] = DB::select('call buscar_produccion_modulos_empleados_expor_noti(?)',[$value->id])[0];
                    }

                }
            }
            Cache::put('actualizar',json_encode($ordenesexistentes));
            DB::commit();
            $this->dispatchBrowserEvent('error_general', ['errorr' => 'Produccion Actualizada con exito', 'icon' => 'success']);


            return Excel::download(new ProduccionEmpleadosAsignadoExport( $ordenesexistentes), 'Reporte empleados nueva asignacion.xlsx');
        } catch (\Exception $e) {
            DB::rollback();
            $this->dispatchBrowserEvent('error_general', ['errorr' => $e->getMessage(), 'icon' => 'error']);
        }
    }
}
