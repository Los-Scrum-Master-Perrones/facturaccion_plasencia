<?php

namespace App\Imports;

use App\Models\vitola_producto;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\Importable;

class DPVitolaImport implements ToModel
{
  use Importable;

  public function model(array $row)
  {
    if ($row[1] == null ||  $row[1] == "Nombre") {
      $vitola = null;
    } else {
      $vitola_existe = vitola_producto::where('vitola', $row[1])->count();
      if ($vitola_existe > 0) {
        $vitola = null;
      } else {
        $vitola =  new vitola_producto([
          'VITOLA' => $row[1],
        ]);
      }
    }
    return $vitola;
  }
}
