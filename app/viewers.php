<?php

namespace App;
use Cache;
use Illuminate\Database\Eloquent\Model;

class viewers extends Model
{
    protected $fillable = [
        'user_id', 'viewer_id' ,'video_id'
    ];

    public function videos()
    {
        return $this->belongsTo('App\Video');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-'.$this->viewer_id);
    }
}
