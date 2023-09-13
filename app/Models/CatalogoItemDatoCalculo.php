<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_marca_precio
 * @property int $id_vitola
 * @property string $fecha
 * @property float $salario_directo
 * @property float $salario_empaque
 * @property float $costos_indirectos
 * @property float $material_empaque
 * @property float $porcentaje_costo_social
 * @property float $porcentaje_salario_indirecto
 * @property float $capa_lbs
 * @property float $capa_lbs_costo
 * @property float $banda_lbs
 * @property float $banda_lbs_costo
 * @property float $tripa_lbs
 * @property float $tripa_lbs_costo
 * @property float $porcentaje_gasto_admin
 * @property float $porcentaje_utilidad
 * @property float $id_catalogo_precio_item
 */
class CatalogoItemDatoCalculo extends Model
{
    use HasFactory;
    protected $table = 'catalogo_items_datos_calculo';

    protected $fillable = [
        'id_marca_precio',
        'id_vitola',
        'fecha',
        'salario_directo',
        'salario_empaque',
        'costos_indirectos',
        'material_empaque',
        'porcentaje_costo_social',
        'porcentaje_salario_indirecto',
        'capa_lbs',
        'capa_lbs_costo',
        'banda_lbs',
        'banda_lbs_costo',
        'tripa_lbs',
        'tripa_lbs_costo',
        'porcentaje_gasto_admin',
        'porcentaje_utilidad',
        'id_catalogo_precio_item'
    ];
}
