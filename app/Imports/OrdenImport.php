<?php

namespace App\Imports;

use App\Models\orden_producto;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\Importable;
class OrdenImport implements ToModel
{
    use Importable;
    public function model(array $row)
    {
        return new orden_producto([
            'ORDEN' => $row[7],
        ]);
    }
}
