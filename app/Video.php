<?php

namespace App;

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


}
