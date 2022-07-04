<?php

namespace App\Imports;

use App\Models\MaterialesCatalogo;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\HasReferencesToOtherSheets;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class CatalogoMaterialesImport implements ToCollection,
                                          HasReferencesToOtherSheets,
                                          WithCalculatedFormulas
{
    use Importable;
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $m = new MaterialesCatalogo();
            $m->factory_item = $row[0];
            $m->navision_item = $row[1];
            $m->brand = $row[2];
            $m->linea = $row[3];
            $m->item_description = $row[4];
            $m->saldo = $row[12];
            $m->save();
        }
    }
}

