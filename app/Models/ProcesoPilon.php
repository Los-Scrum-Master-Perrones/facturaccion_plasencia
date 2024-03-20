<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_tabla_pilon
 * @property string $fecha_proceso
 * @property int $id_remision
 * @property string $entradas_salidas
 * @property string|null $nombre_tabaco
 * @property float $subtotal
 * @property float $total_libras
 * @property float $total_remision
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */

class ProcesoPilon extends Model
{
    use HasFactory;

    protected $table = 'tabla_pilon';
    protected $primaryKey = 'id_tabla_pilon';

    protected $fillable = [
        'fecha_proceso',
        'id_remision',
        'entradas_salidas',
        'nombre_tabaco',
        'subtotal',
        'total_libras',
        'total_remision',
        'created_at',
        'updated_at',
    ];
}
