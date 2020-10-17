<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','image', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function profile() {
        return $this->hasOne('App\Profile');        
    }
    public function propic(){
        return $this->hasOne('App\Propic');
    }
    public function post() {
        return $this->hasMany('App\Post');
    }
    public function comment() {
        return $this->hasMany('App\comment');
    }
    public function friends() {
        return $this->hasMany('App\Friend','sender_id');        
       // return $this->hasMany('App\Friend','receiver_id');
    }

}
