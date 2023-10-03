<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_produccion_pendiente
 * @property string $destino
 * @property int $cantidad
 * @property string $fecha_salida
 */
class ProduccionPendienteSalida extends Model
{
    use HasFactory;
    protected $table = 'produccion_pendiente_salida';

    protected $fillable = [
        'destino',
        'id_produccion_pendiente',
        'cantidad',
        'fecha_salida',
    ];

}
