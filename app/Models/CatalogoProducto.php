<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property string $item
 * @property string $descripcion
 * @property int $unidades
 * @property int $categoria
 */
class CatalogoProducto extends Model
{
    use HasFactory;
    protected $table = 'catalogo_productos';

    protected $fillable = [
        'item',
        'descripcion',
        'unidades',
        'categoria',
    ];

    protected $casts = [
        'unidades' => 'integer',
        'categoria' => 'integer',
    ];

    // Relación con la tabla catalogo_productos_detalles
    public function detalles()
    {
        return $this->hasMany(CatalogoProductoDetalle::class, 'id_catalogo_producto', 'id');
    }
}
