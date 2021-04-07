<?php

namespace App\Imports;

use App\Models\nombre_producto;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\Importable;
class NombreImport implements ToModel
{
    use Importable;
    public function model(array $row)
    {
        return new nombre_producto([
            'NOMBRE' => $row[10],
        ]);
    }
}
