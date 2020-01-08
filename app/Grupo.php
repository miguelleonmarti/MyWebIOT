<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Grupo extends Model
{
    use Notifiable;

    protected $table = 'grupo';
    protected $fillable = ['nombre', 'id_creador', 'id_invitado'];
}
