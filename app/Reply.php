<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable= [
        'user_id','freind_id','comment_id','message'
    ];

       public function user()
       {
           return $this->belongsTo('App\User');
       }
       public function comments()
       {
           return $this->belongsTo('App\Comment');
       }
       public function notifications()
       {
           return $this->hasMany('App\Notification');
       }

}
