<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_clase_producto extends Model
{
    protected $guarded = [];
    protected $table = 'detalle_clase_productos';
    protected $primaryKey = 'id_producto';
}
