<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Exports\PendienteExport;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;


class Pendiente extends Component
{

    public $datos_pendiente;
    public $nom;
    public $fede;
    public $fecha;
    public $busqueda;
    public $borrar;
    public $actualizar;

    public function render()
    {

        $this->datos_pendiente = DB::select('call buscar_pendiente(:nombre,:fechade,:fechahasta)',
            [
                'nombre' =>  $this->nom,
                'fechade' =>  $this->fede,
                'fechahasta' => $this->fecha
            ]
        );
        
        return view('livewire.pendiente')->extends('principal')->section('content');
    }


    public function mount(){
 

        $this->datos_pendiente = [];
        $this->nom = "";
        $this->fede = "";
        $this->fecha = "";
        $this->borrar = [];
        $this->actualizar= [];

        $this->datos_pendiente = DB::select(
            'call buscar_pendiente(:nombre,:fechade,:fechahasta)',
            [
                'nombre' =>  $this->nom,
                'fechade' =>  $this->fede,
                'fechahasta' => $this->fecha
            ]
        );

      


    }
   


    public function pendiente_indexi(Request $request)
    {

        $insertar_pendiente_empaque =   \DB::select(
            'call insertar_pendente_empaque(:fecha)',
            ['fecha' => (string)$request->fecha]
        );

        $insertar_pendiente = DB::select(
            'call insertar_pendiente(:fecha)',
            ['fecha' => (string)$request->fecha]
        );

        $this->datos_pendiente = DB::select(
            'call buscar_pendiente(:nombre,:fechade,:fechahasta)',
            [
                'nombre' =>  $this->nom,
                'fechade' =>  $this->fede,
                'fechahasta' => $this->fecha,
            ]
        );
        return redirect()->route('pendiente')->with('insertar_pendiente', $insertar_pendiente)->with('insertar_pendiente_empaque', $insertar_pendiente_empaque);
    }


    public function pendiente_index(Request $request)
    {

        $this->datos_pendiente=  \DB::select('call mostrar_pendiente');

        return redirect()->route('pendiente');
    }


   


    public function buscar(Request $request)
    {
        if ($request->fecha_de == null) {
            $fede = "0";
        } else {
            $fede = $request->fecha_de;
        }

        if ($request->fecha_hasta === null) {
            $feha = "0";
        } else {
            $feha = $request->fecha_hasta;
        }


        if ($request->nombre == null) {
            $nom = "0";
        } else {
            $nom = $request->nombre;
        }

        $this->datos_pendiente = DB::select(
            'call buscar_pendiente(:nombre,:fechade,:fechahasta)',
            [
                'nombre' =>  $this->nom,
                'fechade' =>  $this->fede,
                'fechahasta' => $this->fecha,
            ]
        );


        return redirect()->route('pendiente');
            
    }

    


    public function eliminar_pendiente(Request $request){

        $this->datos_pendiente =[];

    
        $this->borrar=\DB::select('call borrar_pendientes(:eliminar)',['eliminar'=>$request->id_pendiente]);

     
        return redirect()->route('pendiente'); 
    
        }

        public function actualizar_pendiente(Request $request){

          
    
        
            $this->actualizar=\DB::select('call actualizar_pendientes(:id,:item,:orden,:observacion,:presentacion)',
            ['id'=>$request->id_pendientea,
            'item'=>$request->itema,
            'orden'=>$request->orden_sistema,
            'observacion'=>$request->observacion,
            'presentacion'=>$request->presentacion,
            ]);
    
            
        $this->datos_pendiente = DB::select(
            'call buscar_pendiente(:nombre,:fechade,:fechahasta)',
            [
                'nombre' =>  $this->nom,
                'fechade' =>  $this->fede,
                'fechahasta' => $this->fecha,
            ]
        );
         
            return redirect()->route('pendiente'); 
        
            }



    function exportPendiente(Request $request)
    {
       
        return Excel::download(new PendienteExport($this->nom, $this->fede, $this->fecha), 'Pendiente.xlsx');
    }





}
