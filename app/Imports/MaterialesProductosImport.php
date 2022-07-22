<?php

namespace App\Imports;

use App\Http\Livewire\MaterialesProductos;
use App\Models\MaterialesCatalogo;
use App\Models\MaterialesProductosModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\HasReferencesToOtherSheets;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class MaterialesProductosImport implements ToCollection,
                                          HasReferencesToOtherSheets,
                                          WithCalculatedFormulas
{
    use Importable;
    public function collection(Collection $rows)
    {

            foreach ($rows as $row) {
                if('Descripción Material'!= $row[3]){


                $empaques = DB::select('select * from tipo_empaques where tipo_empaque = ?', [$row[1]]);

                $material = DB::select('SELECT *
                                        FROM materiales_productos
                                        WHERE codigo_producto = ? AND
                                              tipo_empaque = ? AND
                                              codigo_material = ?', [$row[0],
                                                                  $empaques[0]->id_tipo_empaque,
                                                                       $row[2]]);

                if (!isset($material[0]->codigo_producto)) {

                        $m = new MaterialesProductosModel();
                        $m->codigo_producto = $row[0];
                        $m->tipo_empaque = $empaques[0]->id_tipo_empaque;
                        $m->codigo_material = $row[2];
                        $m->des_material = $row[3];
                        $m->cantidad = $row[4];
                        $m->uxe = $row[6]=='Unchecked'?'NO':'SI';
                        $m->save();
                }
             }
            }


    }
}

