<?php

namespace App;

use Cache;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
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
    public function chatNotify()
    {
        return $this->hasMany('App\ChatNotification');
    }
    public function photos()
    {
        return $this->hasMany('App\Photos');
    }
    public function viewers()
    {
        return $this->hasMany('App\viewers');
    }

    // reaction relationship
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    public function laugh()
    {
        return $this->hasMany('App\Laugh');
    }
     public function loves()
    {
        return $this->hasMany('App\Love');
    }
     public function comments()
    {
        return $this->hasMany('App\Comment');
    }
   public function following()
    {
        return $this->belongsToMany('App\Profile');
    }
     public function videos()
    {
        return $this->hasMany('App\Video');
    }
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }
     public function isOnline()
    {
        return Cache::has('user-is-online-'.$this->id);
    }
    public function friends()
    {
        return $this->hasMany('App\Freinds');

    }

    public function suggested()
    {
        return $this->hasMany('App\SuggestedFriends'); 
    }




}
