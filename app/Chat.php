<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable=['owner_id'];

       public function user()
       {
           return $this->belongsTo('App\User');
       }
       public function profiles()
       {
           return $this->belongsTo('App\Profile');
       }
       public function notifications()
       {
           return $this->hasMany('App\Notification');
       }

}
