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

    function vaciar_import_excel()
    {
        $borrar = DB::table('pedidos')->delete();
        $pedido_completo =  DB::select('call mostrar_pedido');
        $verificar = \DB::select('call verificar_item_clase');
        return view('import_excel')->with('success', 'Importación realizada con éxito!')->with('pedido_completo', $pedido_completo)->with('verificar', $verificar);
    }


    function nuevo_pedido(Request $request)
    {

        $pedido_completo =  DB::select('call mostrar_pedido');
        $verificar = \DB::select('call verificar_item_clase');
        $nuevo_pedido = DB::select('call insertar_nuevo_pedido(:item,:paquetes,:unidades,:orden,:cate)', [
            'item' => $request->item,
            'paquetes' => $request->paquetes,
            'unidades' => $request->unidades,
            'orden' => $request->orden,
            'cate' => $request->categoria
        ]);
        return view('import_excel')->with('nuevo_pedido ', $nuevo_pedido)->with('pedido_completo', $pedido_completo)->with('verificar', $verificar);
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

        $detalles_produ = 0;
        $conteo = 0;

        for ($id = 0; $id < count($pedido_completo); $id++) {
            if ($detalles_produ == 0) {
                $detalles_produ = DB::select(
                    'call traer_numero_detalles_productos(:item)',
                    ['item' => $pedido_completo[$id]->item]
                )[0]->tuplas;
                if ($detalles_produ > 0) {
                    $pedido_completo[$id]->descripcion = $pedido_completo[$id]->descripcion." ".
                    DB::select('CALL `traer_numero_detalles_productos_datos`(:item,:tupla)', 
                    ['item'=>$pedido_completo[$id]->item , 'tupla'=>$conteo])[0]->nombre;
                    $conteo++;
                }
            } else {
                $pedido_completo[$id]->descripcion = $pedido_completo[$id]->descripcion." ".
                    DB::select('CALL `traer_numero_detalles_productos_datos`(:item,:tupla)', 
                    ['item'=>$pedido_completo[$id]->item , 'tupla'=>$conteo])[0]->nombre;
                    $conteo++;

                $valor_nuevo = $detalles_produ - 1;

                if($conteo ==  $valor_nuevo){
                    $detalles_produ = 0;
                    $conteo = 0;
                }
            }
        }

        $verificar = \DB::select('call verificar_item_clase');
        return view('import_excel')->with('pedido_completo', $pedido_completo)->with('verificar', $verificar);
    }
}
