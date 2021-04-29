<?php

namespace App\Imports;

use App\Models\capa_producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class DPCapaImport implements ToModel
{
  use Importable;
  public function model(array $row)
  {

    if ($row[1] == null || $row[1] == "Nombre") {
      $capa = null;
    } else {
      $capa_existe = capa_producto::where('capa', $row[1])->count();
      if ($capa_existe > 0) {
        $capa = null;
      } else {
        $capa =  new capa_producto([
          'CAPA' => $row[1],
        ]);
      }
    }
    return $capa;
  }
}
