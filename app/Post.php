<?php

namespace App;
use Cache;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['isDelete'];
    protected $casts = [
        'picture' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function profiles()
     {
         return $this->belongsTo('App\Profile');
     }
     public function likes()
    {
        return $this->hasMany('App\Like');
    }
     public function loves()
    {
        return $this->hasMany('App\Love');
    }
    public function laugh()
    {
        return $this->hasMany('App\Laugh');
    }
     public function comments()
    {
        return $this->hasMany('App\Comment');
    }
     public function notifications()
    {
        return $this->hasMany('App\Notification');
    }
    public function isOnline()
    {
        return Cache::has('user-is-online-'.$this->user_id);
    }



}
