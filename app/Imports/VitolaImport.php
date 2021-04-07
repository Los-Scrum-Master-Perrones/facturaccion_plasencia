<?php

namespace App\Imports;

use App\Models\vitola_producto;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\Importable;
class VitolaImport implements ToModel
{
    use Importable; 
    public function model(array $row)
    {
        return new vitola_producto([
            'VITOLA' => $row[9],
        ]);
    }
}
