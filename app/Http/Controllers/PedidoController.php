<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Imports\pedidoImport;
use App\Imports\pedidoImportCatalogo;
use App\Imports\PendienteImportNuevoFormato;

class PedidoController extends Controller
{
    public function import(Request $request)
    {

        if($request->documento){
            DB::table('item_faltantes')->delete();
            (new PendienteImportNuevoFormato)->import($request->select_file);
        }else {
            DB::table('item_faltantes')->delete();
            (new pedidoImport)->import($request->select_file);
        }

        return redirect()->route('import_excel');
    }

    public function importCatlogoCompleto(Request $request)
    {


        (new pedidoImportCatalogo)->import($request->select_file);


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
        DB::select('call mostrar_pedido');
        DB::select('call verificar_item_clase');
        DB::select('call insertar_nuevo_pedido(:item,:paquetes,:unidades,:orden,:cate)', [
            'item' => $request->item,
            'paquetes' => $request->paquetes,
            'unidades' => $request->unidades,
            'orden' => $request->orden,
            'cate' => $request->categoria
        ]);

        return redirect()->route('import_excel');
      }
}
