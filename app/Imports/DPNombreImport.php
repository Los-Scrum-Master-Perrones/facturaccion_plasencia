<?php

namespace App\Imports;

use App\Models\nombre_producto;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\Importable;


class DPNombreImport implements ToModel
{
  use Importable;


  public function model(array $row)
  {
    if ($row[1] == null ||  $row[1] == "Alias_Vitola") {
      $nombre = null;
    } else {
      $nombre_existe = nombre_producto::where('nombre', $row[1])->count();
      if ($nombre_existe > 0) {
        $nombre = null;
      } else {

        $nombre =  new nombre_producto([
          'NOMBRE' => $row[1],
        ]);
      }
    }

    return $nombre;
  }
}
