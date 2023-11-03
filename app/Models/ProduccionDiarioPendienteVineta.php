<?php
namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property int $id_produccion_pendiente
 * @property string $puros
 * @property int $rolero
 * @property int $bonchero
 * @property string $revisadores
 * @property string $estado
 */
class ProduccionDiarioPendienteVineta extends Model
{
    use HasFactory;
    protected $table = 'produccion_diario_pendiente_vinetas';

    protected $fillable = [
        'id_produccion_pendiente',
        'puros',
        'rolero',
        'bonchero',
        'revisadores',
        'estado'
    ];

}

