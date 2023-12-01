<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nombre
 * @property string $clase
 * @property float|null $precio
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class ProduccionMaterialesNombres extends Model
{
    use HasFactory;
    protected $table = 'produccion_materiales_nombres';

    protected $fillable = [
        'nombre',
        'clase',
        'precio',
        'created_at',
        'updated_at',
    ];
}
