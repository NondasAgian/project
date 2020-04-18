<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function post() {
        return $this->belongsTo('App\Post');
    }
}
