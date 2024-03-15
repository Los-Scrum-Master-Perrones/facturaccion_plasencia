<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_pilon
 * @property int $numero_pilon
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Pilon extends Model
{
    use HasFactory;

    protected $table = 'pilones';
    protected $primaryKey = 'id_pilon';

    public $timestamps = true;

    protected $fillable = [
        'numero_pilon',
        'created_at',
        'updated_at',
    ];
}
