<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendiente_empaque extends Model
{

    protected $table = 'pendiente_empaque';
    protected $guarded = [];
    protected $primaryKey = 'id_pendiente';

    public $timestamps = false;
}
