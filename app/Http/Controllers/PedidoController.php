<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Imports\pedidoImport;
use Maatwebsite\Excel\Facades\Excel;

class PedidoController extends Controller
{
    public function import(Request $request)
    {
        (new pedidoImport)->import($request->select_file);
        $pedido_completo =  DB::select('call mostrar_pedido');
        $verificar = \DB::select('call verificar_item_clase');
        return view('import_excel')->with('success', 'Importación realizada con éxito!')->with('pedido_completo', $pedido_completo)->with('verificar', $verificar);
    }

    function vaciar_import_excel(){
        $borrar = DB::table('pedidos')->delete();
        $pedido_completo =  DB::select('call mostrar_pedido');
        $verificar = \DB::select('call verificar_item_clase');
        return view('import_excel')->with('success', 'Importación realizada con éxito!')->with('pedido_completo', $pedido_completo)->with('verificar', $verificar);
     }



     



    function buscar(Request $request)
    {

        if ($request->busqueda === null) {
            $i = "0";
        } else {
            $i = $request->busqueda;
        }

        $pedido_completo =  DB::select(
            'call buscar_pedidos(:item)',
            ['item' => $i]
        );
        
        $verificar = \DB::select('call verificar_item_clase');
        return view('import_excel')->with('pedido_completo', $pedido_completo)->with('verificar', $verificar);
    }
}
