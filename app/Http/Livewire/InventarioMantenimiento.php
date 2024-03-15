<?php

namespace App\Http\Livewire;

use App\Models\InventarioMantenimiento as ModelsInventarioMantenimiento;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class InventarioMantenimiento extends Component
{
    public function render()
    {
        $inventarioM = ModelsInventarioMantenimiento::all();
        return view(
            'livewire.inventario-mantenimiento',
            [
                'inventarioM' => $inventarioM
            ]
        )->extends('principal')->section('content');
    }

    public function eliminarMaterial(ModelsInventarioMantenimiento $id)
    {
        try {
            DB::beginTransaction();
            $id->delete();
            $this->dispatchBrowserEvent('error_general', ['errorr' => 'Se elimino!', 'icon' => 'success']);
            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function registra_producto($invt)
    {
        try {
            DB::beginTransaction();

            $messages = [
                'nombre.required' => 'El nombre es obligatorio.',
                'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
                'fecha_ingreso.date' => 'La fecha de ingreso debe ser una fecha válida.',
                'cantidad.required' => 'La cantidad es obligatoria.',
                'cantidad.numeric' => 'La cantidad debe ser un valor numérico.',
                'cantidad.min' => 'La cantidad debe ser al menos :min.',
                'descripcion.required' => 'La descripción es obligatoria.',
            ];

            $validator = Validator::make($invt, [
                'nombre' => 'required',
                'fecha_ingreso' => 'required|date',
                'cantidad' => 'required|numeric|min:0',
                'descripcion' => 'required',
            ], $messages);

            if ($validator->fails()) {
                // El nombre no pasa la validación
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(), 'icon' => 'info']);
                DB::rollBack();
            } else {
                $produc = ModelsInventarioMantenimiento::create([
                    'nombre' =>  $invt['nombre'],
                    'fecha_ingreso' =>  $invt['fecha_ingreso'],
                    'cantidad' =>  $invt['cantidad'],
                    'descripcion' =>  $invt['descripcion'],
                    'estado' =>  'Bueno',
                ]);
                $this->dispatchBrowserEvent('error_general', ['errorr' => 'Registro creado con exito', 'icon' => 'success']);
                DB::commit();
            }
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function editar_producto(ModelsInventarioMantenimiento $produc, $invt)
    {

        try {
            DB::beginTransaction();

            $messages = [
                'nombre.required' => 'El nombre es obligatorio.',
                'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
                'fecha_ingreso.date' => 'La fecha de ingreso debe ser una fecha válida.',
                'cantidad.required' => 'La cantidad es obligatoria.',
                'cantidad.numeric' => 'La cantidad debe ser un valor numérico.',
                'cantidad.min' => 'La cantidad debe ser al menos :min.',
                'descripcion.required' => 'La descripción es obligatoria.',
            ];

            $validator = Validator::make($invt, [
                'nombre' => 'required',
                'fecha_ingreso' => 'required|date',
                'cantidad' => 'required|numeric|min:0',
                'descripcion' => 'required',
            ], $messages);

            if ($validator->fails()) {
                // El nombre no pasa la validación
                $errors = $validator->errors();
                $this->dispatchBrowserEvent('error_general', ['errorr' => $validator->errors()->all(), 'icon' => 'info']);
                DB::rollBack();
            } else {
                $produc->nombre =  $invt['nombre'];
                $produc->fecha_ingreso =  $invt['fecha_ingreso'];
                $produc->cantidad =  $invt['cantidad'];
                $produc->descripcion =  $invt['descripcion'];
                $produc->estado =  $invt['estado'];

                $produc->save();
                $this->dispatchBrowserEvent('error_general', ['errorr' => 'Registro actualizado con exito', 'icon' => 'success']);
                DB::commit();
            }
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general', ['errorr' => $th->getMessage(), 'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function invetario_material($estado, Request $request)
    {
        if ($request->id == 0) {
            $mostrar_inventario = ModelsInventarioMantenimiento::where('estado', $estado)->get();
        } else {
            $mostrar_inventario = ModelsInventarioMantenimiento::where('estado', $estado)->whereRaw('id = ?', [$request->id])->get();
        }

        return response()->json([
            'data' => $mostrar_inventario,
            'estatus' => Response::HTTP_OK,
        ], Response::HTTP_OK);
    }
}
