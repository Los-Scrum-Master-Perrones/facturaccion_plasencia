<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $fecha
 * @property string|null $mes_contenedor
 */
class Prograamacion extends Model
{
    use HasFactory;
    protected $table = 'prograamacion';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'fecha',
        'mes_contenedor',
    ];
}
