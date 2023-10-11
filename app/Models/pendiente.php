<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
     * @property int $categoria
     * @property string $item
     * @property string $orden_del_sistema
     * @property string $observacion
     * @property string $presentacion
     * @property string $mes
     * @property string $orden
     * @property int $marca
     * @property int $vitola
     * @property int $nombre
     * @property int $capa
     * @property int $tipo_empaque
     * @property int $cello
     * @property int $pendiente
     * @property int $saldo
     * @property string $paquetes
     * @property string $unidades
     * @property string $serie_precio
     * @property string $precio
     * @property string $procesado
     * @property string $codigo_productos
*/
class pendiente extends Model
{
    protected $table = 'pendiente';
    protected $primaryKey = 'id_pendiente';
    public $timestamps = false; // Si no necesitas las columnas created_at y updated_at

    protected $fillable = [
        'categoria',
        'item',
        'orden_del_sistema',
        'observacion',
        'presentacion',
        'mes',
        'orden',
        'marca',
        'vitola',
        'nombre',
        'capa',
        'tipo_empaque',
        'cello',
        'pendiente',
        'saldo',
        'paquetes',
        'unidades',
        'serie_precio',
        'precio',
        'procesado',
        'codigo_productos',
    ];
}
