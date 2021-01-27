<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatNotification extends Model
{
    protected $fillable = [
        'user_id', 'friend_id', 'visited', 'status', 'owner_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
