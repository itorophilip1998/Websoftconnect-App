<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    protected $fillable = [
        'user_id', 'photo_name', 'photo_type','photo_url'
    ];
}
