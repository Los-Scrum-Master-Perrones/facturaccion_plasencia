<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendienteController extends Controller
{
    public function pendiente_indexi(Request $request){

    $insertar_pendiente = \DB::select('call insertar_pendiente(:fecha)',
        ['fecha'=>(String)$request->fecha]);  
        
        $datos_pendiente =  \DB::select('call mostrar_pendiente');  

        return view('pendiente')->with('insertar_pendiente',$insertar_pendiente )->with('datos_pendiente' ,$datos_pendiente);
     }


     public function pendiente_index(Request $request){

        
            $datos_pendiente =  \DB::select('call mostrar_pendiente');  
    
            return view('pendiente')->with('datos_pendiente' ,$datos_pendiente);
         }



         public function buscar(Request $request){
            if($request->fechade == null){
                $fede = "0";
            }else{
                $fede = $request->fechade;
            }

            if($request->fechahasta === ""){
                $feha = "hola";
            }else{
                $feha = $request->fechahasta;
            }


            if($request->nombre == null){
                $nom = "0";
            }else{
                $nom = $request->nombre;
            }

            return $feha;
            $buscar = \DB::select('call buscar_pendiente(:nombre,:fechade,:fechahasta)',
        ['nombre'=>$nom,
        'fechade'=>$fede,
        'fechahasta'=>$feha
        ]);  

      
        
        $datos_pendiente =  \DB::select('call mostrar_pendiente');  

    
            return REDIRECT('/pendiente')->with('datos_pendiente' ,$datos_pendiente)->with('buscar' ,$buscar);
         }


}
