<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendiente extends Model
{
    protected $table = 'pendiente';
    protected $guarded = [];
    protected $primaryKey = 'id_pendiente';

    public $timestamps = false;
}
