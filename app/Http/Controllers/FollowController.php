<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FollowController extends Controller
{
      public function me(Request $me)
      {
         dd($me);
      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $follows=Auth::user()->follows()->with('user.profiles')->get();
        return response()->json($follows,200);
    }
    public function followers($friend_id)
    {
        $following=Follow::where('friend_id',$friend_id)->with('user.profiles')->get();
        return response()->json($following,200);
    }
    public function following($user_id)
    {
        $follower=Follow::where('user_id',$user_id)->with('user.profiles')->get();
        return response()->json($follower,200);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchfreind()
    {
        $user=User::all();
        return response()->json($user,200);

    }
    public function searchpost()
    {
        $post=Post::all();
        return response()->json($post,200);

    }

    public function passwordreset(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:5'],
        ]);
        $id=$request->id;
        $email=$request->email;
        $password=$request->password;
        $confirm=$request->confirmPassword;
        $user_name=$request->user_name;
        $userId=User::
             where('email',$email)
             ->where('name',$user_name)
             ->pluck('id')
             ->first();
             $userName=User::
             where('email',$email)
             ->where('name',$user_name)
             ->pluck('name')
             ->first();

             if($id==$userName.$userId)
             {
                if($password==$confirm)
            {
                      $userPassord=User::find($userId);
                      $userPassord->password=Hash::make($password);
                      $userPassord->save();
                      return response()->json(['success'=>"Password Reset!"],200);

                }
             }
            else{
                return response()->json(['success'=>"incorrect details!"],200);
            }


    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add=new Follow();
        $add->user_id=$request->user_id;
        $add->friend_id=$request->friend_id;
        $add->save();
        return response()->json(['success'=>"Succesfully Liked",$add],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function show($follow)
    {
        $follows=Follow::where('friend_id',$follow)->first();
        return response()->json($follows,200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function edit(Follow $follow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function destroy($follow)
    {
        $follows=Follow::where('friend_id',$follow);
        $follows->delete();
        return response()->json($follows,200);
    }
}
