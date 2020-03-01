<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'profile_picture', 'bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() {
        return $this->hasMany('App\Post');
    }
    public function categories(){
        return $this->hasMany('App\Category');
    }
    public function likes() {
        return $this->hasMany('App\Like');
    }    
    public function friendsOfMine(){ //returns friends of me (I have requested)
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf(){ //returns users who have requesed me as their friend
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends(){ //takes data from both functions above and merges it to avoid duplicated values 
        return $this->friendsOfMine->merge($this->friendOf);
    }
    
}
