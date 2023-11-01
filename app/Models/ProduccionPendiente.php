<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property int $id_producto
 * @property string $orden_sistema
 * @property string $fecha_recibido
 * @property int $cantidad
 * @property string $observacion
 * @property int $prioridad
 */
class ProduccionPendiente extends Model
{
    use HasFactory;
    protected $table = 'produccion_pendiente';

    protected $fillable = [
        'id_producto',
        'orden_sistema',
        'fecha_recibido',
        'cantidad',
        'observacion',
        'prioridad'
    ];

}
