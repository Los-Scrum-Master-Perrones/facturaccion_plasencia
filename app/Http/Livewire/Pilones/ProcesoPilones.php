<?php

namespace App\Http\Livewire\Pilones;

use App\Exports\RemisionPilonExport;
use App\Models\EntradaPilon;
use App\Models\Proceso;
use App\Models\ProcesoPilon;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ProcesoPilones extends Component
{
    public $id_remision;
    public $entradas_salidas;
    public $nombre_tabaco;

    public $cambio;

    // Modal Crear y editar
    public $tabla_ProcesoP;

    public function mount()
    {
        $this->id_remision = '';
        $this->entradas_salidas = '';
        $this->nombre_tabaco = '';

        $this->tabla_ProcesoP = EntradaPilon::all();
        $this->cambio = '1';
    }

    public function render()
    {
        if ($this->cambio == '1') {
            $proPilones = Proceso::whereRaw(" id_remision like concat('%',?, '%') and entradas_salidas like concat('%',?, '%') and
            nombre_tabaco like concat('%',?, '%') ", [
                $this->id_remision, $this->entradas_salidas, $this->nombre_tabaco,
            ])->get();
        }else{
            $proPilones = ProcesoPilon::whereRaw(" id_remision like concat('%',?, '%') and entradas_salidas like concat('%',?, '%') and
            nombre_tabaco like concat('%',?, '%') ", [
                $this->id_remision, $this->entradas_salidas, $this->nombre_tabaco,
            ])->get();
        }

        return view('livewire.pilones.proceso-pilones',
        [
             'proPilones'=>$proPilones
        ])->extends('principal')->section('content');
    }

    public function eliminarProcePilon(ProcesoPilon $id_tabla_pilon)
    {
        try {
            DB::beginTransaction();

            $id_tabla_pilon->delete();
            $this->dispatchBrowserEvent('error_general', ['errorr' => 'Se elimino!', 'icon' => 'success']);
            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function registrar_ProcesoP($procePil)
    {
        try {
            DB::beginTransaction();
            $messages = [
                'fecha_proceso.required' => 'La fecha del proceso es obligatoria.',
                'id_remision.required' => 'El número de la remisión es obligatorio.',
                'id_remision.integer' => 'El número de la remisión debe ser un número entero.',
                'entradas_salidas.required' => 'El número de entradas/salidas es obligatorio.',
                'id_entrada_pilones.required' => 'El nombre del tabaco es obligatorio.',
                'subtotal.required' => 'El subtotal es obligatorio.',
                'subtotal.numeric' => 'El subtotal debe ser un valor numérico.',
                'subtotal.min' => 'El subtotal debe ser al menos :min.',
                'total_libras.required' => 'El total de libras es obligatorio.',
                'total_libras.numeric' => 'El total de libras debe ser un valor numérico.',
                'total_libras.min' => 'El total de libras debe ser al menos :min.',
                'total_remision.required' => 'El total de la remisión es obligatorio.',
                'total_remision.numeric' => 'El total de la remisión debe ser un valor numérico.',
                'total_remision.min' => 'El total de la remisión debe ser al menos :min.',
            ];

            $validator = Validator::make($procePil, [
                'fecha_proceso' => 'required',
                'id_remision' => 'required|integer',
                'entradas_salidas' => 'required',
                'id_entrada_pilones' => 'required',
                'subtotal' => 'required|numeric|min:0',
                'total_libras' => 'required|numeric|min:0',
                'total_remision' => 'required|numeric|min:0',
            ], $messages);

            if ($validator->fails()) {
                // El nombre no pasa la validación
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(), 'icon' => 'info']);
                DB::rollBack();
            } else {
                $procesoPilon = EntradaPilon::find($procePil['id_entrada_pilones']);

                $propilon = ProcesoPilon::create([
                    'fecha_proceso' =>  $procePil['fecha_proceso'],
                    'id_remision' =>  $procePil['id_remision'],
                    'entradas_salidas' =>  $procePil['entradas_salidas'],
                    'nombre_tabaco' =>  $procesoPilon->nombre_tabaco,
                    'subtotal' =>  $procePil['subtotal'],
                    'total_libras' =>  $procePil['total_libras'],
                    'total_remision' =>  $procePil['total_remision'],
                ]);
                $this->dispatchBrowserEvent('error_general', ['errorr' => 'Registro creado con exito', 'icon' => 'success']);
                DB::commit();
            }
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function editar_ProcesoP(ProcesoPilon $ProcesoPl, $pp)
    {
        try {
            DB::beginTransaction();
            $messages = [
                'fecha_proceso.required' => 'La fecha del proceso es obligatoria.',
                'id_remision.required' => 'El número de la remisión es obligatorio.',
                'id_remision.integer' => 'El número de la remisión debe ser un número entero.',
                'entradas_salidas.required' => 'El número de entradas/salidas es obligatorio.',
                'id_entrada_pilones.required' => 'El nombre del tabaco es obligatorio.',
                'subtotal.required' => 'El subtotal es obligatorio.',
                'subtotal.numeric' => 'El subtotal debe ser un valor numérico.',
                'subtotal.min' => 'El subtotal debe ser al menos :min.',
                'total_libras.required' => 'El total de libras es obligatorio.',
                'total_libras.numeric' => 'El total de libras debe ser un valor numérico.',
                'total_libras.min' => 'El total de libras debe ser al menos :min.',
                'total_remision.required' => 'El total de la remisión es obligatorio.',
                'total_remision.numeric' => 'El total de la remisión debe ser un valor numérico.',
                'total_remision.min' => 'El total de la remisión debe ser al menos :min.',
            ];

            $validator = Validator::make($pp, [
                'fecha_proceso' => 'required',
                'id_remision' => 'required|integer',
                'entradas_salidas' => 'required',
                'id_entrada_pilones' => 'required',
                'subtotal' => 'required|numeric|min:0',
                'total_libras' => 'required|numeric|min:0',
                'total_remision' => 'required|numeric|min:0',
            ], $messages);

            if ($validator->fails()) {
                // El nombre no pasa la validación
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(), 'icon' => 'info']);
                DB::rollBack();
            } else {
                $ProcesoPl->fecha_proceso =  $pp['fecha_proceso'];
                $ProcesoPl->id_remision =  $pp['id_remision'];
                $ProcesoPl->entradas_salidas =  $pp['entradas_salidas'];
                $ProcesoPl->nombre_tabaco =  $pp['id_entrada_pilones'];
                $ProcesoPl->subtotal =  $pp['subtotal'];
                $ProcesoPl->total_libras =  $pp['total_libras'];
                $ProcesoPl->total_remision =  $pp['total_remision'];

                $ProcesoPl->save();
                $this->dispatchBrowserEvent('error_general', ['errorr' => 'Registro actualizado con exito', 'icon' => 'success']);
                DB::commit();
            }
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function imprimir_ProcesoPilon()
    {

        $proPilones = ProcesoPilon::whereRaw(" id_remision like concat('%',?, '%') and entradas_salidas like concat('%',?, '%') and
        nombre_tabaco like concat('%',?, '%') ", [
            $this->id_remision, $this->entradas_salidas, $this->nombre_tabaco,
        ])->get();

        $vista =  view('Exports.proceso-pilones-export', [
            'proPilones' => $proPilones
        ]);

        return Excel::download(new RemisionPilonExport($vista), 'Lista de proceso de pilones(' . Carbon::now()->format('Y-m-d') . ').xlsx');
    }

    // para procesos
    public function eliminarProceso(Proceso $id_tabla_proceso)
    {
        try {
            DB::beginTransaction();

            $id_tabla_proceso->delete();
            $this->dispatchBrowserEvent('error_general', ['errorr' => 'Se elimino!', 'icon' => 'success']);
            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function registrar_Proceso($proce)
    {
        try {
            DB::beginTransaction();
            $messages = [
                'fecha_proceso.required' => 'La fecha del proceso es obligatoria.',
                'id_remision.required' => 'El número de la remisión es obligatorio.',
                'id_remision.integer' => 'El número de la remisión debe ser un número entero.',
                'entradas_salidas.required' => 'El número de entradas/salidas es obligatorio.',
                'id_entrada_pilones.required' => 'El nombre del tabaco es obligatorio.',
                'subtotal.required' => 'El subtotal es obligatorio.',
                'subtotal.numeric' => 'El subtotal debe ser un valor numérico.',
                'subtotal.min' => 'El subtotal debe ser al menos :min.',
                'total_libras.required' => 'El total de libras es obligatorio.',
                'total_libras.numeric' => 'El total de libras debe ser un valor numérico.',
                'total_libras.min' => 'El total de libras debe ser al menos :min.',
                'total_remision.required' => 'El total de la remisión es obligatorio.',
                'total_remision.numeric' => 'El total de la remisión debe ser un valor numérico.',
                'total_remision.min' => 'El total de la remisión debe ser al menos :min.',
            ];

            $validator = Validator::make($proce, [
                'fecha_proceso' => 'required',
                'id_remision' => 'required|integer',
                'entradas_salidas' => 'required',
                'id_entrada_pilones' => 'required',
                'subtotal' => 'required|numeric|min:0',
                'total_libras' => 'required|numeric|min:0',
                'total_remision' => 'required|numeric|min:0',
            ], $messages);

            if ($validator->fails()) {
                // El nombre no pasa la validación
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(), 'icon' => 'info']);
                DB::rollBack();
            } else {
                $proceso = EntradaPilon::find($proce['id_entrada_pilones']);

                $pro = Proceso::create([
                    'fecha_proceso' =>  $proce['fecha_proceso'],
                    'id_remision' =>  $proce['id_remision'],
                    'entradas_salidas' =>  $proce['entradas_salidas'],
                    'nombre_tabaco' =>  $proceso->nombre_tabaco,
                    'subtotal' =>  $proce['subtotal'],
                    'total_libras' =>  $proce['total_libras'],
                    'total_remision' =>  $proce['total_remision'],
                ]);
                $this->dispatchBrowserEvent('error_general', ['errorr' => 'Registro creado con exito', 'icon' => 'success']);
                DB::commit();
            }
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function editar_Proceso(Proceso $pProceso, $p)
    {
        try {
            DB::beginTransaction();
            $messages = [
                'fecha_proceso.required' => 'La fecha del proceso es obligatoria.',
                'id_remision.required' => 'El número de la remisión es obligatorio.',
                'id_remision.integer' => 'El número de la remisión debe ser un número entero.',
                'entradas_salidas.required' => 'El número de entradas/salidas es obligatorio.',
                'id_entrada_pilones.required' => 'El nombre del tabaco es obligatorio.',
                'subtotal.required' => 'El subtotal es obligatorio.',
                'subtotal.numeric' => 'El subtotal debe ser un valor numérico.',
                'subtotal.min' => 'El subtotal debe ser al menos :min.',
                'total_libras.required' => 'El total de libras es obligatorio.',
                'total_libras.numeric' => 'El total de libras debe ser un valor numérico.',
                'total_libras.min' => 'El total de libras debe ser al menos :min.',
                'total_remision.required' => 'El total de la remisión es obligatorio.',
                'total_remision.numeric' => 'El total de la remisión debe ser un valor numérico.',
                'total_remision.min' => 'El total de la remisión debe ser al menos :min.',
            ];

            $validator = Validator::make($p, [
                'fecha_proceso' => 'required',
                'id_remision' => 'required|integer',
                'entradas_salidas' => 'required',
                'id_entrada_pilones' => 'required',
                'subtotal' => 'required|numeric|min:0',
                'total_libras' => 'required|numeric|min:0',
                'total_remision' => 'required|numeric|min:0',
            ], $messages);

            if ($validator->fails()) {
                // El nombre no pasa la validación
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(), 'icon' => 'info']);
                DB::rollBack();
            } else {
                $pProceso->fecha_proceso =  $p['fecha_proceso'];
                $pProceso->id_remision =  $p['id_remision'];
                $pProceso->entradas_salidas =  $p['entradas_salidas'];
                $pProceso->nombre_tabaco =  $p['id_entrada_pilones'];
                $pProceso->subtotal =  $p['subtotal'];
                $pProceso->total_libras =  $p['total_libras'];
                $pProceso->total_remision =  $p['total_remision'];

                $pProceso->save();
                $this->dispatchBrowserEvent('error_general', ['errorr' => 'Registro actualizado con exito', 'icon' => 'success']);
                DB::commit();
            }
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function imprimir_Proceso()
    {

        $proImp = Proceso::whereRaw(" id_remision like concat('%',?, '%') and entradas_salidas like concat('%',?, '%') and
        nombre_tabaco like concat('%',?, '%') ", [
            $this->id_remision, $this->entradas_salidas, $this->nombre_tabaco,
        ])->get();

        $vista =  view('Exports.proceso-pilones-export', [
            'proImp' => $proImp
        ]);

        return Excel::download(new RemisionPilonExport($vista), 'Lista de proceso de pilones(' . Carbon::now()->format('Y-m-d') . ').xlsx');
    }
}
