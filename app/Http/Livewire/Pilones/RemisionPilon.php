<?php

namespace App\Http\Livewire\Pilones;

use App\Exports\RemisionPilonExport;
use App\Models\RemisionPilon as ModelsRemisionPilon;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class RemisionPilon extends Component
{
    public $id_remision;
    public $fecha_remision;
    public $destino_remision;
    public $origen_remision;
    public $mes;
    public $anio;

    public function mount()
    {
        $this->id_remision = '';
        $this->fecha_remision = '';
        $this->destino_remision = '';
        $this->origen_remision = '';

        $this->mes = '00';
        $this->anio = '00';

    }

    public function render()
    {
        $remisionP = ModelsRemisionPilon::whereRaw(" id_remision like concat('%',?, '%') and fecha_remision like concat('%',?, '%') and
        destino_remision like concat('%',?, '%') and origen_remision like concat('%',?, '%') and if(00 = ?, true, year(fecha_remision) = ?)
        and if(00 = ?, true, month(fecha_remision) = ?)", [
            $this->id_remision, $this->fecha_remision, $this->destino_remision, $this->origen_remision, $this->anio,
            $this->anio, $this->mes, $this->mes,
        ])->get();

        return view(
            'livewire.pilones.remision-pilon',
            [
                'remisionP' => $remisionP
            ]
            )->extends('principal')->section('content');
    }

    public function eliminarRemisionP(ModelsRemisionPilon $id_remision_proceso)
    {
        try {
            DB::beginTransaction();

            $id_remision_proceso->delete();
            $this->dispatchBrowserEvent('error_general', ['errorr' => 'Se elimino!', 'icon' => 'success']);
            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function registrar_RemisionP($remiP)
    {
        try {
            DB::beginTransaction();
            $messages = [
                'id_remision.required' => 'El ID de remisión es obligatorio.',
                'id_remision.integer' => 'El ID de remisión debe ser un número entero.',
                'fecha_remision.required' => 'La fecha de remisión es obligatoria.',
                'destino_remision.required' => 'El destino de remisión es obligatorio.',
                'origen_remision.required' => 'El origen de remisión es obligatorio.',
                'descripcion1_remision.required' => 'La descripción de remisión es obligatoria.',
                'cant_lbs_des_1.required' => 'La cantidad de libras es obligatoria.',
                'cant_lbs_des_1.numeric' => 'La cantidad de libras debe ser un valor numérico.',
                'cant_lbs_des_1.min' => 'La cantidad de libras debe ser al menos :min.',
            ];

            $validator = Validator::make($remiP, [
                'id_remision' => 'required|integer',
                'fecha_remision' => 'required',
                'destino_remision' => 'required',
                'origen_remision' => 'required',
                'descripcion1_remision' => 'required|string',
                'cant_lbs_des_1' => 'required|numeric|min:0',
                'descripcion2_remision' => 'nullable|string',
                'cant_lbs_des_2' => 'nullable|numeric|min:0',
                'descripcion3_remision' => 'nullable|string',
                'cant_lbs_des_3' => 'nullable|numeric|min:0',
                'descripcion4_remision' => 'nullable|string',
                'cant_lbs_des_4' => 'nullable|numeric|min:0',
                'descripcion5_remision' => 'nullable|string',
                'cant_lbs_des_5' => 'nullable|numeric|min:0',
            ], $messages);

            if ($validator->fails()) {
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(), 'icon' => 'info']);
                DB::rollBack();
            } else {
                $RemiPilon = new ModelsRemisionPilon();
                $RemiPilon->id_remision = $remiP['id_remision'];
                $RemiPilon->fecha_remision = $remiP['fecha_remision'];
                $RemiPilon->destino_remision = $remiP['destino_remision'];
                $RemiPilon->origen_remision = $remiP['origen_remision'];
                $RemiPilon->descripcion1_remision = $remiP['descripcion1_remision'];
                $RemiPilon->cant_lbs_des_1 = $remiP['cant_lbs_des_1'];
                $RemiPilon->descripcion2_remision = $remiP['descripcion2_remision'];
                $RemiPilon->cant_lbs_des_2 = $remiP['cant_lbs_des_2'];
                $RemiPilon->descripcion3_remision = $remiP['descripcion3_remision'];
                $RemiPilon->cant_lbs_des_3 = $remiP['cant_lbs_des_3'];
                $RemiPilon->descripcion4_remision = $remiP['descripcion4_remision'];
                $RemiPilon->cant_lbs_des_4 = $remiP['cant_lbs_des_4'];
                $RemiPilon->descripcion5_remision = $remiP['descripcion5_remision'];
                $RemiPilon->cant_lbs_des_5 = $remiP['cant_lbs_des_5'];

                $RemiPilon->save();
                $this->dispatchBrowserEvent('error_general', ['errorr' => 'Registro creado con exito', 'icon' => 'success']);
                DB::commit();
            }
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function editar_RemisionP(ModelsRemisionPilon $remisionPl, $rp)
    {
        try {
            DB::beginTransaction();
            $messages = [
                'id_remision.required' => 'El ID de remisión es obligatorio.',
                'id_remision.integer' => 'El ID de remisión debe ser un número entero.',
                'fecha_remision.required' => 'La fecha de remisión es obligatoria.',
                'destino_remision.required' => 'El destino de remisión es obligatorio.',
                'origen_remision.required' => 'El origen de remisión es obligatorio.',
                'descripcion1_remision.required' => 'La descripción de remisión es obligatoria.',
                'cant_lbs_des_1.required' => 'La cantidad de libras es obligatoria.',
                'cant_lbs_des_1.numeric' => 'La cantidad de libras debe ser un valor numérico.',
                'cant_lbs_des_1.min' => 'La cantidad de libras debe ser al menos :min.',
            ];

            $validator = Validator::make($rp, [
                'id_remision' => 'required|integer',
                'fecha_remision' => 'required',
                'destino_remision' => 'required',
                'origen_remision' => 'required',
                'descripcion1_remision' => 'required|string',
                'cant_lbs_des_1' => 'required|numeric|min:0',
                'descripcion2_remision' => 'nullable|string',
                'cant_lbs_des_2' => 'nullable|numeric|min:0',
                'descripcion3_remision' => 'nullable|string',
                'cant_lbs_des_3' => 'nullable|numeric|min:0',
                'descripcion4_remision' => 'nullable|string',
                'cant_lbs_des_4' => 'nullable|numeric|min:0',
                'descripcion5_remision' => 'nullable|string',
                'cant_lbs_des_5' => 'nullable|numeric|min:0',
            ], $messages);

            if ($validator->fails()) {
                // El nombre no pasa la validación
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(), 'icon' => 'info']);
                DB::rollBack();
            } else {
                $remisionPl->id_remision = $rp['id_remision'];
                $remisionPl->fecha_remision = $rp['fecha_remision'];
                $remisionPl->destino_remision = $rp['destino_remision'];
                $remisionPl->origen_remision = $rp['origen_remision'];
                $remisionPl->descripcion1_remision = $rp['descripcion1_remision'];
                $remisionPl->cant_lbs_des_1 = $rp['cant_lbs_des_1'];
                $remisionPl->descripcion2_remision = $rp['descripcion2_remision'];
                $remisionPl->cant_lbs_des_2 = $rp['cant_lbs_des_2'];
                $remisionPl->descripcion3_remision = $rp['descripcion3_remision'];
                $remisionPl->cant_lbs_des_3 = $rp['cant_lbs_des_3'];
                $remisionPl->descripcion4_remision = $rp['descripcion4_remision'];
                $remisionPl->cant_lbs_des_4 = $rp['cant_lbs_des_4'];
                $remisionPl->descripcion5_remision = $rp['descripcion5_remision'];
                $remisionPl->cant_lbs_des_5 = $rp['cant_lbs_des_5'];

                $remisionPl->save();
                $this->dispatchBrowserEvent('error_general', ['errorr' => 'Registro actualizado con exito', 'icon' => 'success']);
                DB::commit();
            }
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function imprimir_Remision()
    {

        $remisionP = ModelsRemisionPilon::whereRaw(" id_remision like concat('%',?, '%') and fecha_remision like concat('%',?, '%') and
        destino_remision like concat('%',?, '%') and origen_remision like concat('%',?, '%') and if(00 = ?, true, year(fecha_remision) = ?)
        and if(00 = ?, true, month(fecha_remision) = ?)", [
            $this->id_remision, $this->fecha_remision, $this->destino_remision, $this->origen_remision, $this->anio,
            $this->anio, $this->mes, $this->mes,
        ])->get();



        $vista =  view('Exports.remision-pilon-export', [
            'remisionP' => $remisionP
        ]);

        return Excel::download(new RemisionPilonExport($vista), 'Lista Remisiones(' . Carbon::now()->format('Y-m-d') . ').xlsx');
    }
}
