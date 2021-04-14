<?php

namespace App;

use Cache;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
   public function user()
   {
       return $this->belongsTo('App\User');
   }
  public function posts()
  {
      return $this->hasMany('App\Post');
  }
  public function chats()
  {
      return $this->hasMany('App\Chat');
  }
  public function followers()
  {
      return $this->belongsToMany('App\User');
  }
  public function isOnline()
  {
      return Cache::has('user-is-online-'.$this->id);
  }



//   public static function boot() {
//       parent::boot();

//       //once created/inserted successfully this method fired, so I tested foo
//       static::created(function (){
//       //   $check=Profile::where('id',3)->pluck('field')[0];
//       //   $users=User::all();
//       //   foreach ($users as $user) {
//           SuggestedFriends::create([
//               'user_id'=> 3,
//               'friend_id'=> 2,
//                ]);
//   //    }
//    });
//   }

}
