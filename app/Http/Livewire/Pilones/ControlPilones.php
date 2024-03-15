<?php

namespace App\Http\Livewire\Pilones;

use App\Models\ControlPilon;
use App\Models\EntradaPilon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use PhpParser\Node\Stmt\Foreach_;

class ControlPilones extends Component
{
    public $nombre_tabaco;
    public $fecha_entrada_pilon;
    public $numero_pilon;
    public $entrada_tabaco_pilon;
    public $salida_tabaco_pilon;
    public $total_actual;
    public $Total;

    // Modal Crear y editar
    public $tabla_entraP;

    public function mount()
    {
        $this->nombre_tabaco = '';
        $this->fecha_entrada_pilon = '';
        $this->numero_pilon = '';
        $this->entrada_tabaco_pilon = '';
        $this->salida_tabaco_pilon = '';
        $this->total_actual = '';
        $this->Total = '';

        $this->tabla_entraP = EntradaPilon::all();
    }

    public function render()
    {
        $controlP = ControlPilon::whereRaw(" nombre_tabaco like concat('%',?, '%') and fecha_entrada_pilon like concat('%',?, '%') and
        numero_pilon like concat('%',?, '%')", [
            $this->nombre_tabaco, $this->fecha_entrada_pilon, $this->numero_pilon,
        ])->get();

        foreach ($controlP as $key => $value) {
            $value->id_entrada_pilones = EntradaPilon::where('nombre_tabaco', $value->nombre_tabaco)
                ->where('fecha_entrada_pilon', $value->fecha_entrada_pilon)->where('numero_pilon', $value->numero_pilon)->first()->id_entrada_pilones ?? 0;
        }


        return view(
            'livewire.pilones.control-pilones',
            [
                'controlP' => $controlP
            ]
        )->extends('principal')->section('content');
    }

    public function registrar_ControlP($contPil)
    {
        try {
            DB::beginTransaction();
            $messages = [
                'id_entrada_pilones.required' => 'El nombre del tabaco es obligatorio.',
                'entrada_tabaco_pilon.required' => 'La entrada de tabaco en el pilón es obligatoria.',
                'entrada_tabaco_pilon.numeric' => 'La entrada de tabaco en el pilón debe ser un valor numérico.',
                'entrada_tabaco_pilon.min' => 'La entrada de tabaco en el pilón debe ser al menos :min.',
                'salida_tabaco_pilon.required' => 'La salida de tabaco en el pilón es obligatoria.',
                'salida_tabaco_pilon.numeric' => 'La salida de tabaco en el pilón debe ser un valor numérico.',
                'salida_tabaco_pilon.min' => 'La salida de tabaco en el pilón debe ser al menos :min.',
                'total_actual.required' => 'El total actual en el pilón es obligatorio.',
                'total_actual.numeric' => 'El total actual en el pilón debe ser un valor numérico.',
                'total_actual.min' => 'El total actual en el pilón debe ser al menos :min.',
                'Total.required' => 'El total es obligatorio.',
                'Total.numeric' => 'El total debe ser un valor numérico.',
                'Total.min' => 'El total debe ser al menos :min.',
            ];

            $validator = Validator::make($contPil, [
                'id_entrada_pilones' => 'required',
                'entrada_tabaco_pilon' => 'required|numeric|min:0',
                'salida_tabaco_pilon' => 'required|numeric|min:0',
                'total_actual' => 'required|numeric|min:0',
                'Total' => 'required|numeric|min:0',
            ], $messages);

            if ($validator->fails()) {
                // El nombre no pasa la validación
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(), 'icon' => 'info']);
                DB::rollBack();
            } else {
                $controlPilon = EntradaPilon::find($contPil['id_entrada_pilones']);

                $Contpilon = ControlPilon::create([
                    'nombre_tabaco' =>  $controlPilon->nombre_tabaco,
                    'fecha_entrada_pilon' =>  $controlPilon->fecha_entrada_pilon,
                    'numero_pilon' =>  $controlPilon->numero_pilon,
                    'entrada_tabaco_pilon' =>  $contPil['entrada_tabaco_pilon'],
                    'salida_tabaco_pilon' =>  $contPil['salida_tabaco_pilon'],
                    'total_actual' =>  $contPil['total_actual'],
                    'Total' =>  $contPil['Total'],
                ]);
                $this->dispatchBrowserEvent('error_general', ['errorr' => 'Registro creado con exito', 'icon' => 'success']);
                DB::commit();
            }
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function editar_ControlP(ControlPilon $controlPl, $cp)
    {
        try {
            DB::beginTransaction();
            $messages = [
                'entrada_tabaco_pilon.required' => 'La entrada de tabaco en el pilón es obligatoria.',
                'entrada_tabaco_pilon.numeric' => 'La entrada de tabaco en el pilón debe ser un valor numérico.',
                'entrada_tabaco_pilon.min' => 'La entrada de tabaco en el pilón debe ser al menos :min.',
                'salida_tabaco_pilon.required' => 'La salida de tabaco en el pilón es obligatoria.',
                'salida_tabaco_pilon.numeric' => 'La salida de tabaco en el pilón debe ser un valor numérico.',
                'salida_tabaco_pilon.min' => 'La salida de tabaco en el pilón debe ser al menos :min.',
                'total_actual.required' => 'El total actual en el pilón es obligatorio.',
                'total_actual.numeric' => 'El total actual en el pilón debe ser un valor numérico.',
                'total_actual.min' => 'El total actual en el pilón debe ser al menos :min.',
                'Total.required' => 'El total es obligatorio.',
                'Total.numeric' => 'El total debe ser un valor numérico.',
                'Total.min' => 'El total debe ser al menos :min.',
            ];

            $validator = Validator::make($cp, [
                'entrada_tabaco_pilon' => 'required|numeric|min:0',
                'salida_tabaco_pilon' => 'required|numeric|min:0',
                'total_actual' => 'required|numeric|min:0',
                'Total' => 'required|numeric|min:0',
            ], $messages);

            if ($validator->fails()) {
                // El nombre no pasa la validación
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(), 'icon' => 'info']);
                DB::rollBack();
            } else {
                $controlPl->entrada_tabaco_pilon =  $cp['entrada_tabaco_pilon'];
                $controlPl->salida_tabaco_pilon =  $cp['salida_tabaco_pilon'];
                $controlPl->total_actual =  $cp['total_actual'];
                $controlPl->Total =  $cp['Total'];

                $controlPl->save();
                $this->dispatchBrowserEvent('error_general', ['errorr' => 'Registro actualizado con exito', 'icon' => 'success']);
                DB::commit();
            }
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function eliminarControlP(ControlPilon $id_control_pilones)
    {
        try {
            DB::beginTransaction();

            $id_control_pilones->delete();
            $this->dispatchBrowserEvent('error_general', ['errorr' => 'Se elimino!', 'icon' => 'success']);
            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }
}
