<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Canal extends Model
{
    use Notifiable;

    protected $table = 'canales';
    protected $fillable = ['id_user', 'url', 'nombreCanal', 'descripcion', 'longitud', 'latitud', 'nombreSensor'];
}
