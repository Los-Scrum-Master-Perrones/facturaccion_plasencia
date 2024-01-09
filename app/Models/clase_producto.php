<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_producto
 * @property string $item
 * @property string|null $codigo_producto
 * @property string|null $codigo_caja
 * @property string|null $codigo_precio
 * @property float|null $precio
 * @property int $cantidad_bulto
 * @property int|null $id_capa
 * @property int|null $id_vitola
 * @property int|null $id_nombre
 * @property int|null $id_marca
 * @property int|null $id_cello
 * @property int|null $id_tipo_empaque
 * @property string|null $presentacion
 * @property string $sampler
 * @property string|null $descripcion_sampler
 */
class clase_producto extends Model
{
    protected $table = 'clase_productos';

    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'item',
        'codigo_producto',
        'codigo_caja',
        'codigo_precio',
        'precio',
        'cantidad_bulto',
        'id_capa',
        'id_vitola',
        'id_nombre',
        'id_marca',
        'id_cello',
        'id_tipo_empaque',
        'presentacion',
        'sampler',
        'descripcion_sampler'
    ];

}
