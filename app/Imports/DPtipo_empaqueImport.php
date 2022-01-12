<?php

namespace App\Imports;

use App\Models\tipo_empaque;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class DPtipo_empaqueImport implements ToModel
{
  use Importable;
  public function model(array $row)
  {
    if ($row[1] == null ||  $row[1] == "Tipo Empaque") {
      $tipo = null;
    } else {
      $tipo_existe = tipo_empaque::where('tipo_empaque', $row[1])->count();
      if ($tipo_existe > 0) {
        $tipo = null;
      } else {
        $tipo =  new tipo_empaque([
          'tipo_empaque' => $row[1],
        ]);
      }
    }

    return $tipo;
  }
}
