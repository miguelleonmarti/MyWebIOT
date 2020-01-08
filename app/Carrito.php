<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Carrito extends Model
{
    use Notifiable;

    protected $table = 'carrito';
    protected $fillable = ['id_user', 'id_producto'];
}
