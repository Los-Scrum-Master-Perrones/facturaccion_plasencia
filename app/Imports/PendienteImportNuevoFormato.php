<?php

namespace App\Imports;

use App\Models\clase_producto;
use App\Models\detalle_clase_producto;
use App\Models\pedido;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;


class PendienteImportNuevoFormato implements ToModel
{
    use Importable;

    public function model(array $row)
    {

        if ($row[5] == null &&  $row[8] == null &&  $row[12] == null) {
            return null;
        }

        if ($row[5] == "Item") {
            return null;
        }

        if ($row[12] == "Quantity") {
            return null;
        }

        if ($row[5] == "Total") {
            return null;
        }

        if ($row[5] == "Report Totals (USD)") {
            return null;
        }



        $sampler = clase_producto::where("item", "=", $row[5])->first();

        if (isset($sampler->sampler)) {

            if ($sampler->sampler == 'si') {
                $detalles_sampler = detalle_clase_producto::where("item", "=", $row[5])->get();
                foreach ($detalles_sampler as $key => $value) {
                    $pedio =  new pedido([
                        'item' => $row[5],
                        'cant_paquetes' => $row[12],
                        'unidades' => 1,
                        'numero_orden' => $row[1],
                        'categoria' => "1",
                    ]);
                    $pedio->save();
                }
            } else {
                $pedio =  new pedido([
                    'item' => $row[5],
                    'cant_paquetes' => $row[12],
                    'unidades' => intval($row[17]) / intval($row[12]),
                    'numero_orden' => $row[1],
                    'categoria' => "1",
                ]);
            }
        } else {
            echo $row[5];
            $pedio =  new pedido([
                'item' => $row[5],
                'cant_paquetes' => $row[12],
                'unidades' => intval($row[17]) / intval($row[12]),
                'numero_orden' => $row[1],
                'categoria' => "1",
            ]);
        }
        return $pedio;
    }
}
