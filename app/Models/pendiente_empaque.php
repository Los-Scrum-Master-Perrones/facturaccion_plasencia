<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendiente_empaque extends Model
{

    protected $table = 'pendiente_empaque';
    protected $guarded = [];
    protected $primaryKey = 'id_pendiente';

    public $timestamps = false;



    protected $fillable = [
        'categoria',
        'item',
        'orden_del_sistema',
        'observacion',
        'presentacion',
        'mes',
        'orden',
        'marca',
        'vitola',
        'nombre',
        'capa',
        'tipo_empaque',
        'cello',
        'pendiente',
        'saldo',
        'paquetes',
        'unidades',
        'id_pendiente_pedido',
        'procesado',
        'codigo_poducto',
    ];
}
