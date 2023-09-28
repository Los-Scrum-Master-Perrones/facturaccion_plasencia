<?php

namespace App\Imports;

use App\Models\capa_producto;
use App\Models\marca_producto;
use App\Models\nombre_producto;
use App\Models\Produccion;
use App\Models\ProduccionOrden;
use App\Models\vitola_producto;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProducidoPreciosImport implements ToCollection, WithCalculatedFormulas
{

    use Importable;
    public function collection(Collection $rows)
    {
        $orden = '';
        $fecha = '';
        foreach ($rows as $key => $row) {

            if ($row[0] === 'CODIGO') {
                continue;
            }

            if ($row[1] === 'Muestras') {
                continue;
            }

            $marca = marca_producto::updateOrCreate(
                ['marca' => $row[1]],
                ['marca' => $row[1]]
            );
            $nombre = nombre_producto::updateOrCreate(
                ['nombre' => $row[2]],
                ['nombre' => $row[2]]
            );
            $vitola = vitola_producto::updateOrCreate(
                ['vitola' => $row[3]],
                ['vitola' => $row[3]]
            );
            $capa = capa_producto::updateOrCreate(
                ['capa' => $row[4]],
                ['capa' => $row[4]]
            );

            $producto = Produccion::updateOrCreate(
                ['codigo' => $row[0]],
                [
                    'id_marca' => $marca->id_marca,
                    'id_nombre' => $nombre->id_nombre,
                    'id_vitola' => $vitola->id_vitola,
                    'id_capa' => $capa->id_capa,
                    'precio_bonchero' => $row[5],
                    'precio_rolero' => $row[6],
                    'existencia' => 0,
                ]
            );
        }
    }
}
