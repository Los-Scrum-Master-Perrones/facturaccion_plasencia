<?php

namespace App\Http\Livewire\Pilones;

use App\Models\Pilon;
use App\Models\ProduccionMaterialesNombres;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class RegistroPilones extends Component
{
    public $nombre;
    public $numero_pilon;
    public function mount(){
        $this->nombre = '';
        $this->numero_pilon = '';
    }

    public function render(){
        $pilonC = ProduccionMaterialesNombres::whereRaw(" nombre like concat('%', ?, '%')",[$this->nombre])->get();
        $nPilon = Pilon::whereRaw(" numero_pilon like concat('%', ?, '%')",[$this->numero_pilon])->get();
        return view('livewire.pilones.registro-pilones',
        [
             'pilonC'=>$pilonC, 'nPilon'=>$nPilon
        ])->extends('principal')->section('content');
    }

    public function registrar_claseP($cla) {

        try {
            DB::beginTransaction();

            $messages = [
                'nombre.required' => 'El nombre es obligatorio.',
                'nombre.max' => 'El nombre debe tener máximo :max caracteres.',
                'nombre.regex' => 'El nombre no puede contener números.',
                'nombre.unique' => 'El nombre ya existe.',
            ];

            $validator = Validator::make($cla, [
                'nombre' => 'required|max:200|unique:produccion_materiales_nombres,nombre|regex:/^[^\d]+$/'
            ], $messages);

            if ($validator->fails()) {
                // El nombre no pasa la validación
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(),'icon' => 'info' ]);
                DB::rollBack();
            } else {
                // El nombre pasa la validación
                $pilon = ProduccionMaterialesNombres::create([
                    'nombre' => $cla['nombre'],
                ]);
                $this->dispatchBrowserEvent('error_general',['errorr' => 'Registro creado con exito','icon' => 'success']);
                DB::commit();
            }

        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general',['errorr' => $th->getMessage(),'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function editar_claseP(ProduccionMaterialesNombres $claP, $p) {

        try {
            DB::beginTransaction();

            $messages = [
                'nombre.required' => 'El nombre es obligatorio.',
                'nombre.max' => 'El nombre debe tener máximo :max caracteres.',
                'nombre.regex' => 'El nombre no puede contener números.',
                'nombre.unique' => 'El nombre ya existe.',
            ];

            $validator = Validator::make($p, [
                'nombre' => 'required|max:200|unique:produccion_materiales_nombres,nombre,'.$claP->id.'|regex:/^[^\d]+$/'
            ], $messages);

            if ($validator->fails()) {
                // El nombre no pasa la validación
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(),'icon' => 'info' ]);
                DB::rollBack();
            } else {
                $claP->nombre =  $p['nombre'];

            $claP->save();
                $this->dispatchBrowserEvent('error_general',['errorr' => 'Registro actualizado con exito','icon' => 'success']);
                DB::commit();
            }

        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general',['errorr' => $th->getMessage(),'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function registrar_idP($numP) {

        try {
            DB::beginTransaction();

            $messages = [
                'numero_pilon.required' => 'El número de pilón es obligatorio.',
                'numero_pilon.max' => 'El número de pilón debe tener máximo :max caracteres.',
                'numero_pilon.numeric' => 'El número de pilón no puede contener letras.',
                'numero_pilon.unique' => 'El número de pilón ya existe.',
            ];

            $validator = Validator::make($numP, [
                'numero_pilon' => 'required|max:10|numeric|unique:pilones,numero_pilon'
            ], $messages);

            if ($validator->fails()) {
                // El nombre no pasa la validación
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(),'icon' => 'info' ]);
                DB::rollBack();
            } else {
                // El nombre pasa la validación
                $mumeroP = Pilon::create([
                    'numero_pilon' => $numP['numero_pilon'],
                ]);
                $this->dispatchBrowserEvent('error_general',['errorr' => 'Registro creado con exito','icon' => 'success']);
                DB::commit();
            }

        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general',['errorr' => $th->getMessage(),'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function editar_idP(Pilon $nPilon, $nuP) {

        try {
            DB::beginTransaction();

            $messages = [
                'numero_pilon.required' => 'El número de pilón es obligatorio.',
                'numero_pilon.max' => 'El número de pilón debe tener máximo :max caracteres.',
                'numero_pilon.numeric' => 'El número de pilón no puede contener letras.',
                'numero_pilon.unique' => 'El número de pilón ya existe.',
            ];

            $validator = Validator::make($nuP, [
                'numero_pilon' => 'required|max:10|numeric|unique:pilones,numero_pilon,'.$nPilon->id_pilon.',id_pilon'
            ], $messages);

            if ($validator->fails()) {
                // El nombre no pasa la validación
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(),'icon' => 'info' ]);
                DB::rollBack();
            } else {
                // El nombre pasa la validación
                $nPilon->numero_pilon =  $nuP['numero_pilon'];

                $nPilon->save();
                $this->dispatchBrowserEvent('error_general',['errorr' => 'Registro actualizado con exito','icon' => 'success']);
                DB::commit();
            }
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general',['errorr' => $th->getMessage(),'icon' => 'error']);
            DB::rollBack();
        }
    }

}
