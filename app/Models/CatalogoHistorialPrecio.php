<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoHistorialPrecio extends Model
{
    use HasFactory;

    protected $table = 'catalogo_historial_precio';

    protected $fillable = ['id_catalogo_items_precio',
                           'precio',
                           'porcentaje_incremento',
                           'anio'];
}
