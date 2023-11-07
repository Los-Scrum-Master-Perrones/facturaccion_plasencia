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
 * @property int $tareas
 * @property int $moldes_ids
 * @property int $moldes_para_uso
 * @property int $moldes_sobrantes
 */
class ProduccionDiarioProducir extends Model
{
    use HasFactory;

    protected $table = 'produccion_diario_producir';
    protected $primaryKey = 'id';

    protected $fillable = [
        'modulo',
        'id_empleado',
        'id_empleado2',
        'id_produccion_orden',
        'tareas',
        'moldes_ids',
        'moldes_para_uso',
        'moldes_sobrantes',
    ];
}
