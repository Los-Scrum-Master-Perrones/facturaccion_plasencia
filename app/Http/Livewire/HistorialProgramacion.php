<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

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
    }



    public function ver($id){
        $this->id_tov = $id;
    }


    public function eliminar_detalles_pro(Request $request){
    

        $borrar=\DB::select('call eliminar_detalle_programacion(:id,:id_pendiente,:saldo)',
        ['id'=>  $request->ide,
        'id_pendiente'=>$request->id_pendientee,
        'saldo'=> $request->saldoe]);
        


       return redirect()->route('historial_programacion'); 
    
        }


       
        
    public function actualizar_detalles_pro(Request $request){
   

        $saldo_final = ($request->saldo_pen - $request->saldo);

        


        $borrar=\DB::select('call actualizar_detalle_pendiente(:id,:id_pendiente,:saldo,:saldo_pen)',
        ['id'=>  $request->id_detalle,
        'id_pendiente'=>$request->id_pendiente,
        'saldo'=> $request->saldo,
        'saldo_pen'=>$saldo_final]);
        
    

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
   
}
