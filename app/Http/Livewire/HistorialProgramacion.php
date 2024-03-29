<?php

namespace App\Http\Livewire;

use App\Exports\MaterialesProgramacionExportView;
use App\Exports\ProgramcionExport;
use App\Models\DetalleProgramacion;
use App\Models\EntradasSalida;
use App\Models\ListaCajas;
use App\Models\Prograamacion;
use Livewire\Component;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\DB;

class HistorialProgramacion extends Component
{
    public $programaciones;
    public $detalles_programaciones;
    public $id_tov;
    public $titulo;
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
            'call mostrar_detalles_programacion(:buscar,:id)',
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

        return view('livewire.historial-programacion')->extends('principal')->section('content');
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
        $this->id_tov_imprimir = 0;
        $this->fecha = Carbon::now()->format('Y-m-d');
    }



    public function ver($id)
    {
        $this->id_tov = $id;
        $this->id_tov_imprimir = $id;
    }


    public function eliminar_detalles_pro(DetalleProgramacion $detalle)
    {
        $programacion = Prograamacion::find($detalle->id_programacion);

        if( is_null($detalle->codigo_caja) ){
            $cant_tipo = DB::select(
                'call traer_cant_cajas(:id_pendiente)', ['id_pendiente' => $detalle->id_pendiente]
            );
                if ($cant_tipo[0]->cajas_tipo != null) {
                    $restantes = explode(" ", $detalle->cajas);

                    if($restantes[0] == 'Faltan'){
                        if($detalle->cant_cajas == $restantes[1]){



                        }elseif($detalle->cant_cajas < $restantes[1]){
                            $caja = ListaCajas::where('codigo','=',$detalle->codigo_caja)->first();

                            $salida = EntradasSalida::where('codigo','=',$detalle->codigo_caja)->where('descripcion','=',$programacion->mes_contenedor)->first();

                            ListaCajas::where('codigo','=','')->update([]);
                        }
                    }


                } else {

                }
        }







        // DB::select(
        //     'call eliminar_detalle_programacion(:id,:id_pendiente,:saldo,:cant)',
        //     [
        //         'id' =>  $request->ide,
        //         'id_pendiente' => $request->id_pendientee,
        //         'saldo' => $request->saldoe,
        //         'cant' => $actualizar_existencia
        //     ]
        // );



        // return redirect()->route('historial_programacion');
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


    function exportProgramacion(Request $request)
    {



        if ($request->buscar === null) {
            $bus = "";
        } else {
            $bus =  $request->buscar;
        }



        return Excel::download(new ProgramcionExport($bus, $request->id_tov), 'Programación.xlsx');
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

        $materiales_programacion = DB::select('call exportar_materiales_programacion(?)', [$this->id_tov]);

        $vista =  view('Exports.materiales-programacion-export', [
            'materiales' => $materiales_programacion
        ]);

        $fecha_programa = DB::select('SELECT prograamacion.fecha FROM prograamacion  WHERE prograamacion.id  = ?', [$this->id_tov]);
        return Excel::download(new MaterialesProgramacionExportView($vista,'Materiales'), 'Materiales ('. $fecha_programa[0]->fecha.').xlsx');
    }
}
