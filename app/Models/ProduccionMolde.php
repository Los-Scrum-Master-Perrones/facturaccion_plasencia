<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $vitola
 * @property string $figuraTipo
 * @property string $material
 * @property int $buenos
 * @property int $reparacion
 * @property int $irregulares
 * @property int $malos
 * @property int $bodega
 * @property int $salon
 */
class ProduccionMolde extends Model
{
    use HasFactory;
    protected $table = 'produccion_moldes';

    protected $fillable = [
        'vitola',
        'figuraTipo',
        'material',
        'buenos',
        'reparacion',
        'irregulares',
        'malos',
        'bodega',
        'salon',
    ];

}
