<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marca_producto extends Model
{
    protected $table = 'marca_productos';
    protected $guarded = [];
    protected $primaryKey = 'id_marca';
}
