<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clase_producto extends Model
{
    protected $guarded = [];
    protected $table = 'clase_productos';
    protected $primaryKey = 'id_producto';
}
