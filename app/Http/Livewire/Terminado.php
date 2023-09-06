<?php

namespace App\Http\Livewire;

use App\Exports\MaterialesProgramacionExportView;
use Livewire\Component;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

use App\Exports\ProgramcionExport;
use App\Exports\RemisionTerminado;
use App\Exports\ProgramacionTerminadoExport;
use Illuminate\Support\Facades\DB;
use Spatie\Browsershot\Browsershot;

class Terminado extends Component
{
    public $programaciones;
    public $detalles_programaciones;
    public $id_tov;
    public $titulo;
    public $item_b;
    public $id_d;
    public $borrar;
    public $busqueda;
    public $detallestodos;
    public $idp;
    public $saldo;
    public $id_pen;
    public $id_tov_imprimir;
    public $fecha;

    public $materiales = false;

    public function render()
    {

        $this->programaciones = DB::select('call mostrar_programacion(:pa_fecha)',
    [
        'pa_fecha' => $this->fecha
    ]);

        $this->detalles_programaciones = DB::select(
            'call mostrar_detalles_programacion_terminado(:buscar,:id)',
            [
                'buscar' =>  $this->busqueda,
                'id' => $this->id_tov
            ]
        );

        $this->titulo = DB::select('call max_programacion(:id)', [
            'id' => $this->id_tov
        ]);

        foreach ($this->detalles_programaciones as $key => $value) {


            if($value->sampler == 'si'){
                $value->marca = $value->descripcion_sampler.' '. $value->marca;
            }

        }

        $this->dispatchBrowserEvent('tamanio_tabla');

        return view('livewire.programacionterminado')->extends('principal')->section('content');
    }


    public function mount()
    {
        $this->id_tov = 0;
        $this->borrar = [];
        $this->programaciones = [];
        $this->detalles_programaciones = [];
        $this->busqueda = "";
        $this->idp = 0;
        $this->saldo = 0;
        $this->id_pen = 0;
        $this->detallestodos = [];
        $this->titulo = [];
        $this->id_d = 0;
        $this->id_tov_imprimir = 0;
        $this->fecha = Carbon::now()->format('Y-m-d');
    }



    public function ver($id)
    {
        $this->id_tov = $id;
        $this->id_tov_imprimir = $id;
    }

    public function item($marca, $size, $shape, $wrapper, $packing, $quantity, $item, $id)
    {
        $conca = 'RP-'.$item;
        $this->item_b = $conca;
        $this->id_d = $id;
        $this->dispatchBrowserEvent('xxx', ['marca' => $marca,
        'size' => $size,'shape' => $shape,'wrapper' => $wrapper,
        'packing' => $packing,'quantity' => $quantity,'item' => $item]);
    }


    public function eliminar_detalles_pro(Request $request)
    {


        $cant_tipo = DB::select(
            'call traer_cant_cajas(:id_pendiente)',
            ['id_pendiente' => $request->id_pendientee]
        );

        if ($cant_tipo[0]->cajas_tipo != null) {

            $cajas_vie = ($request->saldo_viejo / $cant_tipo[0]->cajas_tipo);

            $actualizar_existencia =  ($cajas_vie + $request->cant_cajase);
        } else {
            $actualizar_existencia = 0;
        }



        DB::select(
            'call eliminar_detalle_programacion(:id,:id_pendiente,:saldo,:cant)',
            [
                'id' =>  $request->ide,
                'id_pendiente' => $request->id_pendientee,
                'saldo' => $request->saldoe,
                'cant' => $actualizar_existencia
            ]
        );



        return redirect()->route('historial_programacion');
    }




    public function actualizar_detalles_pro(Request $request)
    {


        $saldo_final = ($request->saldo_pen - $request->saldo);

        $cant_tipo = DB::select(
            'call traer_cant_cajas(:id_pendiente)',
            ['id_pendiente' => $request->id_pendiente]
        );


        $cajas_utilizadas_actual = ($request->saldo / $cant_tipo[0]->cajas_tipo); //50

        $cajas_vie = ($request->saldo_pen / $cant_tipo[0]->cajas_tipo);

        $cajas_utilizadas_viejas = $cajas_vie + $request->cant_cajas; //30



        $cajas_actualizar = ($cajas_utilizadas_viejas - $cajas_utilizadas_actual); //


        DB::select(
            'call actualizar_detalle_pendiente(:id,:id_pendiente,:saldo,:saldo_pen,:cant)',
            [
                'id' =>  $request->id_detalle,
                'id_pendiente' => $request->id_pendiente,
                'saldo' => $request->saldo,
                'saldo_pen' => $saldo_final,
                'cant' => $cajas_actualizar
            ]
        );



        return redirect()->route('historial_programacion');
    }

    public function eliminar_programacion(Request $request)
    {

        DB::select(
            'call eliminar_programacion(:id)',
            ['id' =>  $request->id_pro]
        );


        return redirect()->route('historial_programacion');
    }

    public function actualizar_programacion(Request $request)
    {



        DB::select(
            'call actualizar_programacion(:id,:con)',
            [
                'id' =>  $request->id_p,
                'con' => $request->saldo_p
            ]
        );



        return redirect()->route('historial_programacion');
    }


    public function updatelistos($pa_id, $pa_cantidad, $pa_item, $pa_id_programacion, $pa_numero_orden, $pa_orden)
    {
        DB::select(
            'call update_listos(:id,:cantidad,:item,:programacion,:numero_orden,:orden)',
            [
                'id' =>  $pa_id,
                'cantidad' => $pa_cantidad,
                'item' =>  $pa_item,
                'programacion' =>  $pa_id_programacion,
                'numero_orden' =>  $pa_numero_orden,
                'orden' =>  $pa_orden
            ]
        );

        //return redirect()->route('programacionterminado');
    }


    function exportProgramacion(Request $request)
    {

        if ($request->buscar === null) {
            $busqueda = "";
        } else {
            $busqueda =  $request->buscar;
        }
        return Excel::download(new ProgramacionTerminadoExport($busqueda, $request->id_tov), 'ProgramaciónTerminado.xlsx');
    }



    public function imprimir_programacion()
    {

        $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y');



        $ffecha = Carbon::now();
        $fecha_imp = $ffecha->format('d-m-Y/h:i');


        $depros = DB::select(
            'call mostrar_detalles_programacion(:buscar,:id)',
            [
                'buscar' => $this->busqueda,
                'id' => $this->id_tov_imprimir
            ]
        );


        return redirect()->route('imprimir_detalles', ['fecha' => $fecha, 'depros' => $depros]);
    }

    public function imprimir_materiales()
    {

        $this->materiales_programacion = DB::select('call exportar_materiales_programacion(?)', [$this->id_tov]);

        $vista =  view('Exports.materiales-programacion-export', [
            'materiales' => $this->materiales_programacion
        ]);

        $fecha_programa = DB::select('SELECT prograamacion.fecha FROM prograamacion  WHERE prograamacion.id  = ?', [$this->id_tov]);
        return Excel::download(new MaterialesProgramacionExportView($vista,'Materiales'), 'Materiales ('. $fecha_programa[0]->fecha.').xlsx');
    }

    public function ExcelDiario(Request $request)
    {
        $fecha = Carbon::parse($request->fecha)->format('Y-m-d');
        return Excel::download(new RemisionTerminado($fecha), 'RemisionTerminado.xlsx');
    }
}
