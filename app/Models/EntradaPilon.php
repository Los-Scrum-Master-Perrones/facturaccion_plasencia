<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EntradaPilon
 *
 * @property int $id_entrada_pilones
 * @property string $nombre_tabaco
 * @property string|null $variedad
 * @property string|null $finca
 * @property string $numero_pilon
 * @property string|null $fecha_entrada_pilon
 * @property string $tiempo_adelanto_pilon
 * @property string|null $fecha_estimada_salida
 * @property float $cantidad_lbs
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */

class EntradaPilon extends Model
{
    use HasFactory;

    protected $table = 'entrada_pilones';
    protected $primaryKey = 'id_entrada_pilones';

    protected $fillable = [
        'nombre_tabaco',
        'variedad',
        'finca',
        'numero_pilon',
        'fecha_entrada_pilon',
        'tiempo_adelanto_pilon',
        'fecha_estimada_salida',
        'cantidad_lbs',
        'created_at',
        'updated_at',
    ];

}
