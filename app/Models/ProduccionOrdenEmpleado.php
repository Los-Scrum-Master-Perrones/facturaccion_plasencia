<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int|null $id_empleado
 * @property int|null $id_orden
 * @property int|null $cantidad
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class ProduccionOrdenEmpleado extends Model
{
    use HasFactory;
    protected $table = 'produccion_orden_empleados';

    protected $fillable = [
        'id_empleado', 'id_orden', 'cantidad',
    ];

    protected $casts = [
        'id' => 'int',
        'id_empleado' => 'int',
        'id_orden' => 'int',
        'cantidad' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
