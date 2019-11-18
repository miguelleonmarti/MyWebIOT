<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Producto extends Model
{
    use Notifiable;

    protected $table = 'productos';
    protected $fillable = ['nombre', 'descripcion', 'precio'];
}
