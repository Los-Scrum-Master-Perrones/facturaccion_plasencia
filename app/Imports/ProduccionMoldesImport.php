<?php

namespace App\Imports;


use App\Models\ProduccionMateriales;
use App\Models\ProduccionMolde;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class ProduccionMoldesImport implements ToCollection, WithCalculatedFormulas
{

    use Importable;
    public function collection(Collection $rows)
    {
        $datos = [];


        foreach ($rows as $key => $row) {

            if ($row[0] === 'VITOLA' || $row[1] === 'FIGURA Y  TIPO' || $row[3] === 'MATERIAL') {
                continue;
            }

            if (is_null($row[1]) || is_null($row[2])) {
                continue;
            }

            $datos[] = [
                'vitola' => $row[0],
                'figuraTipo' => $row[1],
                'material' => $row[2],
                'buenos' => $row[3]??0,
                'reparacion' => $row[4]??0,
                'irregulares' => $row[5]??0,
                'malos' => $row[6]??0,
                'bodega' => $row[7]??0,
                'salon' => $row[8]??0,
            ];
        }

        ProduccionMolde::upsert($datos, [
            'vitola',
            'figuraTipo',
            'material',
            'buenos',
            'reparacion',
            'irregulares',
            'malos',
            'bodega',
            'salon',
        ], [
            'vitola',
            'figuraTipo',
            'material'
        ]);

    }

}
