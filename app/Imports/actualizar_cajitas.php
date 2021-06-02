<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Actualizar_Cajitas implements  ToModel
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        DB::select("update lista_cajas set lista_cajas.existencia = :exis  where lista_cajas.codigo = :codigo",["exis"=>$row[2],"codigo"=>$row[0]] );
    }
}
