<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property string|null $item
 * @property string|null $cant_paquetes
 * @property string|null $unidades
 * @property string|null $numero_orden
 * @property string|null $categoria
 */
class pedido extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'item',
        'cant_paquetes',
        'unidades',
        'numero_orden',
        'categoria'
    ];
}
