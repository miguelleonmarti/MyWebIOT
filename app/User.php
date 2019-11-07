<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['nombre', 'email', 'fechaNacimiento', 'passwd'];

    protected $hidden = ['passwd'];

    public function setPasswdAttribute($password)
    {
        $this->attributes['passwd'] = bcrypt($password);
    }

    public function getAuthPassword()
    {
        return $this->passwd;
    }
}
