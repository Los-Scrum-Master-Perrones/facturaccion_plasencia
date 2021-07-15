<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\detallesExport;
use Illuminate\Support\Facades\DB;

class DetalleProgramacion extends Component
{
    
    public $detalles_provicionales;
    public $busqueda;
    public $borrar;
    public $actualizar;
    public $actualizar_insertar;
    public $fecha;
    public $contenedor;
    public $insertar_programacion;
    public $fecha_actual;
    public $total_saldo;

    public function render()
    {
        $this->total_saldo = 0;
        $this->detalles_provicionales = DB::select('call mostrar_detalles_provicional(:buscar)', [
            'buscar' => $this->busqueda
        ]);

        for($i = 0; $i < count($this->detalles_provicionales) ;$i++){
            $this->total_saldo += $this->detalles_provicionales[$i]->saldo;
        }



        return view('livewire.detalle-programacion')->extends('principal')->section('content');
    }

    public function mount()
    {
        $this->total_saldo = 0;
        $this->detalles_provicionales = [];
        $this->borrar = [];
        $this->busqueda = "";
        $this->actualizar = [];
        $this->actualizar_insertar = [];
        $this->contenedor = "";

        $this->insertar_programacion = [];

        $this->fecha = Carbon::now()->format("Y-m-d");
    }

    public function eliminar_detalles(Request $request)
    {


        $this->detalles_provicionales = [];


        $actualizar_existencia =  ($request->saldo_viejoe + $request->cant_cajase);

        $this->borrar = DB::select(
            'call eliminar_detalles(:buscar,:id_pendiente,:cant)',
            [
                'buscar' => $request->id_usuarioE,
                'id_pendiente' => $request->id_pendientee,
                'cant' => $actualizar_existencia
            ]
        );;



        return redirect()->route('detalles_programacion');
    }


    public function modal_limpiar()
    {
        $this->dispatchBrowserEvent('abrir_modal_eliminar');
    }

    public function eliminar_datos()
    {
        DB::table('detalle_programacion_temporal')->delete();
        DB::update("ALTER TABLE detalle_programacion_temporal AUTO_INCREMENT = 1");
        $this->dispatchBrowserEvent('cerrar_modal_eliminar');
    }



    public function actualizar_saldo(Request $request)
    {

        $detalles_provicionales = DB::select('call mostrar_detalles_provicional(:buscar)', [
            'buscar' => $this->busqueda
        ]);


        $cant_tipo = DB::select(
            'call traer_cant_cajas(:id_pendiente)',
            ['id_pendiente' => $request->id_pendientea]
        );

        if( $cant_tipo == null){
            $cajas_utilizadas_actual = ($request->saldo / $cant_tipo[0]->cajas_tipo); //50

            $cajas_utilizadas_viejas = $request->cant_cajas + $request->saldo_viejo; //30



            $cajas_actualizar = ($cajas_utilizadas_viejas - $cajas_utilizadas_actual); //

        }else{
            $cajas_actualizar = 0;
        }


        $this->actualizar = DB::select(
            'call actualizar_saldo_programacion(:id, :saldo,:cant,:id_pendiente)',
            [
                'id' => $request->id_detalle,
                'saldo' => $request->saldo,
                'cant' => $cajas_actualizar,
                'id_pendiente' => $request->id_pendientea
            ]
        );




        return redirect()->route('detalles_programacion');
    }

    public function insertarDetalle_y_actualizarPendiente()
    {



        $this->detalles_provicionales = DB::select('call mostrar_detalles_provicional(:buscar)', ['buscar' => $this->busqueda]);


        $this->insertar_programacion = DB::select(
            'call insertar_programacion(:fecha,:contenedor)',
            [
                'fecha' => $this->fecha,
                'contenedor' => $this->contenedor
            ]
        );

        $this->tuplas = count($this->detalles_provicionales);

        for ($i = 0; $this->tuplas > $i; $i++) {

            $this->actualizar_insertar = DB::select(
                'call insertar_detalle_programacion(:numero_orden, :orden,:cod_producto,:saldo,:id_pendiente,:caja,:cant)',
                [
                    'numero_orden' => isset($this->detalles_provicionales[$i]->numero_orden) ? $this->detalles_provicionales[$i]->numero_orden : null,
                    'orden' => isset($this->detalles_provicionales[$i]->orden) ? $this->detalles_provicionales[$i]->orden : null,
                    'cod_producto' => isset($this->detalles_provicionales[$i]->cod_producto) ? $this->detalles_provicionales[$i]->cod_producto : null,
                    'saldo' => isset($this->detalles_provicionales[$i]->saldo) ? $this->detalles_provicionales[$i]->saldo : null,
                    'id_pendiente' => isset($this->detalles_provicionales[$i]->id_pendiente) ? $this->detalles_provicionales[$i]->id_pendiente : null,
                    'caja' => isset($this->detalles_provicionales[$i]->existencia) ? $this->detalles_provicionales[$i]->existencia : null,
                    'cant' => isset($this->detalles_provicionales[$i]->cant_cajas) ? $this->detalles_provicionales[$i]->cant_cajas : null
                ]
            );

            // $sampler = 0;
            // $detalles = 0;
            // $detalle = DB::select('CALL `traer_ultimo_detalle_programacion`()');
            // $cantidad_detalle_sampler = 0;



            // if ($detalle[0]->sampler == "si") {


            //         if ($sampler == 0 && $detalles == 0) {
            //             $datos = DB::select('call traer_numero_detalles_productos(?)', [$detalle[0]->item]);
            //             $cantidad_detalle_sampler = $datos[0]->tuplas;
            //         }

            //        $detalles++;

            //         if ($detalles == $cantidad_detalle_sampler) {
            //                $sampler_total = DB::select('call traer_suma_sampler_pendiente_empaque(?,?)', [ $detalle[0]->orden,$detalle[0]->item]);

            //                 return  $sampler_total;
            //                if($sampler_total[0]->total <= 0){
            //                 DB::update('update pendiente_empaque set procesado = ? where item = ? and orden = ?', ['s',$detalle[0]->item,$detalle[0]->orden]);

            //                }

            //             $detalles = 0;
            //             $cantidad_detalle_sampler = 0;
            //         }


            // }else{
            //     if($detalle[0]->saldo == 0){
            //         DB::update('update pendiente_empaque set procesado = ? where id_pendiente = ?', ['s',$detalle[0]->id_pendiente]);
            //     }
            // }





        }

        return redirect()->route('historial_programacion');
    }


    function exportProgramacion(Request $request)
    {
        return Excel::download(new detallesExport(), 'ProgramaciónPro.xlsx');
    }
}
