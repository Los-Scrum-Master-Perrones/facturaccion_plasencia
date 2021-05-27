<?php

namespace App\Imports;

use App\Models\pendiente;
use Maatwebsite\Excel\Concerns\ToModel;

class PendienteImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new pendiente([
            'categoria'=>row[0];
            'item'=>row[1];
            'orden_del_sistema'=>row[2];
            'observacion'=>row[3];
            'presentacion'=>row[4];
            'mes'=>row[6];
            'orden'=>row[7];
            'marca'=>row[8];
            'vitola'=>row[9];
            'nombre'=>row[10];
            'capa'=>row[11];
            'tipo_empaque'=>row[12];
            'cello'=>row[13];
            'pendiente'=>row[16];
            'saldo'=>row[34];
            'paquetes'=>row[];
            'unidades'=>row[];
            
        ]);


        $tipo =  new tipo_empaque([
            'tipo_empaque' => $row[12],
        ]);
    }
}
