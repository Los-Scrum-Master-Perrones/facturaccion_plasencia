<?php

namespace App\Http\Controllers\Pendiente;

use App\Http\Controllers\Controller;
use App\Models\pendiente;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PendienteComprobarEmpaque extends Controller
{

    public function mostra_detalles_pendiente_empaque($id)
    {

        $detalle = pendiente::find($id);

        $detalle_pendiente_empaque = DB::select('CALL mostrar_detalle_pendiente_empaque_no_ligado(?,?,?)',[$detalle->item,$detalle->orden_del_sitema,$detalle->orden]);

        if(isset($detalle_pendiente_empaque[0])){

            DB::update('UPDATE pendiente_empaque SET id_pendiente_pedido= ? WHERE id_pendiente=?;', [$id,$detalle_pendiente_empaque[0]->id_pendiente]);


            return response()->json([
                'data' => json_encode($detalle_pendiente_empaque[0]),
                'estatus' => Response::HTTP_OK,
            ], Response::HTTP_OK);
        }
        return response()->json([
            'data' => [],
            'estatus' => Response::HTTP_NOT_FOUND,
        ], Response::HTTP_OK);

    }

    public function agregar_detalles_pendiente_empaque($id)
    {

        $detalle = pendiente::find($id);

        $detalle_pendiente_empaque = DB::select('call mostrar_detalle_pendiente_empaque_no_ligado(?,?,?)',[$detalle->item,$detalle->orden_del_sitema,$detalle->orden]);

        if(isset($detalle_pendiente_empaque[0])){
            return response()->json([
                'data' => [],
                'estatus' => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_OK);
        }

        DB::insert('insert into pendiente_empaque(
            pendiente_empaque.categoria,
            pendiente_empaque.item,
            pendiente_empaque.orden_del_sitema,
            pendiente_empaque.observacion,
            pendiente_empaque.presentacion,
            pendiente_empaque.mes,
        pendiente_empaque.orden,
        pendiente_empaque.marca,
        pendiente_empaque.vitola,
        pendiente_empaque.nombre,
        pendiente_empaque.capa,
        pendiente_empaque.tipo_empaque,
            pendiente_empaque.cello,
        pendiente_empaque.pendiente,
            pendiente_empaque.saldo,
            pendiente_empaque.paquetes,
        pendiente_empaque.unidades,
        pendiente_empaque.id_pendiente_pedido,
        pendiente_empaque.procesado)

            values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);
        ', [
            $detalle->categoria,
            $detalle->item,
            $detalle->orden_del_sitema,
            $detalle->observacion,
            $detalle->presentacion,
            $detalle->mes,
            $detalle->orden,
            $detalle->marca,
            $detalle->vitola,
            $detalle->nombre,
            $detalle->capa,
            $detalle->tipo_empaque,
            $detalle->cello,
            $detalle->pendiente,
            $detalle->saldo,
            $detalle->paquetes,
            $detalle->unidades,
            $id,
            'N'
        ]);

        return response()->json([
            'data' => ['respuesta'=> $detalle->item],
            'estatus' => Response::HTTP_OK,
        ], Response::HTTP_OK);

    }


}
