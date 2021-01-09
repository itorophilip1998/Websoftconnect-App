<?php

namespace App;
use Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Freinds extends Model
{
    protected $fillable = [
        'user_id', 'owner_id', 'friend_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');

    }
    public function isOnline()
    {
        return Cache::has('user-is-online-'.$this->user_id);
    }

}
