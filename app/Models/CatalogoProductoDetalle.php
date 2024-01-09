<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property int $id_catalogo_producto
 * @property string $descripcion
 * @property int $activo
 * @property int $cantidad
 */

class CatalogoProductoDetalle extends Model
{
    use HasFactory;
    protected $table = 'catalogo_productos_detalles';

    protected $fillable = [
        'id_catalogo_producto',
        'descripcion',
        'activo',
        'cantidad',
    ];

    protected $casts = [
        'id_catalogo_producto' => 'integer',
        'activo' => 'integer',
    ];

    // Relación con la tabla catalogo_productos
    public function producto()
    {
        return $this->belongsTo(CatalogoProducto::class, 'id_catalogo_producto', 'id');
    }
}
