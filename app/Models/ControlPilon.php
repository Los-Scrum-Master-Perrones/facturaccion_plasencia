<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_control_pilones
 * @property string $nombre_tabaco
 * @property string $fecha_entrada_pilon
 * @property string $numero_pilon
 * @property float|null $entrada_tabaco_pilon
 * @property float|null $salida_tabaco_pilon
 * @property float|null $total_actual
 * @property float $Total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */

class ControlPilon extends Model
{
    use HasFactory;
    protected $table = 'control_pilones';
    protected $primaryKey = 'id_control_pilones';

    protected $fillable = [
        'nombre_tabaco',
        'fecha_entrada_pilon',
        'numero_pilon',
        'entrada_tabaco_pilon',
        'salida_tabaco_pilon',
        'total_actual',
        'Total',
        'created_at',
        'updated_at',
    ];

}
