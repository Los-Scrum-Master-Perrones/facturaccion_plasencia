<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property int $id_producto
 * @property int $orden
 * @property int $cantidad
 * @property int $fecha
 */
class ProduccionOrden extends Model
{
    use HasFactory;
    protected $table = 'produccion_orden';
    protected $fillable = [
        'id_producto', 'orden', 'cantidad', 'fecha'
    ];

    protected $casts = [
        'id' => 'int',
        'id_producto' => 'int',
        'orden' => 'string',
        'cantidad' => 'int',
        'fecha' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}



