<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UsuarioGrupo extends Model
{
    use Notifiable;

    protected $table = 'usuario_grupo';
    protected $fillable = ['id_grupo', 'id_usuario'];
}
