<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = "profile_user";

    public function friends()
    {
        return $this->belongsTo('App\User');
    }

    public function friendss()
    {
        return $this->belongsTo('App\Profile');
    }


}
