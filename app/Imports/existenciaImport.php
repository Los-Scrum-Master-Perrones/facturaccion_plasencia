<?php

namespace App\Imports;

use App\Models\importar_existencia;
use Maatwebsite\Excel\Concerns\ToModel;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;

class existenciaImport implements toModel{

   use Importable;
    public function model(array $row)
    {

        if ($row[0] == null && $row[1] == null && $row[2] == null && $row[3] == null && $row[5] == null) {
            $existencia = null;
        } else {
            if ($row[0] == null && $row[1] == null && $row[2] == null && $row[3] == null && $row[4] == null) {
                $registro_maximo = DB::select('call traer_maximo_registro_existencia');
                $cod = $registro_maximo[0]->codigo_producto;
                $mar = $registro_maximo[0]->marca;
                $nom = $registro_maximo[0]->nombre;
                $vit = $registro_maximo[0]->vitola;
                $capa = $registro_maximo[0]->capa;

                $existencia =  new importar_existencia([
                    'codigo_producto' => $cod,
                    'marca' => $mar,
                    'nombre' => $nom,
                    'vitola' => $vit,
                    'capa' => $capa,
                    'ubicacion' => $row[5],
                    'total' => $row[6],
                ]);
            } else {

                $existencia =  new importar_existencia([
                    'codigo_producto' => $row[0],
                    'marca' => $row[1],
                    'nombre' => $row[2],
                    'vitola' => $row[3],
                    'capa' => $row[4],
                    'ubicacion' => $row[5],
                    'total' => $row[6],
                ]);

               
            }
            return $existencia;
        }
    }
}
