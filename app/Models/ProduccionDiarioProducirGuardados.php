<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $modulo
 * @property int $id_empleado
 * @property int $id_empleado2
 * @property string $id_produccion_orden
 * @property int $pendiente
 * @property int $tareas
 * @property string $inicio_semana
 * @property string $fin_semana
 */
class ProduccionDiarioProducirGuardados extends Model
{
    use HasFactory;

    protected $table = 'produccion_diario_producir_guardados';
    protected $primaryKey = 'id';

    protected $fillable = [
        'modulo',
        'id_empleado',
        'id_empleado2',
        'id_produccion_orden',
        'pendiente',
        'tareas',
        'inicio_semana',
        'fin_semana',
    ];
}
