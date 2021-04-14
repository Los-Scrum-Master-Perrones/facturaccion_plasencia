<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Imports\pedidoImport;
use Maatwebsite\Excel\Facades\Excel;

class PedidoController extends Controller
{
    public function import(Request $request){
        
        (new pedidoImport)->import($request->select_file);
        
        $pedido_completo =  \DB::select('call mostrar_pedido');  

        return view('import_excel')->with('success', 'Importación realizada con éxito!')->with('pedido_completo', $pedido_completo);
    }



    public function productos_index(Request $request){

        
       $productos = \DB::select('call mostrar_productos');

       $producto_unico =  \DB::select('call mostrar_clase_paradetalle(:item)',
       ['item'=> $request->item_detalle]);

       $detalle_productos = \DB::select('call mostrar_detalles_productos');

       $producto = json_encode($productos);       


        return view('/productos')->with('productos', $productos)->with('detalle_productos', $detalle_productos)->with('producto_unico', $producto_unico);
    }



}


