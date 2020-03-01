<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $filalble = ['user_id', 'friend_id', 'chat'];
}
