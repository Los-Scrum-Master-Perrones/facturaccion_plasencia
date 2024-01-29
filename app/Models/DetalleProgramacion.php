<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_detalle_programacion
 * @property string|null $numero_orden
 * @property string|null $orden
 * @property string|null $cod_producto
 * @property float|null $saldo
 * @property int|null $id_programacion
 * @property int|null $id_pendiente
 * @property string|null $cajas
 * @property int|null $cant_cajas
 * @property string|null $codigo_caja
 * @property int|null $cantidad_sobrante_puros
 */
class DetalleProgramacion extends Model
{
    use HasFactory;
    protected $table = 'detalle_programacion';
    protected $primaryKey = 'id_detalle_programacion';
    public $timestamps = true;

    protected $fillable = [
        'numero_orden',
        'orden',
        'cod_producto',
        'saldo',
        'id_programacion',
        'id_pendiente',
        'cajas',
        'cant_cajas',
        'codigo_caja',
        'cantidad_sobrante_puros',
    ];
}
