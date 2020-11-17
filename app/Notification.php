<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Notification extends Model
{
    protected $fillable=['user_id','title','type','status','visited','data_id','owner_id'];

            public function user()
            {
                return $this->belongsTo('App\User');
            }
            public function chats()
            {
                return $this->belongsToMany('App\Chat');
            }
            public function posts()
            {
                return $this->belongsToMany('App\Posts');
            }
}
