<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vitola_producto extends Model
{
    protected $table = 'vitola_productos';
    protected $guarded = [];
    protected $primaryKey = 'id_vitola';
}
