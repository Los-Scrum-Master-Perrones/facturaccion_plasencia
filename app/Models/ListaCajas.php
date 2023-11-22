<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $codigo
 * @property string|null $productoServicio
 * @property string|null $marca
 * @property int|null $tipo_empaque
 * @property float $mal_estado
 * @property int $faltantes
 * @property int $existencia
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class ListaCajas extends Model
{
    protected $guarded = [];

    protected $table = 'lista_cajas';

    protected $fillable = [
        'codigo',
        'productoServicio',
        'marca',
        'tipo_empaque',
        'mal_estado',
        'faltantes',
        'existencia',
    ];
}
