<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Orden extends Model
{
    use Notifiable;

    protected $table = 'ordenes';
    protected $fillable = ['id_cliente', 'total', 'estado'];
}
