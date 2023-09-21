<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $codigo
 * @property int $id_marca
 * @property int $id_nombre
 * @property int $id_vitola
 * @property int $id_capa
 * @property int $existencia
 */
class Produccion extends Model
{
    use HasFactory;
    protected $table = 'produccion';

    protected $fillable = [
        'codigo', 'id_marca', 'id_nombre', 'id_vitola', 'id_capa', 'existencia'
    ];

    protected $casts = [
        'id' => 'int',
        'codigo' => 'string',
        'id_marca' => 'int',
        'id_nombre' => 'int',
        'id_vitola' => 'int',
        'id_capa' => 'int',
        'existencia' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
