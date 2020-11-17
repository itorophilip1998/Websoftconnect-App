<?php

namespace App\Http\Controllers;

use App\User;
use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
      public function follow(User $user){

          return Auth::user()->following()->toggle($user);
      }

      public function followers(User $user){
          $follows=Auth::user()->following->contains($user->id); 
          return response()->json($follows,200);
      }
}
