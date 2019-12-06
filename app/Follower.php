<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Follower extends Model
{
    use Notifiable;

    protected $table = 'followers';
    protected $fillable = ['follower', 'following'];
}
