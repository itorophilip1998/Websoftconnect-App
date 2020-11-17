<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Freinds extends Model
{
    protected $fillable = [
        'user_id', 'owner_id', 'friend_id'
    ];
}
