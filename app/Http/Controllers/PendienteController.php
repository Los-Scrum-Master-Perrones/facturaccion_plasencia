<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendienteController extends Controller
{
    public function pendiente_index(Request $request){
        
        $insertar_pendiente = \DB::select('call insertar_pendiente');  
        
        $datos_pendiente =  \DB::select('call mostrar_pendiente');  
        

        return view('pendiente')->with('insertar_pendiente',$insertar_pendiente )->with('datos_pendiente' ,$datos_pendiente);
     }

}
