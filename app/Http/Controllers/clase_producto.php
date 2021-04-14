<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class clase_producto extends Controller
{
    public function insertar_clase(Request $request)  {
       
        if(isset($request->cello)){
           
            $cello = $request->cello;
        }else{
            $cello = "no";
        }

        if(isset($request->anillo)){
            $anillo = $request->anillo;
            
        }else{
            $anillo = "no";
        }

        if(isset($request->upc)){
            $upc = $request->upc;
           
        }else{
            $upc = "no";
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

             $productos = \DB::select('call mostrar_productos');

            return view('productos')->with('clase_producto', $clase_producto)->with('productos', $productos);
    }

    public function insertar_detalle_clase(Request $request)  {
       
        if(isset($request->cello_de)){
           
            $cello = $request->cello_de;
        }else{
            $cello = "no";
        }

        if(isset($request->anillo_de)){
            $anillo = $request->anillo_de;
            
        }else{
            $anillo = "no";
        }

        if(isset($request->upc_de)){
            $upc = $request->upc_de;
           
        }else{
            $upc = "no";
        }
       

        $detalle_clase_producto = \DB::select('call insertar_detalle_clase_producto(:item,:capa,:vitola,:nombre,:marca,:cello,:anillo,:upc,:tipo,:precio)',
             [ 'item' => $request->item_de,
            'capa' =>  $request->capa_de,
            'vitola' => $request->vitola_de,
            'nombre' => $request->nombre_de,
            'marca' => $request->marca_de,
            'cello' => $cello,
            'anillo'=> $anillo,
            'upc'=> $upc,
            'tipo' => $request->tipo_de,
            'precio' => $request->precio_de
             ]);

             $productos = \DB::select('call mostrar_productos');

            return redirect('/productos')->with('detalle_clase_producto', $detalle_clase_producto)->with('productos', $productos);
    }



 public function detalle_productos_index(Request $request){
        
    $producto_unico =  \DB::select('call mostrar_clase_paradetalle(:item)',
    ['item'=> $request->item_detalle]);

    $productos = \DB::select('call mostrar_productos');
       $detalle_productos = \DB::select('call mostrar_detalles_productos');

        return view('productos')->with('detalle_productos', $detalle_productos)->with('producto_unico', $producto_unico)->with('productos', $productos);
    }



}
