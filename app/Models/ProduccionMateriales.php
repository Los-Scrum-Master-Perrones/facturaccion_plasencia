<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_producto
 * @property string $marca
 * @property string $nombre
 * @property string $vitola
 * @property string $capa
 * @property string $nombre_material
 * @property int $onza
 * @property string $banda
 * @property int $onza_banda
 * @property int $base
 * @property string $activo
 */
class ProduccionMateriales extends Model
{
    use HasFactory;
    protected $table = 'produccion_materiales';

    protected $fillable = [
        'id_producto',
        'marca',
        'nombre',
        'vitola',
        'capa',
        'nombre_material',
        'onza',
        'banda',
        'onza_banda',
        'base',
        'activo'
    ];


    public function producto()
    {
        return $this->belongsTo(Produccion::class, 'id_producto');
    }
}
