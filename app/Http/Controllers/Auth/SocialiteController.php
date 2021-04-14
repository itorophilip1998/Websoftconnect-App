<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Photos;
use App\Profile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
   public function redirectToProvider($provider)
   {
       return Socialite::driver($provider)->redirect();
   }

   /**
    * Obtain the user information from GitHub.
    *
    * @return \Illuminate\Http\Response
    */
   public function handleProviderCallback($provider)
   {
     $user = Socialite::driver($provider)->user();

       if($provider=='github')
       {
            Auth::login($this->github($user));
            Photos::create([
                'user_id'=>Auth::user()->id,
                'photo_name'=>$user->user['avatar_url'],
                'photo_type'=>"profile",
               ]);
            return redirect('/');
       }
       if($provider=='google')
       {
            Auth::login($this->google($user));
            Photos::create([
                'user_id'=>Auth::user()->id,
                'photo_name'=>$user->user['picture'],
                'photo_type'=>"profile",
               ]);
            return redirect('/');
       }
       if($provider=='facebook')
       {
           dd($user);
            Auth::login($this->google($user));
            return redirect('/');
       }

   }


   public function github($github_user)
   {

       $newUser=User::where('oauth_id',$github_user->id)
       ->where('email',$github_user->email)
       ->first();


    if(!$newUser)
    {
        $newUser=new User();
        if($github_user->nickname==null){
        $newUser->name= $github_user->name;
        }
        $newUser->name= $github_user->nickname;
        $newUser->email= $github_user->email;
        $newUser->oauth_id= $github_user->id;
        $newUser->email_verified_at= now();
        $newUser->remember_token= Str::random(32);
        $newUser->password=Hash::make($github_user->id);
        $newUser->save();


     //    profile
     $findId=User::all()->pluck('id')->last();
     $profile=new Profile();
     $profile->user_id= $findId;
     $profile->first_name= $github_user->user['name'];
     $profile->last_name=' ';
     $profile->phone='000-000-000';
     $profile->dob=now();
     $profile->gender='N0 Gender';
     $profile->field='No Field';
     $profile->country=$github_user->user['location'];
     $profile->city='';
     $profile->photo=$github_user->user['avatar_url'];
     $profile->website='www.example.com';
     $profile->status=$github_user->user['bio'];
     $profile->save();

    }
    return $newUser;
   }
   public function google($google_user)
   {

       $newUser=User::where('oauth_id',$google_user->id)
       ->where('email',$google_user->email)
       ->first();


    if(!$newUser)
    {
        $newUser=new User();
        $newUser->name= $google_user->name;
        $newUser->email= $google_user->email;
        $newUser->oauth_id= $google_user->id;
        $newUser->email_verified_at= now();
        $newUser->remember_token= Str::random(32);
        $newUser->password=Hash::make($google_user->id);
        $newUser->save();

        //
     //    profile
     $findId=User::all()->pluck('id')->last();
     $profile=new Profile();
     $profile->user_id= $findId;
     $profile->first_name= $google_user->user['name'];
     $profile->last_name=' ';
     $profile->phone='000-000-000';
     $profile->dob=now();
     $profile->gender='N0 Gender';
     $profile->field='No Field';
     $profile->country='';
     $profile->city='';
     $profile->photo=$google_user->user['picture'];
     $profile->website='www.example.com';
     $profile->status="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolor rem molestias, molestiae sit quidem esse deserunt, dignissimos itaque culpa accusantium quod, dolorem ratione! Aliquid totam quam amet commodi provident voluptates.";
     $profile->save();

    }
    return $newUser;
   }


}
