<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrdenDetalle extends Model
{
    use Notifiable;

    protected $table = 'ordenes_detalle';
    protected $fillable = ['nombre', 'descripcion', 'precio'];
}
