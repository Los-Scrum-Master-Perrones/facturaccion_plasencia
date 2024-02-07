<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProduccionDiarioPendienteVineta
 *
 * @property string $id
 * @property int $id_produccion_pendiente
 * @property int|null $rolero
 * @property int|null $bonchero
 * @property string|null $revisador
 * @property string $puros
 * @property string $estado
 */
class ProduccionDiarioPendienteVineta extends Model
{
    use HasFactory;
    protected $table = 'produccion_diario_pendiente_vinetas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_produccion_pendiente',
        'rolero',
        'bonchero',
        'revisador',
        'puros',
        'estado',
    ];

}

