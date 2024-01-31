<?php

namespace App\Imports;

use App\Models\CatalogoHistorialPrecio;
use App\Models\CatalogoItemsPrecio;
use App\Models\CatalogoMarcasPrecio;
use Hamcrest\Type\IsNumeric;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class MarcaPrecioImport implements ToCollection, WithCalculatedFormulas
{
    use Importable;
    // public function collection(Collection $rows)
    // {
    //     $registro = new CatalogoMarcasPrecio();
    //     $registroItem = new CatalogoItemsPrecio();
    //     foreach ($rows as $key => $row) {

    //         if (is_numeric($row[1]) && $row[3] == null && $row[4] == null && $row[2] != null && $row[5] == null) {
    //             $registro = new CatalogoMarcasPrecio([
    //                 'marca' =>  trim($row[2]),
    //                 'codigo' => $row[1],
    //             ]);
    //             $registro->save();
    //         }

    //         if ($row[4] != null && $row[4] != 'CAPA' && $row[4] != 'WRAPPER'
    //           && $row[4] != 'EMPAQUE'  && $row[4] != 'PACKING' && $row[4] != 'BLUE') {

    //             $registroItem = new CatalogoItemsPrecio([
    //                 'id_catalogo_marca_precio' =>  $registro->id,
    //                 'codigo' => $row[1],
    //                 'nombre' => $row[2],
    //                 'vitola' => str_replace(' ', '', $row[3]),
    //                 'capa' => $row[4],
    //                 'tipo_empaque' => str_replace('/',' 1/',$row[5]),
    //                 'fecha' => $row[0],
    //             ]);
    //             $registroItem->save();

    //             for ($i=8; $i < $row->count(); $i++) {

    //                 $precio = $row[$i];
    //                 $precio = str_replace('$','',$precio);

    //                 if(is_null($row[$i])){
    //                     $precio = 0;
    //                 }


    //                 $registroHistorial = new CatalogoHistorialPrecio([
    //                     'id_catalogo_items_precio' =>  $registroItem->id,
    //                     'precio' => $precio,
    //                     'porcentaje_incremento' => is_null($rows[3][$i]) ? 0 : $rows[3][$i],
    //                     'anio' => is_null($rows[0][$i]) ? 2008 : $rows[0][$i],
    //                 ]);
    //                 $registroHistorial->save();

    //                 if($rows[0][$i] == '2023'){
    //                     break;
    //                 }
    //             }

    //         }
    //     }
    // }

    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {

            if (is_numeric($row[1]) && $row[3] == null && $row[4] == null && $row[2] != null && $row[5] == null) {

            }

            if ($row[4] != null && $row[4] != 'CAPA' && $row[4] != 'WRAPPER'
              && $row[4] != 'EMPAQUE'  && $row[4] != 'PACKING' && $row[4] != 'BLUE') {

                CatalogoItemsPrecio::where('codigo','=',$row[1])->update(['banda'=>$row[6],'cello'=>$row[7]]);

            }
        }
    }
}
