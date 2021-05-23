<?php

namespace App\Http\Controllers;

use App\Exports\PendienteExport;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class PendienteController extends Controller
{
    var $datos_pendiente;


    public function pendiente_indexi(Request $request)
    {
        $pedido_completo =  DB::select(
            'call buscar_pedidos(:item)',
            ['item' => "0"]
        );

        $detalles_produ = 0;
        $conteo = 0;
        $ids = 0;

        for ($id = 0; $id < count($pedido_completo); $id++) {
            if ($detalles_produ == 0) {
                $detalles_produ = DB::select(
                    'call traer_numero_detalles_productos(:item)',
                    ['item' => $pedido_completo[$id]->item]
                )[0]->tuplas;
                if ($detalles_produ > 0) {

                    $ids =  DB::select('CALL `traer_numero_detalles_productos_ids`(:tupla,:item)', 
                    [ 'tupla'=>$conteo, 'item'=>$pedido_completo[$id]->item ])[0];

                    $insertar_pendiente_empaque =   \DB::select(
                        'call insertar_pendente_empaque(:categoria, 
                        :item,
                        :orden_del_sitema,
                        :observacion, 
                        :presentacion, 
                        :mes,
                        :orden, 
                        :marca,
                        :vitola, 
                        :nombre, 
                        :capa, 
                        :tipo_empaque,  
                        :cello, 
                        :pendiente, 
                        :saldo, 
                        :paquetes, 
                        :unidades)',
                        [
                            'categoria' => $pedido_completo[$id]->categoria,
                            'item' => $pedido_completo[$id]->item,
                            'orden_del_sitema' => "",
                            'observacion' => "",
                            'presentacion' => "",
                            'mes' => (string)$request->fecha,
                            'orden' => $pedido_completo[$id]->numero_orden,
                            'marca' =>  $ids->id_marca,
                            'vitola' =>  $ids->id_vitola,
                            'nombre' =>  $ids->id_nombre,
                            'capa' =>  $ids->id_capa,
                            'tipo_empaque' =>  $ids->id_tipo_empaque,
                            'cello' =>  $ids->id_cello,
                            'pendiente' => $pedido_completo[$id]->total,
                            'saldo' => $pedido_completo[$id]->total,
                            'paquetes' => $pedido_completo[$id]->cant_paquetes,
                            'unidades' => $pedido_completo[$id]->unidades
                        ]
                    );
                    $conteo++;
                }
            } else {
                $detalles_produ = DB::select(
                    'call traer_numero_detalles_productos(:item)',
                    ['item' => $pedido_completo[$id]->item])[0]->tuplas;
                if ($detalles_produ > 0) {

                    $ids =  DB::select('CALL `traer_numero_detalles_productos_ids`(:item,:tupla)', 
                    ['item'=>$pedido_completo[$id]->item , 'tupla'=>$conteo])[0];

                    $insertar_pendiente_empaque =   \DB::select(
                        'call insertar_pendiente(:categoria, 
                        :item,
                        :orden_del_sitema,
                        :observacion, 
                        :presentacion, 
                        :mes,
                        :orden, 
                        :marca,
                        :vitola, 
                        :nombre, 
                        :capa, 
                        :tipo_empaque,  
                        :cello, 
                        :pendiente, 
                        :saldo, 
                        :paquetes, 
                        :unidades)',
                        [
                            'categoria' => $pedido_completo[$id]->categoria,
                            'item' => $pedido_completo[$id]->item,
                            'orden_del_sitema' => "",
                            'observacion' => "",
                            'presentacion' => "",
                            'mes' => (string)$request->fecha,
                            'orden' => $pedido_completo[$id]->numero_orden,
                            'marca' =>  $ids->id_marca,
                            'vitola' =>  $ids->id_vitola,
                            'nombre' =>  $ids->id_nombre,
                            'capa' =>  $ids->id_capa,
                            'tipo_empaque' =>  $ids->id_tipo_empaque,
                            'cello' =>  $ids->id_cello,
                            'pendiente' => $pedido_completo[$id]->total,
                            'saldo' => $pedido_completo[$id]->total,
                            'paquetes' => $pedido_completo[$id]->cant_paquetes,
                            'unidades' => $pedido_completo[$id]->unidades
                        ]
                    );
                    $conteo++;

                    $valor_nuevo = $detalles_produ - 1;

                    if($conteo ==  $valor_nuevo){
                        $detalles_produ = 0;
                        $conteo = 0;
                    }
                }
            }
        }
        $datos_pendiente =  \DB::select('call mostrar_pendiente');

        return view('pendiente')->with('insertar_pendiente', $insertar_pendiente)->with('datos_pendiente', $datos_pendiente);
    }


    public function pendiente_index(Request $request)
    {

        $datos_pendiente =  \DB::select('call mostrar_pendiente');

        return view('pendiente')->with('datos_pendiente', $datos_pendiente);
    }



    public function buscar(Request $request)
    {
        if ($request->fecha_de == null) {
            $fede = "0";
        } else {
            $fede = $request->fecha_de;
        }

        if ($request->fecha_hasta === null) {
            $feha = "0";
        } else {
            $feha = $request->fecha_hasta;
        }


        if ($request->nombre == null) {
            $nom = "0";
        } else {
            $nom = $request->nombre;
        }

        $datos_pendiente = \DB::select(
            'call buscar_pendiente(:nombre,:fechade,:fechahasta)',
            [
                'nombre' => (string)$nom,
                'fechade' => (string)$fede,
                'fechahasta' => (string)$feha
            ]
        );


        return view('pendiente')->with('datos_pendiente', $datos_pendiente)
            ->with('nom', $nom)
            ->with('fede', $fede)
            ->with('feha', $feha);
    }

    

    function exportPendiente(Request $request)
    {
        if ($request->fecha_de == null) {
            $fede = "0";
        } else {
            $fede = $request->fecha_de;
        }

        if ($request->fecha_hasta === null) {
            $feha = "0";
        } else {
            $feha = $request->fecha_hasta;
        }


        if ($request->nombre == null) {
            $nom = "0";
        } else {
            $nom = $request->nombre;
        }
        return Excel::download(new PendienteExport($nom, $fede, $feha), 'Pendiente.xlsx');
    }
}
