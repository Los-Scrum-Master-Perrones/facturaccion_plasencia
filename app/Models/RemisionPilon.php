<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_remision_proceso
 * @property int $id_remision
 * @property string $fecha_remision
 * @property string $destino_remision
 * @property string $origen_remision
 * @property string $descripcion1_remision
 * @property string $cant_lbs_des_1
 * @property string $descripcion2_remision
 * @property string $cant_lbs_des_2
 * @property string $descripcion3_remision
 * @property string $cant_lbs_des_3
 * @property string $descripcion4_remision
 * @property string $cant_lbs_des_4
 * @property string $descripcion5_remision
 * @property string $cant_lbs_des_5
 * @property float $total_remision
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */

class RemisionPilon extends Model
{
    use HasFactory;

    protected $table = 'remision_proceso';
    protected $primaryKey = 'id_remision_proceso';

    protected $fillable = [
        'id_remision',
        'fecha_remision',
        'destino_remision',
        'origen_remision',
        'descripcion1_remision',
        'cant_lbs_des_1',
        'descripcion2_remision',
        'cant_lbs_des_2',
        'descripcion3_remision',
        'cant_lbs_des_3',
        'descripcion4_remision',
        'cant_lbs_des_4',
        'descripcion5_remision',
        'cant_lbs_des_5',
        'total_remision',
        'created_at',
        'updated_at',
    ];


}
