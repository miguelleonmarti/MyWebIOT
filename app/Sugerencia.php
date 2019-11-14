<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sugerencia extends Model
{
    use Notifiable;

    protected $table = 'sugerencias';
    protected $fillable = ['email', 'name', 'message'];
}
