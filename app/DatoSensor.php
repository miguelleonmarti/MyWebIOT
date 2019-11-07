<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatoSensor extends Model
{
    protected $table = 'datossensores';
    protected $fillable = ['id_canal', 'dato'];
}
