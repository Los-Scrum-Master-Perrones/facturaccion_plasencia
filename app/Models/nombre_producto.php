<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nombre_producto extends Model
{
    protected $table = 'nombre_productos';
    protected $guarded = [];
    protected $primaryKey = 'id_nombre';
}
