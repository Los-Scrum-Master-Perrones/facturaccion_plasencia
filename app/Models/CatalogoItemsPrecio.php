<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoItemsPrecio extends Model
{
    use HasFactory;

    protected $table = 'catalogo_items_precio';

    protected $fillable = ['id_catalogo_marca_precio',
                           'codigo',
                           'nombre',
                           'vitola',
                           'capa',
                           'tipo_empaque',
                           'fecha'];
}