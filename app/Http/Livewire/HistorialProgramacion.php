<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

use App\Exports\ProgramcionExport;

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

    public function render()
    {

        $this->programaciones= \DB::select('call mostrar_programacion()');

        $this->detalles_programaciones=\DB::select('call mostrar_detalles_programacion(:buscar,:id)',
        ['buscar'=>  $this->busqueda,
        'id'=>$this->id_tov]);

        $this->titulo = \DB::select('call max_programacion(:id)',[
            'id'=>$this->id_tov
        ]);

        $this->detallestodos =  \DB::select('select * from detalle_programacion');
        return view('livewire.historial-programacion')->extends('principal')->section('content');
    }


    public function mount()
    {
        $this->id_tov = 0;
        $this->borrar=[];
         $this->programaciones= [];
         $this->detalles_programaciones=[];
         $this->busqueda = "";
         $this->idp =0 ;
         $this->saldo =0;
         $this->id_pen =0;
         $this->detallestodos = [];
         $this->titulo =[];
         $this->id_tov_imprimir = 0;
    }



    public function ver($id){
        $this->id_tov = $id;
        $this->id_tov_imprimir =$id;
    }


    public function eliminar_detalles_pro(Request $request){


        $cant_tipo =\DB::select('call traer_cant_cajas(:id_pendiente)',
        [ 'id_pendiente'=>$request->id_pendientee]);

        if($cant_tipo[0]->cajas_tipo != null){

            $cajas_vie = ($request->saldo_viejo/ $cant_tipo[0]->cajas_tipo);

            $actualizar_existencia =  ($cajas_vie + $request->cant_cajase);
        }else{
            $actualizar_existencia= 0;
        }



        $borrar=\DB::select('call eliminar_detalle_programacion(:id,:id_pendiente,:saldo,:cant)',
        ['id'=>  $request->ide,
        'id_pendiente'=>$request->id_pendientee,
        'saldo'=> $request->saldoe,
        'cant'=> $actualizar_existencia]);



       return redirect()->route('historial_programacion');

        }




    public function actualizar_detalles_pro(Request $request){


        $saldo_final = ($request->saldo_pen - $request->saldo);

        $cant_tipo =\DB::select('call traer_cant_cajas(:id_pendiente)',
        [ 'id_pendiente'=>$request->id_pendiente]);


       $cajas_utilizadas_actual= ($request->saldo / $cant_tipo[0]->cajas_tipo);//50

      $cajas_vie = ($request->saldo_pen/ $cant_tipo[0]->cajas_tipo);

       $cajas_utilizadas_viejas = $cajas_vie + $request->cant_cajas;//30



       $cajas_actualizar = ($cajas_utilizadas_viejas-$cajas_utilizadas_actual);//


        $borrar=\DB::select('call actualizar_detalle_pendiente(:id,:id_pendiente,:saldo,:saldo_pen,:cant)',
        ['id'=>  $request->id_detalle,
        'id_pendiente'=>$request->id_pendiente,
        'saldo'=> $request->saldo,
        'saldo_pen'=>$saldo_final,
        'cant'=>$cajas_actualizar]);



       return redirect()->route('historial_programacion');

        }

        public function eliminar_programacion(Request $request){


            $borrar=\DB::select('call eliminar_programacion(:id)',
            ['id'=>  $request->id_pro]);



           return redirect()->route('historial_programacion');

            }

            public function actualizar_programacion(Request $request){



                $borrar=\DB::select('call actualizar_programacion(:id,:con)',
                ['id'=>  $request->id_p,
                'con'=>$request->saldo_p]);



               return redirect()->route('historial_programacion');

                }


    function exportProgramacion(Request $request)
    {



        if ($request->buscar===null){
            $bus = "";

        }else{
            $bus =  $request->buscar;
        }



        return Excel::download(new ProgramcionExport($bus, $request->id_tov), 'Programación.xlsx');
    }



    public function imprimir_programacion(){

        $fecha =Carbon::now();
        $fecha = $fecha->format('d-m-Y');



        $ffecha =Carbon::now();
        $fecha_imp = $ffecha->format('d-m-Y/h:i');


       $depros = \DB::select('call mostrar_detalles_programacion(:buscar,:id)',
       ['buscar'=> $this->busqueda,
       'id'=> $this->id_tov_imprimir]);


       return redirect()->route('imprimir_detalles',['fecha'=>$fecha,'depros'=> $depros]);



    }


}
