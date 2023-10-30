<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $nombre
 * @property int $id_revisador1
 * @property int $id_revisador2
 */
class ProduccionDiarioModulos extends Model
{
    use HasFactory;
    protected $table = 'produccion_diario_modulos';

    protected $fillable = [
        'nombre',
        'id_revisador1',
        'id_revisador2',
    ];
}
