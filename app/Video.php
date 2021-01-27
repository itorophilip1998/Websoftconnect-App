<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    protected $fillable = [
        'name', 'user_id','description','category'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function profiles()
    {
        return $this->belongsTo('App\Profile');
    }
    public function viewers()
    {
        return $this->hasMany('App\viewers');
    }
    public function isOnline()
    {
        return Cache::has('user-is-online-'.$this->user_id);
    }


}
