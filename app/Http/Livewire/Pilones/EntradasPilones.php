<?php

namespace App\Http\Livewire\Pilones;

use App\Models\EntradaPilon;
use App\Models\Pilon;
use App\Models\ProduccionMaterialesNombres;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EntradasPilones extends Component
{

    public $nombre_tabaco;
    public $variedad;
    public $finca;
    public $numero_pilon;
    public $fecha_entrada_pilon;
    public $tiempo_adelanto_pilon;
    public $fecha_estimada_salida;
    public $cantidad_lbs;

    // Modal Crear y editar
    public $tabla_clase;
    public $tabla_pilon;

    public function mount(){
        $this->nombre_tabaco = '';
        $this->variedad = '';
        $this->finca = '';
        $this->numero_pilon = '';
        $this->fecha_entrada_pilon = '';
        $this->tiempo_adelanto_pilon = '';
        $this->fecha_estimada_salida = '';
        $this->cantidad_lbs = '';

        $this->tabla_clase = ProduccionMaterialesNombres::all();
        $this->tabla_pilon = Pilon::all();
    }

    public function render(){

        $entradaPilon = EntradaPilon::whereRaw(" nombre_tabaco like concat('%',?, '%') and variedad like concat('%',?, '%') and
        finca like concat('%',?,'%') and numero_pilon like concat('%',?, '%') and fecha_entrada_pilon like concat('%',?, '%') and
        tiempo_adelanto_pilon like concat('%',?, '%') and fecha_estimada_salida like concat('%',?, '%') and cantidad_lbs like concat('%',?, '%')",[$this->nombre_tabaco, $this->variedad, $this->finca, $this->numero_pilon,
        $this->fecha_entrada_pilon, $this->tiempo_adelanto_pilon, $this->fecha_estimada_salida,
        $this->cantidad_lbs])->get();

        return view('livewire.pilones.entradas-pilones',
        [
             'entradaPilon'=>$entradaPilon
        ])->extends('principal')->section('content');
    }

    public function registrar_EntradaP($EntraPil) {

        try {
            DB::beginTransaction();
            $messages = [
                'nombre_tabaco.required' => 'El nombre del tabaco es obligatorio.',
                'variedad.required' => 'La variedad es obligatoria.',
                'variedad.regex' => 'La variedad no puede contener números.',
                'finca.required' => 'La finca es obligatoria.',
                'finca.regex' => 'La finca no puede contener números.',
                'numero_pilon.required' => 'El número de pilón es obligatorio.',
                'fecha_entrada_pilon.required' => 'La fecha de entrada al pilón es obligatoria.',
                'fecha_entrada_pilon.date' => 'La fecha de entrada al pilón debe ser una fecha válida.',
                'tiempo_adelanto_pilon.required' => 'El tiempo de adelanto del pilón es obligatorio.',
                'fecha_estimada_salida.required' => 'La fecha estimada de salida es obligatoria.',
                'fecha_estimada_salida.date' => 'La fecha estimada de salida debe ser una fecha válida.',
                'cantidad_lbs.required' => 'La cantidad en libras es obligatoria.',
                'cantidad_lbs.numeric' => 'La cantidad en libras debe ser un valor numérico.',
            ];

            $validator = Validator::make($EntraPil, [
                'nombre_tabaco' => 'required',
                'variedad' => 'required|regex:/^[^\d]+$/',
                'finca' => 'required|regex:/^[^\d]+$/',
                'numero_pilon' => 'required',
                'fecha_entrada_pilon' => 'required|date',
                'tiempo_adelanto_pilon' => 'required',
                'fecha_estimada_salida' => 'required|date',
                'cantidad_lbs' => 'required|numeric',
            ], $messages);

            if ($validator->fails()) {
                // El nombre no pasa la validación
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(),'icon' => 'info' ]);
                DB::rollBack();
            } else {
                $pilon = EntradaPilon::create([
                    'nombre_tabaco' =>  $EntraPil['nombre_tabaco'],
                    'variedad' =>  $EntraPil['variedad'],
                    'finca' =>  $EntraPil['finca'],
                    'numero_pilon' =>  $EntraPil['numero_pilon'],
                    'fecha_entrada_pilon' =>  $EntraPil['fecha_entrada_pilon'],
                    'tiempo_adelanto_pilon' =>  $EntraPil['tiempo_adelanto_pilon'],
                    'fecha_estimada_salida' =>  $EntraPil['fecha_estimada_salida'],
                    'cantidad_lbs' =>  $EntraPil['cantidad_lbs'],
                ]);
                $this->dispatchBrowserEvent('error_general',['errorr' => 'Registro creado con exito','icon' => 'success']);
                DB::commit();
            }

        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general',['errorr' => $th->getMessage(),'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function editar_EntradaP(EntradaPilon $entrP, $ep) {

        try {
            DB::beginTransaction();
            $messages = [
                'nombre_tabaco.required' => 'El nombre del tabaco es obligatorio.',
                'variedad.required' => 'La variedad es obligatoria.',
                'variedad.regex' => 'La variedad no puede contener números.',
                'finca.required' => 'La finca es obligatoria.',
                'finca.regex' => 'La finca no puede contener números.',
                'numero_pilon.required' => 'El número de pilón es obligatorio.',
                'fecha_entrada_pilon.required' => 'La fecha de entrada al pilón es obligatoria.',
                'fecha_entrada_pilon.date' => 'La fecha de entrada al pilón debe ser una fecha válida.',
                'tiempo_adelanto_pilon.required' => 'El tiempo de adelanto del pilón es obligatorio.',
                'fecha_estimada_salida.required' => 'La fecha estimada de salida es obligatoria.',
                'fecha_estimada_salida.date' => 'La fecha estimada de salida debe ser una fecha válida.',
                'cantidad_lbs.required' => 'La cantidad en libras es obligatoria.',
                'cantidad_lbs.numeric' => 'La cantidad en libras debe ser un valor numérico.',
            ];

            $validator = Validator::make($ep, [
                'nombre_tabaco' => 'required',
                'variedad' => 'required|regex:/^[^\d]+$/',
                'finca' => 'required|regex:/^[^\d]+$/',
                'numero_pilon' => 'required',
                'fecha_entrada_pilon' => 'required|date',
                'tiempo_adelanto_pilon' => 'required',
                'fecha_estimada_salida' => 'required|date',
                'cantidad_lbs' => 'required|numeric',
            ], $messages);

            if ($validator->fails()) {
                // El nombre no pasa la validación
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(),'icon' => 'info' ]);
                DB::rollBack();
            } else {
                $entrP->nombre_tabaco =  $ep['nombre_tabaco'];
                $entrP->variedad =  $ep['variedad'];
                $entrP->finca =  $ep['finca'];
                $entrP->numero_pilon =  $ep['numero_pilon'];
                $entrP->fecha_entrada_pilon =  $ep['fecha_entrada_pilon'];
                $entrP->tiempo_adelanto_pilon =  $ep['tiempo_adelanto_pilon'];
                $entrP->fecha_estimada_salida =  $ep['fecha_estimada_salida'];
                $entrP->cantidad_lbs =  $ep['cantidad_lbs'];

                $entrP->save();
                $this->dispatchBrowserEvent('error_general',['errorr' => 'Registro actualizado con exito','icon' => 'success']);
                DB::commit();
            }

        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general',['errorr' => $th->getMessage(),'icon' => 'error']);
            DB::rollBack();
        }
    }

}
