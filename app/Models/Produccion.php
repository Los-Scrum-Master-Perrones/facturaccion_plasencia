<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $codigo
 * @property string $presentacion
 * @property int $prioridad
 * @property int $id_marca
 * @property int $id_nombre
 * @property int $id_vitola
 * @property int $id_capa
 * @property double $precio_bonchero
 * @property double $precio_rolero
 * @property int $existencia
 * @property string $fecha_prioridad
 */
class Produccion extends Model
{
    use HasFactory;
    protected $table = 'produccion';

    protected $fillable = [
        'codigo',
        'id_marca',
        'prioridad',
        'presentacion', 
        'id_nombre', 
        'id_vitola', 
        'id_capa', 
        'existencia',
        'precio_bonchero',
        'precio_rolero',
        'fecha_prioridad'
    ];

    protected $casts = [
        'id' => 'int',
        'codigo' => 'string',
        'presentacion' => 'string',
        'id_marca' => 'int',
        'id_nombre' => 'int',
        'id_vitola' => 'int',
        'id_capa' => 'int',
        'existencia' => 'int',
    ];
}
