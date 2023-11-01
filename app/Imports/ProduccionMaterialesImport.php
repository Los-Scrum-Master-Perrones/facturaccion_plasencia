<?php

namespace App\Imports;


use App\Models\ProduccionMateriales;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class ProduccionMaterialesImport implements ToCollection, WithCalculatedFormulas
{

    use Importable;
    public function collection(Collection $rows)
    {
        $datos = [];
        $marca = '';
        $nombre = '';
        $vitola = '';
        $capa = '';
        $banda = '';
        $onza_banda = '';
        $cantidad = '';

        foreach ($rows as $key => $row) {

            if ($row[0] === 'CODIGO.' || $row[0] === 'CLIENTE.' || $row[0] === 'MARCA.') {
                continue;
            }

            if (is_null($row[8]) || is_null($row[9])) {
                continue;
            }


            $marca = $row[3] ? $row[3]: $marca;
            $nombre = $row[4] ? $row[4]: $nombre;
            $vitola = $row[5] ? $row[5]: $vitola;
            $capa = $row[12] ? $row[12]: $capa;
            $banda = $row[10] ? $row[10]: $banda;
            $onza_banda = $row[11] ? $row[11]: $onza_banda;
            $cantidad = $row[13] ? $row[13]: $cantidad;

            $datos[] = [
                'marca' => $marca,
                'nombre' => $nombre,
                'vitola' => $vitola,
                'capa' => $capa,
                'nombre_material' => $row[8],
                'onza' => $row[9],
                'banda' => $banda,
                'onza_banda' => $onza_banda,
                'base' => $cantidad,
            ];
        }

        ProduccionMateriales::upsert($datos, [
            'marca',
            'nombre',
            'vitola',
            'capa',
            'nombre_material',
            'onza',
            'banda',
            'onza_banda'
        ], ['base']);

    }

}
