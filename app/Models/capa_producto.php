<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class capa_producto extends Model
{
    protected $table = 'capa_productos';
    protected $guarded = [];
    protected $primaryKey = 'id_capa';
}
