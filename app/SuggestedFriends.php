<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuggestedFriends extends Model
{
    protected $fillable = [
        'user_id', 'friend_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
