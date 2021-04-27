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



 function buscar(Request $request){

if($request->busqueda ===null){
$i = "0";
}else{
   $i= $request->busqueda;
}



        $pedido_completo =  \DB::select('call buscar_pedidos(:item)',
        ['item'=> $i]);

        return view('import_excel')->with('pedido_completo', $pedido_completo);
    }


}