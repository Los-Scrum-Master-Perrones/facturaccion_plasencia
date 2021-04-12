<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Imports\pedidoImport;
use Maatwebsite\Excel\Facades\Excel;

class PedidoController extends Controller
{
    public function import(Request $request){
        
        (new pedidoImport)->import($request->select_file);
        

        return redirect('/importar_pedido')->with('success', 'File imported successfully!');
    }



    public function productos_index(Request $request){
        
       $productos = \DB::select('call mostrar_productos');
        return view('/productos')->with('productos', $productos);
    }



}


