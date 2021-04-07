<?php

namespace App\Imports;

use App\Models\marca_producto;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\Importable;
class MarcaImport implements ToModel
{
    use Importable;
    public function model(array $row)
    {
        return new marca_producto([
            'MARCA' => $row[8],
        ]);
    }
}
