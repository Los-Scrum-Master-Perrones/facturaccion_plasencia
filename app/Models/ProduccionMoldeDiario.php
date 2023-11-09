<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|null $id_produccion_diario
 * @property int|null $id_molde
 * @property int|null $cantidad
 * @property bool|null $check
 */
class ProduccionMoldeDiario extends Model
{
    protected $table = 'produccion_moldes_diario';

    protected $fillable = [
        'id_produccion_diario',
        'id_molde',
        'cantidad',
        'check',
    ];

}
