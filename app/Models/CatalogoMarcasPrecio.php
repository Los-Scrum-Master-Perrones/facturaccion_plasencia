<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoMarcasPrecio extends Model
{
    use HasFactory;

    protected $table = 'catalogo_marcas_precio';

    protected $fillable = ['codigo', 'marca'];
}
