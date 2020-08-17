<?php

namespace App;

use Cache;

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
        'name', 'email', 'password',
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

    public function profiles()
    {
        return $this->hasOne('App\Profile');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function chats()
    {
        return $this->hasMany('App\Chat');
    }

    // reaction relationship
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
     public function loves()
    {
        return $this->hasMany('App\Love');
    }
     public function comments()
    {
        return $this->hasMany('App\Comment');
    }
     public function friends()
    {
        return $this->hasMany('App\Freinds');
    }
     public function follows()
    {
        return $this->hasMany('App\Follow');
    }
     public function isOnline()
    {
        return Cache::has('user-is-online-'.$this->id);
    }

}
