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
        $borrar = DB::table('item_faltantes')->delete();
        (new pedidoImport)->import($request->select_file);

        return redirect()->route('import_excel');
    }

    function vaciar_import_excel()
    {
       
        $borrar = DB::table('pedidos')->delete();
        $pedido_completo =  DB::select('call mostrar_pedido');
        $verificar = DB::select('call verificar_item_clase');
        return redirect()->route('import_excel');
    }


    function nuevo_pedido(Request $request)
    {

        $pedido_completo =  DB::select('call mostrar_pedido');
        $verificar = DB::select('call verificar_item_clase');
        $nuevo_pedido = DB::select('call insertar_nuevo_pedido(:item,:paquetes,:unidades,:orden,:cate)', [
            'item' => $request->item,
            'paquetes' => $request->paquetes,
            'unidades' => $request->unidades,
            'orden' => $request->orden,
            'cate' => $request->categoria
        ]);
        
        return redirect()->route('import_excel');
      }
}
