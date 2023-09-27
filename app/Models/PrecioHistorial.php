<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PrecioHistorial
 *
 * @property int $id
 * @property int|null $id_detalle_factura
 * @property float|null $precio
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 */
class PrecioHistorial extends Model
{
    use HasFactory;
    protected $table = 'precios_historial';


    protected $fillable = [
        'id_detalle_factura',
        'precio',
    ];
}
