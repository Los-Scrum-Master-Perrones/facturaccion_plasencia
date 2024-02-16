<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $codigo
 * @property string $nombre
 * @property string $rol
 * * @property string $activo
 */
class ProduccionEmpleado extends Model
{
    use HasFactory;
    protected $table = 'produccion_empleado';

    protected $fillable = [
        'codigo', 'nombre', 'rol', 'activo',
    ];

    protected $casts = [
        'id' => 'int',
        'codigo' => 'int',
        'nombre' => 'string',
        'rol' => 'string',
        'activo'=> 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
