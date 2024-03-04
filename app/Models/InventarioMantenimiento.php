<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nombre
 * @property string $fecha_ingreso
 * @property int $cantidad
 * @property string $estado
 * @property string|null $descripcion
 */

class InventarioMantenimiento extends Model
{
    use HasFactory;

    protected $table = 'inventario_mantenimiento';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 'fecha_ingreso', 'cantidad', 'estado', 'descripcion'
    ];

   


   

}
