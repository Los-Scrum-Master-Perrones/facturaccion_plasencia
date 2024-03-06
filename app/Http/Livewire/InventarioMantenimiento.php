<?php

namespace App\Http\Livewire;

use App\Models\InventarioMantenimiento as ModelsInventarioMantenimiento;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InventarioMantenimiento extends Component
{
    public function render()
    {
        $inventarioM = ModelsInventarioMantenimiento::all();
        return view('livewire.inventario-mantenimiento',
        [
             'inventarioM'=>$inventarioM
        ])->extends('principal')->section('content');
    }

    public function eliminarMaterial(ModelsInventarioMantenimiento $id )
    {
        $id->delete();
    }

    public function registra_producto($invt) {

        try {
            DB::beginTransaction();

            $produc = ModelsInventarioMantenimiento::create([
                'nombre' =>  $invt['nombre'],
                'fecha_ingreso' =>  $invt['fecha_ingreso'],
                'cantidad' =>  $invt['cantidad'],
                'descripcion' =>  $invt['descripcion'],
                'estado' =>  'Bueno',
            ]);

            $this->dispatchBrowserEvent('error_general',['errorr' => 'Registro creado con exito','icon' => 'success']);

            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general',['errorr' => $th->getMessage(),'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function editar_producto(ModelsInventarioMantenimiento $produc, $invt) {

        try {
            DB::beginTransaction();

            $produc->nombre =  $invt['nombre'];
            $produc->fecha_ingreso =  $invt['fecha_ingreso'];
            $produc->cantidad =  $invt['cantidad'];
            $produc->descripcion =  $invt['descripcion'];
            $produc->estado =  $invt['estado'];

            $produc->save();

            $this->dispatchBrowserEvent('error_general',['errorr' => 'Registro creado con exito','icon' => 'success']);

            DB::commit();
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error_general',['errorr' => $th->getMessage(),'icon' => 'error']);
            DB::rollBack();
        }
    }

    public function invetario_material($estado, Request $request){
        if($request->id == 0){
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
