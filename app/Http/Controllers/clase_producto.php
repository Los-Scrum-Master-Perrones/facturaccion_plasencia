<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class clase_producto extends Controller
{
    public function insertar_clase(Request $request)  {
       
        if($request->cello="null"){
            $cello = "no";
        }else{
            $cello = $request->cello;
        }

        if($request->anillo="null"){
            $anillo = "no";
        }else{
            $anillo = $request->anillo;
        }

        if($request->upc="null"){
            $upc = "no";
        }else{
            $upc = $request->upc;
        }
       
        $clase_producto = \DB::select('call insertar_clase_producto(:item,:capa,:vitola,:nombre,:marca,:cello,:anillo,:upc,:tipo)',
             [ 'item' => $request->item,
            'capa' =>  $request->capa,
            'vitola' => $request->vitola,
            'nombre' => $request->nombre,
            'marca' => $request->marca,
            'cello' => $cello,
            'anillo'=> $anillo,
            'upc'=> $upc,
            'tipo' => $request->tipo
             ]);



            return view('productos')->with('clase_producto', $clase_producto);
    }

}
